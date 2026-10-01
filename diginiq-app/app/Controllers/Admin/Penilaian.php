<?php namespace App\Controllers\Admin;

use Arifrh\DynaModel\DB;
use App\Controllers\Traits\PrintTrait;
use NcJoes\OfficeConverter\OfficeConverter;
use PhpOffice\PhpWord\TemplateProcessor;

class Penilaian extends \App\Controllers\AdminController
{
	use PrintTrait;

	public function index()
	{
		$t = DB::table('tests', 'kode_test');
		$list = $t->query("SELECT t.*, (SELECT GROUP_CONCAT(d.nama_desa SEPARATOR ', ') FROM desa d WHERE d.kode_test = t.kode_test) AS desa FROM tests t")->getResultArray();

		$this->themes
			->loadPlugins('datatable')
			::render('admin/nilai-list', [
				'list' => $list,
			]);
	}

	public function form($kodeTest = null)
	{
		$r = DB::table('registrasi');

		if ($posts = $this->request->getPost())
		{
			$updateBatch = [];

			foreach ($posts['nilai'] as $noReg => $data)
			{
				$data = $this->skorNilai($data, $kodeTest);

				$updateBatch[] = array_merge($data, [
					'no_registrasi' => $noReg,
				]);
			}

			$saved = $r->updateBatch($updateBatch, 'no_registrasi');

			if ($saved)
			{
				return redirect()->to('/admin/penilaian/form/' . $kodeTest);
			}
		}

		$this->refreshSkorNilai($kodeTest);

		$r->belongsTo('desa');

		$peserta = $r->with('desa')->orderBy('no_registrasi', 'asc')->findBy(['kode_test' => $kodeTest]);

		$tests = DB::table('tests')->findOneBy(['kode_test' => $kodeTest]);

		$this->themes
			->loadPlugins('datatable, datepicker, inputmask, loading, custom-upload')
			->addJS('admin/nilai')
			::render('admin/nilai-form', [
				'kodeTest' => $kodeTest,
				'peserta'  => $peserta,
				'tests'    => $tests,
				'aktif'    => (substr($tests['tanggal_test'], 0, 10) == date('Y-m-d')), // && $tests['status'] == 1),
			]);
	}

	protected function skorNilai($data, $kodeTest)
	{
		$t = DB::table('tests');

		$tes = $t->findOneBy(['kode_test' => $kodeTest]);

		$prosentaseWord = $prosentaseExcel = $prosentasePpt = $prosentaseEmail = 0;

		if (is_array($tes))
		{
			$prosentaseWord  = floatval($tes['prosentase_word'])/100;
			$prosentaseExcel = floatval($tes['prosentase_excel'])/100;
			$prosentasePpt   = floatval($tes['prosentase_ppt'])/100;
			$prosentaseEmail = floatval($tes['prosentase_email'])/100;
		}

		$data['skor_word']  = $this->sumTotal(['word1', 'word2', 'word3'], $data);
		$data['skor_excel'] = $this->sumTotal(['excel1', 'excel2', 'excel3'], $data);
		$data['skor_ppt']   = $this->sumTotal(['ppt1', 'ppt2', 'ppt3'], $data);
		$data['skor_email'] = $this->sumTotal(['email1', 'email2', 'email3'], $data);

		$data['skor_praktik']   = round((($data['skor_word'] * $prosentaseWord) + ($data['skor_excel'] * $prosentaseExcel) + ($data['skor_ppt'] * $prosentasePpt) + ($data['skor_email'] * $prosentaseEmail)), 2);
		$data['skor_wawancara'] = $this->sumTotal(['interview1', 'interview2', 'interview3'], $data);

		return $data;
	}

	protected function sumTotal($keys, $array)
	{
		$total = 0;
		foreach ($keys as $field) {
			$total += (!isset($array[$field]) || $array[$field] === '') ? 0 : floatval($array[$field]);
		}

		return round(($total / 3), 2);
	}

