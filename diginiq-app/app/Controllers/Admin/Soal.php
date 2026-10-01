<?php namespace App\Controllers\Admin;

use Arifrh\DynaModel\DB;

class Soal extends \App\Controllers\AdminController
{
	public function index()
	{
		$b = DB::table('bank_soal');
		$k = DB::table('kategori_soal');

		$saved = false;

		if ($posts = $this->request->getPost())
		{
			$id   = $posts['id'];
			$tipe = $posts['tipe'];
			$new  = empty($id);

			if ($tipe === 'BANK')
			{
				$nama   = $posts['nama'];

				$saved = $new ? $b->insert(['nama' => $nama]) : $b->update($id, ['nama' => $nama]);
			}
			else
			{
				$data = [
					'kategori'   => $posts['kategori'],
					'porsi_soal' => $posts['porsi_soal'],
				];

				if ($new)
				{
					$data = array_merge($data, ['bank_soal' => $posts['bank_soal']]);
				}
	
				$saved = $new ? $k->insert($data) : $k->update($id, $data);
			}

			if ($saved)
			{
				session()->setFlashdata('message', 'Data Berhasil disimpan.');
	
				return redirect()->to('admin/soal');
			}
		}

		$sqlBank      = "SELECT b.*, (SELECT IFNULL(COUNT(s.id), 0) FROM soal s WHERE s.`bank_soal` = b.id) AS jumlah_soal FROM bank_soal b";
		$sqlKategori  = "SELECT k.*, b.nama, (SELECT IFNULL(COUNT(s.id), 0) FROM soal s WHERE s.`kategori` = k.id) AS jumlah_soal FROM kategori_soal k ";
		$sqlKategori .= "JOIN bank_soal b ON k.`bank_soal` = b.id ORDER BY k.bank_soal, k.kategori";


		$list     = $b->query($sqlBank)->getResultArray();
		$kategori = $k->query($sqlKategori)->getResultArray();

		$bankSoal = array_key_value($list, ['id' => 'nama']);

		$this->themes
			->loadPlugins('datatable, inputmask, loading, custom-upload')
			->addJS('admin/bank-soal')
			::render('admin/soal-list', [
				'list'     => $list,
				'kategori' => $kategori,
				'bankSoal' => $bankSoal,
			]);
	}

	public function detail($bankSoal)
	{
		$s = DB::table('soal');

		$soal = $s->findBy(['bank_soal' => $bankSoal]);

		$this->themes
			->loadPlugins('datatable')
			::render('admin/bank-soal-detail', [
				'soal' => $soal,
			]);
	}

	public function hapus()
	{
		if ($id = $this->request->getPost('id'))
		{
			DB::table('kategori_soal')->delete($id);
			DB::table('soal')->deleteBy(['kategori' => $id]);
		}
	}

	public function hapusBank()
	{
		if ($id = $this->request->getPost('id'))
		{
			DB::table('bank_soal')->delete($id);
			DB::table('kategori_soal')->deleteBy(['bank_soal' => $id]);
			DB::table('soal')->deleteBy(['bank_soal' => $id]);
		}
	}

	public function template()
	{
		$filename = WRITEPATH . 'templates/template-soal.xlsx';

		return parent::files($filename);
	}

	public function upload()
	{
		$return = [
			'error'   => true,
			'message' => 'Terjadi kesalahan upload.',
		];

		if ($file = $this->request->getFile('file_soal'))
		{
			$s = DB::table('soal');

			$uploadPath = WRITEPATH . 'uploads/';

			if ($file->isValid() && ! $file->hasMoved())
			{
				if ($file->move($uploadPath))
				{
					$filename = $file->getName();
					$extFile  = pathinfo($filename, PATHINFO_EXTENSION);
					$fileXlsx = $uploadPath . $filename;

					if (strtolower($extFile) === 'xlsx')
					{
						$imported = $this->unggahSoal($fileXlsx);

						if (! empty($imported) && is_array($imported))
						{
							$s->insertBatch($imported, true);

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

	protected function unggahSoal($fileUploaded)
	{
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;

		if ($reader->canRead($fileUploaded))
		{
			$xls = $reader->load($fileUploaded);

			$sheet = $xls->setActiveSheetIndex(0);

			$rows = array_filter($sheet->toArray());

			$importedData = [];

			$mappingCol = [
				'bank_soal',
				'kategori',
				'pertanyaan',
				'a', 'b', 'c', 'd',
				'jawaban',
			];

			$maxCol = count($mappingCol);

			for ($row = 1; $row < count($rows); $row++)
			{
				$tmpRow = [];
				foreach ($rows[$row] as $i => $cell)
				{
					if ($i >= $maxCol)
					{
						break;
					}
				
					$value = ($mappingCol[$i] === 'jawaban' ? strtolower(trim($cell)) : trim($cell));

					$tmpRow[$mappingCol[$i]] = $value;
				}

				if (! empty($tmpRow['bank_soal']))
				{
					array_push($importedData, $tmpRow);
				}
			}

			return $importedData;
		}
	}
}