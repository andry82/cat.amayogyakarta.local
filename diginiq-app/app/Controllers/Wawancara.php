<?php
namespace App\Controllers;

use Arifrh\DynaModel\DB;


class Wawancara extends InterviewerController
{
	protected $uploadWritePath = WRITEPATH . 'uploads/';

	public function index()
	{
		$t = DB::table('tests', 'kode_test');

		$sqlTest  = "SELECT t.*, (SELECT GROUP_CONCAT(d.nama_desa SEPARATOR ', ') FROM desa d WHERE d.kode_test = t.kode_test) AS desa, ";
		$sqlTest .= "(SELECT COUNT(id) FROM registrasi r WHERE r.kode_test = t.kode_test) AS peserta FROM tests t ";
		$sqlTest .= "JOIN interviewer i on i.kode_test = t.kode_test AND i.`user_id` = " . $this->user['id'];
		
		$list = $t->query($sqlTest)->getResultArray();

		$this->themes
			->loadPlugins('datatable')
			::render('interview/nilai-list', [
				'list' => $list,
			]);
	}

	public function list($kodeTest = null)
	{
		$r = DB::table('registrasi');

		if ($posts = $this->request->getPost())
		{
			$updateBatch = [];

			foreach ($posts['nilai'] as $noReg => $data)
			{
				$data = $this->skorNilai($data);

				$updateBatch[] = array_merge($data, [
					'no_registrasi' => $noReg,
				]);
			}

			$saved = $r->updateBatch($updateBatch, 'no_registrasi');

			if ($saved)
			{
				return redirect()->to('/wawancara/list/' . $kodeTest);
			}
		}

		$r->belongsTo('desa');

		$peserta = $r->with('desa')->orderBy('no_registrasi', 'asc')->findBy(['kode_test' => $kodeTest]);

		$this->themes
			->loadPlugins('datatable, inputmask')
			::render('interview/list-peserta', [
				'kodeTest' => $kodeTest,
				'peserta'  => $peserta,
			]);
	}

	public function form($idPeserta = null)
	{
		$r = DB::table('registrasi');
		$t = DB::table('tests');

		$r->belongsTo('desa');

		$data = $r->with('desa')->orderBy('no_registrasi', 'asc')->find($idPeserta);

		$data['tests'] = $t->findOneBy(['kode_test' => $data['kode_test']]);

		if ($posts = $this->request->getPost())
		{
			$posts['skor_wawancara'] = round(((floatval($posts['interview1']) + floatval($posts['interview2']) + floatval($posts['interview3']))/3),2);

			$saved = $r->update($idPeserta, $posts);

			if ($saved)
			{
				return redirect()->to('/wawancara/list/' . $data['kode_test']);
			}
		}

		$this->themes
			->loadPlugins('datatable, inputmask')
			->addJS('interview/form-nilai')
			::render('interview/form', [
				'id'       => $idPeserta,
				'data'     => $data,
				'readonly' => substr($data['tests']['tanggal_test'], 0, 10) !== date('Y-m-d') || $data['tests']['status'] == 0,
			]);
	}

	public function sync()
	{
		if ($posts = $this->request->getPost())
		{
			$r = DB::table('registrasi');

			$posts['skor_wawancara'] = round(((floatval($posts['interview1']) + floatval($posts['interview2']) + floatval($posts['interview3']))/3),2);

			$r->update($posts['id'], $posts);
		}
	}

	public function update()
	{
		if ($posts = $this->request->getPost())
		{
			$r = DB::table('registrasi');

			if (isset($posts['id']) && isset($posts['field']) && isset($posts['value']) && 
				isset($posts['interview1']) && isset($posts['interview2']) && isset($posts['interview3'])
			) {
				$r->update($posts['id'], [
					$posts['field'] => $posts['value'],
					'interview1' => $posts['interview1'],
					'interview2' => $posts['interview2'],
					'interview3' => $posts['interview3'],
				]);
			}
		}
	}
}