	public function cetak($kodeTest = null)
	{
		$d = DB::table('desa');

		if (empty($kodeTest))
		{
			$data = $d->orderBy('nama_desa', 'asc')->findAll();
		}
		else
		{
			$data = $d->orderBy('nama_desa', 'asc')->findBy(['kode_test' => $kodeTest]);
		}
	
		$this->themes
			->loadPlugins('datatable')
			->addJS('admin/cetak')
			::render('admin/opsi-cetak', [
				'desa' => array_key_value($data, ['id' => 'nama_desa']),
			]);
	}

	public function cetakDataNilai($desaId)
	{
		$r = DB::table('registrasi');

		$r->select('registrasi.*, t.kode_test, t.tanggal_test, t.prosentase_word, t.prosentase_excel, t.prosentase_ppt, t.prosentase_email, d.nama_desa', false)
			->join('desa d', 'registrasi.desa_id = d.id')
			->join('tests t', 'registrasi.kode_test = t.kode_test');

		$peserta = $r->orderBy('no_registrasi', 'asc')->findBy([
			'desa_id' => $desaId,
		]);

		$this->setPrintConfig([
			'peserta' => $peserta,
		]);

		$this->autoPrint();
		$this->setPrintHeader('templates/data-nilai-header');
		$this->setPrintContent('templates/data-nilai');
		$this->print();
	}

	public function downloadDataNilai($desaId)
	{
		$r = DB::table('registrasi');

		$r->select('registrasi.*, t.kode_test, t.tanggal_test, t.prosentase_word, t.prosentase_excel, t.prosentase_ppt, t.prosentase_email, d.nama_desa', false)
			->join('desa d', 'registrasi.desa_id = d.id')
			->join('tests t', 'registrasi.kode_test = t.kode_test');

		$peserta = $r->orderBy('no_registrasi', 'asc')->findBy([
			'desa_id' => $desaId,
		]);

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$xls = $reader->load(WRITEPATH . 'templates/template-nilai.xlsx');

		$sheet = $xls->getActiveSheet();

		$sheet->setCellValue('C3', dot_array_search('0.kode_test', $peserta));
		$sheet->setCellValue('C4', date_id(dot_array_search('0.tanggal_test', $peserta)));
		$sheet->setCellValue('C5', dot_array_search('0.nama_desa', $peserta));

		$row = 10;
		$no  = 1;

		$mapping = [
			[
				'field_name' => 'no_registrasi',
				'cell'       => 'B',
			],
			[
				'field_name' => 'nama_lengkap',
				'cell'       => 'C',
			],
			[
				'field_name' => 'nama_desa',
				'cell'       => 'D',
			],
			[
				'field_name' => 'skor_tertulis',
				'cell'       => 'E',
			],
			[
				'field_name' => 'word1',
				'cell'       => 'F',
			],
			[
				'field_name' => 'word2',
				'cell'       => 'G',
			],
			[
				'field_name' => 'word3',
				'cell'       => 'H',
			],
			[
				'field_name' => 'skor_word',
				'cell'       => 'I',
			],
			[
				'field_name' => 'excel1',
				'cell'       => 'J',
			],
			[
				'field_name' => 'excel2',
				'cell'       => 'K',
			],
			[
				'field_name' => 'excel3',
				'cell'       => 'L',
			],
			[
				'field_name' => 'skor_excel',
				'cell'       => 'M',
			],
			[
				'field_name' => 'ppt1',
				'cell'       => 'N',
			],
			[
				'field_name' => 'ppt2',
				'cell'       => 'O',
			],
			[
				'field_name' => 'ppt3',
				'cell'       => 'P',
			],
			[
				'field_name' => 'skor_ppt',
				'cell'       => 'Q',
			],
			[
				'field_name' => 'email1',
				'cell'       => 'R',
			],
			[
				'field_name' => 'email2',
				'cell'       => 'S',
			],
			[
				'field_name' => 'email3',
				'cell'       => 'T',
			],
			[
				'field_name' => 'skor_email',
				'cell'       => 'U',
			],
			[
				'field_name' => 'skor_praktik',
				'cell'       => 'V',
			],
			[
				'field_name' => 'interview1',
				'cell'       => 'W',
			],
			[
				'field_name' => 'interview2',
				'cell'       => 'X',
			],
			[
				'field_name' => 'interview3',
				'cell'       => 'Y',
			],
			[
				'field_name' => 'skor_wawancara',
				'cell'       => 'Z',
			],
		];

		$prosentase = [
			'word'  => dot_array_search('0.prosentase_word', $peserta),
			'excel' => dot_array_search('0.prosentase_excel', $peserta),
			'ppt'   => dot_array_search('0.prosentase_ppt', $peserta),
			'email' => dot_array_search('0.prosentase_email', $peserta),
		];

		foreach ($peserta as $data)
		{
			if ($no === 2)
			{
				$labelN = 'N (' . $prosentase['word'] . '% Word + ' . $prosentase['excel'] . '% Excel + ' . $prosentase['ppt'] . '% PPT + ' . $prosentase['email'] . '% Email)';

				$sheet->setCellValue('V8', $labelN);
				$sheet->insertNewRowBefore($row, count($peserta) - 1);
			}

			foreach ($mapping as $map)
			{
				$sheet->setCellValue('A' . $row, $no);

				$fieldName = $map['field_name'];

				$col   = $map['cell'] . $row;
				$value = $data[$fieldName];

				if (! in_array($fieldName, ['no_registrasi', 'nama_lengkap', 'nama_desa']))
				{
					$value = format_nilai($value);
				}

				$sheet->setCellValue($col, $value);
			}

			$row++;
			$no++;
		}
		
		$filename = WRITEPATH . 'uploads/DATA_NILAI_' . preg_replace('/\s+/', '', dot_array_search('0.nama_desa', $peserta)) . '.xlsx';

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($xls, "Xlsx");
		$writer->save($filename);

		return $this->response->download($filename, null);
	}

