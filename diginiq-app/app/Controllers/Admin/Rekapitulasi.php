<?php namespace App\Controllers\Admin;

use Arifrh\DynaModel\DB;
use App\Controllers\Traits\PrintTrait;

class Rekapitulasi extends \App\Controllers\AdminController
{
	use PrintTrait;

	public function index()
	{
		$t = DB::table('tests', 'kode_test');
		$list = $t->query("SELECT t.*, (SELECT GROUP_CONCAT(d.nama_desa SEPARATOR ', ') FROM desa d WHERE d.kode_test = t.kode_test) AS desa FROM tests t")->getResultArray();

		$this->themes
			->loadPlugins('datatable')
			->addJS('admin/prosentase')
			::render('admin/rekap-list', [
				'list' => $list,
			]);
	}

	public function prosentase()
	{
		if ($post = $this->request->getPost())
		{
			$t = DB::table('tests');

			$done = $t->update($post['id'], $post);

			if ($done)
			{
				session()->setFlashdata('message', 'Prosentase nilai berhasil disimpan');
			}
			else
			{
				session()->setFlashdata([
					'error'   => true,
					'message' => 'Prosentase nilai gagal disimpan',
				]);
			}

			if (isset($post['redirect']))
			{
				return redirect()->to($post['redirect']);
			}

			return redirect()->to('/admin/rekapitulasi');
		}
	}

	public function form($kodeTest = null)
	{
		$r = DB::table('registrasi');

		$r->belongsTo('desa');

		$peserta = $r->with('desa')->orderBy('no_registrasi', 'asc')->findBy(['kode_test' => $kodeTest]);

		$t = DB::table('tests');
		
		$tests = $t->findOneBy(['kode_test' => $kodeTest]);

		$this->themes
			->loadPlugins('datatable, datepicker, inputmask')
			->addJS('admin/prosentase')
			::render('admin/rekap-form', [
				'kodeTest' => $kodeTest,
				'peserta'  => $peserta,
				'tests'    => $tests,
			]);
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
			::render('admin/opsi-cetak-rekap', [
				'desa' => array_key_value($data, ['id' => 'nama_desa']),
			]);
	}

	public function cetakRekapNilai($desaId)
	{
		$testFields = 't.kode_test, t.tanggal_test, t.prosentase_tertulis, t.prosentase_praktik, t.prosentase_wawancara';
	
		$r = DB::table('registrasi');

		$r->select('registrasi.*, ' . $testFields . ', d.nama_desa', false)
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
		$this->setPrintContent('templates/data-rekap');
		$this->print();
	}

	public function downloadRekapNilai($desaId)
	{
		$testFields = 't.kode_test, t.tanggal_test, t.prosentase_tertulis, t.prosentase_praktik, t.prosentase_wawancara';
	
		$r = DB::table('registrasi');

		$r->select('registrasi.*, ' . $testFields . ', d.nama_desa', false)
			->join('desa d', 'registrasi.desa_id = d.id')
			->join('tests t', 'registrasi.kode_test = t.kode_test');

		$peserta = $r->orderBy('no_registrasi', 'asc')->findBy([
			'desa_id' => $desaId,
		]);

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$xls = $reader->load(WRITEPATH . 'templates/template-rekap.xlsx');

		$sheet = $xls->getActiveSheet();

		$sheet->setCellValue('C3', dot_array_search('0.kode_test', $peserta));
		$sheet->setCellValue('C4', date_id(dot_array_search('0.tanggal_test', $peserta)));
		$sheet->setCellValue('C5', dot_array_search('0.nama_desa', $peserta));

		$sheet->setCellValue('F9', 'N (' . dot_array_search('0.prosentase_tertulis', $peserta) . '%)');
		$sheet->setCellValue('H9', 'N (' . dot_array_search('0.prosentase_praktik', $peserta) . '%)');
		$sheet->setCellValue('J9', 'N (' . dot_array_search('0.prosentase_wawancara', $peserta) . '%)');

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
				'field_name' => 'prosentase_tertulis',
				'cell'       => 'F',
			],
			[
				'field_name' => 'skor_praktik',
				'cell'       => 'G',
			],
			[
				'field_name' => 'prosentase_praktik',
				'cell'       => 'H',
			],
			[
				'field_name' => 'skor_wawancara',
				'cell'       => 'I',
			],
			[
				'field_name' => 'prosentase_wawancara',
				'cell'       => 'J',
			],
			[
				'field_name' => 'total',
				'cell'       => 'K',
			],
		];

		foreach ($peserta as $data)
		{
			if ($no === 2)
			{
				$sheet->insertNewRowBefore($row, count($peserta) - 1);
			}

			$total = 0;

			foreach ($mapping as $map)
			{
				$sheet->setCellValue('A' . $row, $no);

				$fieldName = $map['field_name'];

				$col   = $map['cell'] . $row;

				if (substr($fieldName, 0 , 6) === 'prosen')
				{
					$value =floatval($data[str_replace('prosentase', 'skor', $fieldName)]) * floatval($data[$fieldName]) / 100;
					$total += $value;
				}
				elseif ($fieldName === 'total')
				{
					$value = $total;
				}
				else
				{
					$value = $data[$fieldName];
				}

				if (! in_array($fieldName, ['no_registrasi', 'nama_lengkap', 'nama_desa']))
				{
					$value = format_nilai($value);
				}

				$sheet->setCellValue($col, $value);
			}

			$row++;
			$no++;
		}
		
		$filename = WRITEPATH . 'uploads/REKAPITULASI_NILAI_' . preg_replace('/\s+/', '', dot_array_search('0.nama_desa', $peserta)) . '.xlsx';

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($xls, "Xlsx");
		$writer->save($filename);

		return $this->response->download($filename, null);
	}
}
