<?php namespace App\Controllers\Admin;

use Arifrh\DynaModel\DB;

use function React\Promise\reduce;

class Test extends \App\Controllers\AdminController
{
	public function index()
	{
		$t = DB::table('tests', 'kode_test');
		$list = $t->query("SELECT t.*, (SELECT GROUP_CONCAT(d.nama_desa SEPARATOR ', ') FROM desa d WHERE d.kode_test = t.kode_test) AS desa FROM tests t")->getResultArray();

		$this->themes
			->loadPlugins('datatable')
			->addJS('admin/test-list')
			::render('admin/test-list', [
				'list' => $list,
			]);
	}

	public function form($id = null)
	{
		$t = DB::table('tests');
		$d = DB::table('desa');
		$r = DB::table('registrasi');
		$r->belongsTo('desa');

		$data = $desa = $peserta = [];

		if ($posts = $this->request->getPost())
		{
			if (! isset($posts['ada_tes_praktik']))
			{
				$posts['ada_tes_praktik'] = 0;
			}

			if (! isset($posts['status']))
			{
				$posts['status'] = 0;
			}

			$posts = addFormattedDate($posts, ['tanggal_test']);
			$saved = $t->save($posts);

			if ($saved)
			{
				$backToForm = false;

				if (! empty($posts['nama_desa']))
				{
					$dataDesa = [
						'kode_test' => trim($posts['kode_test']),
						'nama_desa' => trim($posts['nama_desa']),
					];

					if (! empty($posts['desa_id']))
					{
						$dataDesa['id'] = $posts['desa_id'];
					}

					$backToForm = $d->save($dataDesa);

					if ($backToForm)
					{
						$row = $t->findOneBy(['kode_test' => $posts['kode_test']]);

						$id = isset($row['id']) ? $row['id'] : '';
					}
				}
				session()->setFlashdata('message', 'Data Tes Berhasil disimpan.');

				if ($backToForm)
					return redirect()->to('admin/test/form' . (empty($id) ? '' : '/' . $id));
	
				return redirect()->to('admin/test');
			}
		}

		if (! empty($id))
		{
			$data = $t->find($id);

			if (isset($data['kode_test']))
			{
				$desa = $d->findBy(['kode_test' => $data['kode_test']]);

				$peserta = $r->with('desa')->findBy(['kode_test' => $data['kode_test']]);
			}
		}

		$b = DB::table('bank_soal');
		$s = $b->findBy(['status' => 1]);

		$soal = array_key_value($s, ['id' => 'nama']);

		$pewawancara = [];

		if (isset($data['kode_test']))
		{
			$i = DB::table('interviewer');
			$i->belongsTo('users');

			$pewawancara = $i->with('users')->findBy(['kode_test' => $data['kode_test']]);
		}

		$u = DB::table('users');

		$users = $u->findBy([
			'role_id' => 2,
			'active'  => 1,
		]);

		$userWawancara = array_key_value($users, ['id' => 'fullname']);

		$this->themes
			->loadPlugins('datatable, datepicker, inputmask')
			->addJS('admin/test')
			::render('admin/test-form', [
				'id'   => $id,
				'data' => $data,
				'desa' => $desa,
				'soal' => $soal,

				'userWawancara' => $userWawancara,
				'peserta'       => $peserta,
				'pewawancara'   => $pewawancara,
			]);
	}

	public function pewawancara()
	{
		if ($post = $this->request->getPost())
		{
			$i = DB::table('interviewer');

			if (empty($post['pewawancara_id']))
			{
				$i->insert([
					'kode_test' => trim($post['kode_test']),
					'user_id'   => $post['user_id'],
				]);
			}
			else
			{
				$i->update($post['pewawancara_id'], [
					'kode_test' => trim($post['kode_test']),
					'user_id'   => $post['user_id'],
				]);
			}

			session()->setFlashdata('message', 'List Pewawancara berhasil diperbarui');
			return redirect()->to('admin/test/form/' . $post['testId']);
		}
	}

	public function detail($id = null)
	{
		$t = DB::table('tests');

		$data = [];

		if (! empty($id))
		{
			$data = $t->find($id);
		}

		$this->themes
			::render('admin/test-detail', [
				'id'   => $id,
				'data' => $data,
			]);
	}

	public function getSoal($bankSoal)
	{
		$data = [];

		$s = DB::table('soal');

		$soal = $s->findBy(['bank_soal' => $bankSoal]);

		$no = 1;

		foreach ($soal as $row)
		{
			$jawaban = $row['jawaban'];

			$tpl = '<div class="mt-3 p-3 bg-success">:pilihan:</div>';

			$pilihan = [
				$this->formatPilihan($row, 'a', $jawaban, $tpl),
				$this->formatPilihan($row, 'b', $jawaban, $tpl),
				$this->formatPilihan($row, 'c', $jawaban, $tpl),
				$this->formatPilihan($row, 'd', $jawaban, $tpl),
			];

			$data[] = [
				$no,
				nl2br($row['pertanyaan']),
				implode('<br>', $pilihan),
				//$jawaban,
			];

			$no++;
		}

		return $this->response->setJSON([
			'draw'            => $this->request->getPost('draw') ?? 1,
			'recordsTotal'    => count($soal),
			'recordsFiltered' => count($soal),
			'data'            => $data,
		]);
	}

	protected function formatPilihan($data, $pilihan, $jawaban, $tpl)
	{
		$textPilihan = $pilihan . '. ' . nl2br($data[$pilihan]);

		return ($pilihan === $jawaban) ? str_replace(':pilihan:', $textPilihan, $tpl) : $textPilihan;
	}

	public function hapus()
	{
		if ($post = $this->request->getPost())
		{
			$id    = $post['id'];
			$table = trim($post['data']);

			if (in_array($table, ['desa', 'interviewer']) && ! empty($id))
			{
				$t = DB::table($table);
				$t->delete($id);
			}
		}
	}

	public function hapusTest()
	{
		if ($post = $this->request->getPost())
		{
			$id   = $post['id'];
			$kode = trim($post['kode']);

			$t = DB::table('tests');
			
			$del = $t->delete($id);
			
			if ($del)
			{
				// hapus desa
				$d = DB::table('desa');
				$d->deleteBy([
					'kode_test' => $kode,
				]);
	
				// hapus pewawancara
				$i = DB::table('interviewer');
				$i->deleteBy([
					'kode_test' => $kode,
				]);
	
				// hapus peserta
				$r = DB::table('registrasi');

				$noRegs = $r->select('no_registrasi')->findBy([
					'kode_test' => $kode,
				]);

				$r->deleteBy([
					'kode_test' => $kode,
				]);

				if (is_array($noRegs))
				{
					$targets = [];

					foreach ($noRegs as $val)
					{
						$targets[] = $val['no_registrasi'];
					}

					if (! empty($targets))
					{
						// data tes
						$tt = DB::table('tes_tertulis');
						$tt->deleteBy([
							'no_registrasi' => $targets,
						]);
					}
				}
			}
		}
	}

	public function showResult($noReg)
	{
		$t = DB::table('tes_tertulis');

		$soal = $t->orderBy('nomor', 'asc')->findBy(['no_registrasi' => $noReg]);

		$hasil = $t->select('SUM(poin) as totalPoin', false)
			->findOneBy([
				'no_registrasi' => $noReg,
			]);

		$skor = $hasil['totalPoin'];

		$this->themes
				::render('admin/hasil-test-tertulis', [
					'soal'  => $soal,
					'skor'  => $skor,
					'noReg' => $noReg
				]);
	}
}