	public function cetakNilaiGabungan($idPeserta = null)
	{
		$p = DB::table('peserta', 'id');

		$data = $p->find($idPeserta);

		if (is_array($data))
		{
			$tpl = WRITEPATH . 'templates/template-gabungan.docx';

			$doc = new TemplateProcessor($tpl);

			$doc->setValues([
				'no_registrasi'     => $data['no_registrasi'],
				'nama_lengkap'      => $data['nama_lengkap'],
				'kode_test'         => $data['kode_test'],
				'nama_desa'         => $data['nama_desa'],
				'petugas_wawancara' => $data['fullname'],
				'skor_tertulis'     => $data['skor_tertulis'],

				'tanggal_test' => date_id($data['tanggal_test']),
				'interview1'   => $data['interview1'],
				'interview11'  => $data['interview11'],
				'interview12'  => $data['interview12'],
				'interview13'  => $data['interview13'],
				'interview14'  => $data['interview14'],
				'interview15'  => $data['interview15'],
				'interview2'   => $data['interview2'],
				'interview21'  => $data['interview21'],
				'interview22'  => $data['interview22'],
				'interview23'  => $data['interview23'],
				'interview24'  => $data['interview24'],
				'interview25'  => $data['interview25'],
				'interview3'   => $data['interview3'],
				'interview31'  => $data['interview31'],
				'interview32'  => $data['interview32'],
				'interview33'  => $data['interview33'],
				'interview34'  => $data['interview34'],
				'interview35'  => $data['interview35'],

				'word1'      => $data['word1'],
				'word2'      => $data['word2'],
				'word3'      => $data['word3'],
				'skor_word'  => $data['skor_word'],
				'excel1'     => $data['excel1'],
				'excel2'     => $data['excel2'],
				'excel3'     => $data['excel3'],
				'skor_excel' => $data['skor_excel'],
				'ppt1'       => $data['ppt1'],
				'ppt2'       => $data['ppt2'],
				'ppt3'       => $data['ppt3'],
				'skor_ppt'   => $data['skor_ppt'],
				'email1'     => $data['email1'],
				'email2'     => $data['email2'],
				'email3'     => $data['email3'],
				'skor_email' => $data['skor_email'],
			]);

			$noReg = trim($data['no_registrasi']);

			$filename = WRITEPATH . 'uploads/NILAI_UJIAN_' . $noReg . '.docx';

			$doc->saveAs($filename);

			$converter = new OfficeConverter($filename);
	
			$pdf = $converter->convertTo('NILAI_UJIAN_' . preg_replace('/\s+/', '', $noReg) . '.pdf');

			return $this->response->download($pdf, null);
		}
	}

	public function cetakNilaiPraktik($idPeserta = null)
	{
		$p = DB::table('peserta', 'id');

		$data = $p->find($idPeserta);

		if (is_array($data))
		{
			$tpl = WRITEPATH . 'templates/template-praktik.docx';

			$doc = new TemplateProcessor($tpl);

			$doc->setValues([
				'no_registrasi'     => $data['no_registrasi'],
				'nama_lengkap'      => $data['nama_lengkap'],
				'kode_test'         => $data['kode_test'],
				'nama_desa'         => $data['nama_desa'],
				'petugas_wawancara' => $data['fullname'],

				'tanggal_test' => date_id($data['tanggal_test']),
				'word1'      => $data['word1'],
				'word2'      => $data['word2'],
				'word3'      => $data['word3'],
				'skor_word'  => $data['skor_word'],
				'excel1'     => $data['excel1'],
				'excel2'     => $data['excel2'],
				'excel3'     => $data['excel3'],
				'skor_excel' => $data['skor_excel'],
				'ppt1'       => $data['ppt1'],
				'ppt2'       => $data['ppt2'],
				'ppt3'       => $data['ppt3'],
				'skor_ppt'   => $data['skor_ppt'],
				'email1'     => $data['email1'],
				'email2'     => $data['email2'],
				'email3'     => $data['email3'],
				'skor_email' => $data['skor_email'],
			]);

			$noReg = trim($data['no_registrasi']);

			$filename = WRITEPATH . 'uploads/NILAI_PRAKTIK_' . $noReg . '.docx';

			$doc->saveAs($filename);

			$converter = new OfficeConverter($filename);
	
			$pdf = $converter->convertTo('NILAI_WAWANCARA_' . $noReg . '.pdf');

			return $this->response->download($pdf, null);
		}
	}

	public function cetakNilaiWawancara($idPeserta = null)
	{
		$p = DB::table('peserta', 'id');

		$data = $p->find($idPeserta);

		if (is_array($data))
		{
			$tpl = WRITEPATH . 'templates/template-wawancara.docx';

			$doc = new TemplateProcessor($tpl);

			$doc->setValues([
				'no_registrasi'     => $data['no_registrasi'],
				'nama_lengkap'      => $data['nama_lengkap'],
				'kode_test'         => $data['kode_test'],
				'nama_desa'         => $data['nama_desa'],
				'petugas_wawancara' => $data['fullname'],

				'tanggal_test' => date_id($data['tanggal_test']),
				'interview1'   => $data['interview1'],
				'interview11'  => $data['interview11'],
				'interview12'  => $data['interview12'],
				'interview13'  => $data['interview13'],
				'interview14'  => $data['interview14'],
				'interview15'  => $data['interview15'],
				'interview2'   => $data['interview2'],
				'interview21'  => $data['interview21'],
				'interview22'  => $data['interview22'],
				'interview23'  => $data['interview23'],
				'interview24'  => $data['interview24'],
				'interview25'  => $data['interview25'],
				'interview3'   => $data['interview3'],
				'interview31'  => $data['interview31'],
				'interview32'  => $data['interview32'],
				'interview33'  => $data['interview33'],
				'interview34'  => $data['interview34'],
				'interview35'  => $data['interview35'],
			]);

			$noReg = trim($data['no_registrasi']);

			$filename = WRITEPATH . 'uploads/NILAI_WAWANCARA_' . $noReg . '.docx';

			$doc->saveAs($filename);

			$converter = new OfficeConverter($filename);
	
			$pdf = $converter->convertTo('NILAI_WAWANCARA_' . $noReg . '.pdf');

			return $this->response->download($pdf, null);
		}
	}

	public function refresh()
	{
		$data = DB::table('tests')->findBy([
			'tanggal_test' => date('Y-m-d'),
			// 'status'       => 1,
		]);
	
		$this->themes
			->addJS('admin/sync-nilai')
			::render('admin/sync-nilai', [
				'data' => $data,
			]);
	}

	public function sync($kodeTest)
	{
		$registrations = $this->refreshSkorNilai($kodeTest);

		if (! empty($registrations)) {

			$t = DB::table('tes_tertulis');
			$r = DB::table('registrasi');

			foreach($registrations as $no_registrasi) {

				$hasil = $t->select('SUM(poin) as totalPoin', false)
					->findOneBy([
						'no_registrasi' => $no_registrasi,
					]);

				$skor = $hasil['totalPoin'];

				$r->updateBy([
					'skor_tertulis' => $skor,
				], [
					'no_registrasi' => $no_registrasi,
				]);
			}

			session()->setFlashdata('message', 'Nilai untuk Kode Test' . $kodeTest . ' telah disinkronisasi');
		}

		return redirect()->to('admin/penilaian/refresh');
	}

	public function refreshSkorNilai($kodeTest)
	{
		$t = DB::table('tests');

		$tes = $t->findOneBy(['kode_test' => $kodeTest]);

		$prosentaseWord = $prosentaseExcel = $prosentasePpt = $prosentaseEmail = 0;

		if (is_array($tes))
		{
			$prosentaseWord  = floatval($tes['prosentase_word'])/100;
			$prosentaseExcel = floatval($tes['prosentase_excel'])/100;
			$prosentasePpt   = floatval($tes['prosentase_ppt'])/100;
			$prosentaseEmail = floatval($tes['prosentase_email'])/100;
		}

		$r = DB::table('registrasi');

		$rows = $r->findBy(['kode_test' => $kodeTest]);

		$registers = [];

		foreach ($rows as $data)
		{
			$registers[$data['no_registrasi']] = $data['no_registrasi'];

			$data['skor_word']  = $this->sumTotal(['word1', 'word2', 'word3'], $data);
			$data['skor_excel'] = $this->sumTotal(['excel1', 'excel2', 'excel3'], $data);
			$data['skor_ppt']   = $this->sumTotal(['ppt1', 'ppt2', 'ppt3'], $data);
			$data['skor_email'] = $this->sumTotal(['email1', 'email2', 'email3'], $data);

			$data['skor_praktik']   = round((($data['skor_word'] * $prosentaseWord) + ($data['skor_excel'] * $prosentaseExcel) + ($data['skor_ppt'] * $prosentasePpt) + ($data['skor_email'] * $prosentaseEmail)), 2);
			$data['skor_wawancara'] = $this->sumTotal(['interview1', 'interview2', 'interview3'], $data);

			$r->update($data['id'], $data);
		}
		return $registers;
	}

	public function upload()
	{
		$return = [
			'error'   => true,
			'message' => 'Terjadi kesalahan upload.',
		];

		if ($file = $this->request->getFile('file_jawaban'))
		{
			$t = DB::table('tes_tertulis');

			$uploadPath = WRITEPATH . 'uploads/';

			if ($file->isValid() && ! $file->hasMoved())
			{
				$filename = $file->getName();
				$extFile  = pathinfo($filename, PATHINFO_EXTENSION);
				$fileJson = $uploadPath . $filename;
				
				if ($file->move($uploadPath, $filename, true))
				{
					$no_registrasi = explode('.', $filename)[0];

					if (strtolower($extFile) === 'json')
					{
						$imported = json_decode(file_get_contents($fileJson), true);

						if (! empty($imported) && is_array($imported))
						{
							foreach ($imported as $post)
							{
								$t->updateBy([
									'waktu_jawab' => date('Y-m-d H:i:s'),
									'jawaban'     => $post['jawaban'],
								], [
									'no_registrasi' => $no_registrasi,
									'id'            => $post['id'],
								]);
							}

							$r = DB::table('registrasi');
							
							$r->updateBy([
								'selesai_tes_tertulis' => date('Y-m-d H:i:s'),
								'sisa_waktu_tertulis'  => 0,
							], [
								'no_registrasi' => $no_registrasi,
							]);
					
							$sqlUpdatePoin = 'UPDATE tes_tertulis t JOIN registrasi r ON t.`no_registrasi` = r.`no_registrasi` ';
							$sqlUpdatePoin .= 'SET t.poin = (CASE WHEN t.jawaban = t.kunci_jawaban THEN ';
							$sqlUpdatePoin .= '(SELECT poin_tes_tertulis FROM tests WHERE tests.`kode_test` = r.`kode_test`) ELSE 0 END)';
					
							$r->query($sqlUpdatePoin);

							$hasil = $t->select('SUM(poin) as totalPoin', false)
								->findOneBy([
									'no_registrasi' => $no_registrasi,
								]);

							$skor = $hasil['totalPoin'];

							$r->updateBy([
								'skor_tertulis' => $skor,
							], [
								'no_registrasi' => $no_registrasi,
							]);
							
							$return = [
								'error'   => false,
								'message' => '',
							];
						}
					}
				}
			}
			else
			{
				$return = [
					'error'   => true,
					'message' => $file->getErrorString(),
				];
			}
		}

		return $this->response->setJSON($return);
	}

	public function uploadInterview()
	{
		$return = [
			'error'   => true,
			'message' => 'Terjadi kesalahan upload.',
		];

		if ($file = $this->request->getFile('file_interview'))
		{
			$r = DB::table('registrasi');

			$uploadPath = WRITEPATH . 'uploads/';

			if ($file->isValid() && ! $file->hasMoved())
			{
				$filename = $file->getName();
				$extFile  = pathinfo($filename, PATHINFO_EXTENSION);
				$fileJson = $uploadPath . $filename;
				
				if ($file->move($uploadPath, $filename, true))
				{
					$no_registrasi = explode('-', explode('.', $filename)[0])[1]; // json filename format is interview-XXXXX.json

					if (strtolower($extFile) === 'json')
					{
						$imported = json_decode(file_get_contents($fileJson), true);

						if (! empty($imported) && is_array($imported))
						{
							$posts = [];

							foreach ($imported as $post)
							{
								$posts[$post['column']] = $post['value'];

								$r->updateBy([
									$post['column'] => $post['value'],
								], [
									'no_registrasi' => $no_registrasi,
								]);
							}
					
							$posts['skor_wawancara'] = round(((floatval($posts['interview1']) + floatval($posts['interview2']) + floatval($posts['interview3']))/3),2);
							
							$r->updateBy([
								'skor_wawancara' => $posts['skor_wawancara'],
							], [
								'no_registrasi' => $no_registrasi,
							]);
							
							$return = [
								'error'   => false,
								'message' => '',
							];
						}
					}
				}
			}
			else
			{
				$return = [
					'error'   => true,
					'message' => $file->getErrorString(),
				];
			}
		}

		return $this->response->setJSON($return);
	}
}
