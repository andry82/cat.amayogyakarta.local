<?php
namespace App\Controllers;

use Arifrh\DynaModel\DB;

class Test extends UserController
{
	public function tertulis()
	{
		$timerTertulis = $this->user['peserta']['sisa_waktu_tertulis'];

		if (empty($timerTertulis))
		{
			$this->themes
				->setTemplate('normal')
				->loadPlugins('alert')
				->addJS('test/finish')
				::render('test/skor-tertulis', [
					'poin' => $this->getPoin(),
				]);
		}
		else
		{
			$this->themes
				->setTemplate('normal')
				->loadPlugins('alert, countdown, loading')
				->addJS('test/cat.js')
				::render('test/test-tertulis', [
					'soal'  => $this->getSoal(),
					'timer' => $timerTertulis,
				]);
		}
	}

	protected function getSoal()
	{
		$noReg = $this->user['peserta']['no_registrasi'];

		$r = DB::table('registrasi');
		$t = DB::table('tes_tertulis');

		$soal = $t->orderBy('nomor', 'asc')->findBy(['no_registrasi' => $noReg]);

		if (! is_array($soal) || empty($soal))
		{
			// ambil soal
			$jumlahSoal = $this->user['tests']['jumlah_soal_tertulis'];

			$s = DB::table('soal');

			$kategori = $s->select('DISTINCT soal.kategori, k.porsi_soal', false)
				->join('kategori_soal k', 'soal.kategori = k.id')->get()
				->getResultArray();

			if (is_array($kategori))
			{
				$bankSoal = [];

				foreach ($kategori as $row)
				{
					$idKategori = $row['kategori'];
					$jmlSoal    = $row['porsi_soal'];

					$s->select('soal.*, kategori_soal.kategori as kategori_soal', false)
						->join('kategori_soal', 'soal.kategori = kategori_soal.id')
						->limit($jmlSoal)
						->orderBy('id', 'RANDOM');

					$result = $s->findBy([
						'bank_soal' => $this->user['tests']['bank_soal'],
						'kategori'  => $idKategori,
					]);

					$bankSoal = array_merge($bankSoal, $result);
				}
			}

			// acak soal
			shuffle($bankSoal);

			$dataSoal = [];

			$no = 1;
			
			foreach ($bankSoal as $soal)
			{
				$dataSoal[] = [
					'no_registrasi' => $noReg,
  					'kategori'      => $soal['kategori_soal'],
  					'nomor'         => $no,
  					'pertanyaan'    => $soal['pertanyaan'],
  					'a'             => $soal['a'],
  					'b'             => $soal['b'],
  					'c'             => $soal['c'],
  					'd'             => $soal['d'],
  					'kunci_jawaban' => $soal['jawaban'],
				];

				$no++;
			}

			$t->insertBatch($dataSoal);

			// catat waktu mulai mengerjakan test
			$r = DB::table('registrasi');

			$r->updateBy([
				'mulai_tes_tertulis' => date('Y-m-d H:i:s'),
			], [
				'no_registrasi' => $noReg,
			]);

			return $this->getSoal();
		}

		$r->updateBy([
			'last_page' => '/test/tertulis',
		], [
			'no_registrasi' => $noReg,
		]);

		return $soal;
	}

	public function jawab()
	{
		if ((int) ($this->user['peserta']['target'] ?? 0) > 0)
		{
			return;
		}

		$this->sync();

		$r = DB::table('registrasi');

		$r->updateBy([
			'selesai_tes_tertulis' => date('Y-m-d H:i:s'),
			'sisa_waktu_tertulis'  => 0,
		], [
			'no_registrasi' => $this->user['peserta']['no_registrasi'],
		]);

	}

	public function sync()
	{
		if ($posts = $this->request->getPost())
		{
			$r = DB::table('registrasi');

			if (isset($posts['sisa_waktu_tertulis']))
			{
				$r->updateBy([
					'sisa_waktu_tertulis' => $posts['sisa_waktu_tertulis'],
				], [
					'no_registrasi' => $this->user['peserta']['no_registrasi'],
				]);

				unset($posts['sisa_waktu_tertulis']);
			}

			$t = DB::table('tes_tertulis');

			foreach ($posts as $post => $value)
			{
				$field = explode('_', $post);
				$this->saveAnswer($field[1], $value);
			}
		}
	}

	protected function saveAnswer($id, $answer)
	{
		$noReg = $this->user['peserta']['no_registrasi'];
		$t = DB::table('tes_tertulis');
		$soal = $t->findOneBy([
			'no_registrasi' => $noReg,
			'id'            => $id,
		]);

		if (! is_array($soal))
		{
			return;
		}

		$poin = $answer === $soal['kunci_jawaban']
			? $this->user['tests']['poin_tes_tertulis']
			: 0;

		$t->updateBy([
			'waktu_jawab' => date('Y-m-d H:i:s'),
			'jawaban'     => $answer,
			'poin'        => $poin,
		], [
			'no_registrasi' => $noReg,
			'id'            => $id,
		]);
	}

	public function update()
	{
		if ($posts = $this->request->getPost())
		{
			$r = DB::table('registrasi');

			if (isset($posts['sisa_waktu_tertulis']))
			{
				$r->updateBy([
					'sisa_waktu_tertulis' => $posts['sisa_waktu_tertulis'],
				], [
					'no_registrasi' => $this->user['peserta']['no_registrasi'],
				]);

				unset($posts['sisa_waktu_tertulis']);
			}

			if (isset($posts['jawaban'])
				&& isset($posts['key']))
			{
				$this->saveAnswer($posts['key'], $posts['jawaban']);
			}
		}
	}

	public function praktik()
	{
		$timerPraktik = $this->user['peserta']['sisa_waktu_praktik'];

		$r = DB::table('registrasi');

		if (empty($timerPraktik))
		{
			$lastPage = '/test/selesai';

			$r->updateBy([
				'last_page' => $lastPage,
			], [
				'no_registrasi' => $this->user['peserta']['no_registrasi'],
			]);

			return redirect()->to($lastPage);
		}
		else
		{
			$r->updateBy([
				'last_page' => '/test/praktik',
			], [
				'no_registrasi' => $this->user['peserta']['no_registrasi'],
			]);

			$this->themes
				->setTemplate('normal')
				->loadPlugins('websocket, countdown')
				->addJS('test/tes_praktik.js')
				::render('test/test-praktik', [
					'timer' => $timerPraktik,
				]);
		}
	}

	public function selesai()
	{
		$this->themes
			->setTemplate('normal')
			->loadPlugins('alert')
			->addJS('test/finish.js')
			::render('test/finish');
	}

	public function validateAccess()
	{
		$return = [
			'success'  => false,
			'msg'      => 'Password tidak benar!',
			'redirect' => '',
		];

		if ($pass = $this->request->getPost('pass'))
		{
			$return['success']  = $pass === $this->settings->secretKey;
			$return['redirect'] = site_url('test/upload');

			session()->set('uploadAllowed', true);
		}

		return $this->response->setJSON($return);
	}

	public function upload()
	{
		if (! session()->get('uploadAllowed'))
		{
			return redirect()->to('/test/selesai');
		}

		$p = DB::table('tes_praktik');

		$files = $p->findBy([
			'no_registrasi' => $this->user['peserta']['no_registrasi'],
		]);

		$this->themes
			->setTemplate('normal')
			->loadPlugins('fileinput')
			->addJS('test/upload.js')
			::render('test/upload', [
				'files' => $files,
			]);
	}

	public function uploadFiles()
	{
		$return = [
			'error'                   => '',
			'initialPreview'          => [],
			'initialPreviewConfig'    => [],
			'initialPreviewThumbTags' => [],
		];

		$posts = $this->request->getPost();
		$files = $this->request->getFiles();

		/* 
		POSTS
		array (size=13)
		  'chunkCount' => string '1' (length=1)
		  'chunkIndex' => string '0' (length=1)
		  'chunkSize' => string '2097152' (length=7)
		  'chunkSizeStart' => string '0' (length=1)
		  'fileId' => string '16114_PETUNJUK_20PENGERJAAN_20TES_20TERTULIS.docx' (length=49)
		  'fileName' => string 'PETUNJUK PENGERJAAN TES TERTULIS.docx' (length=37)
		  'fileRelativePath' => string 'PETUNJUK PENGERJAAN TES TERTULIS.docx' (length=37)
		  'fileSize' => string '16114' (length=5)
		  'retryCount' => string '0' (length=1)
		  'initialPreview' => string '[]' (length=2)
		  'initialPreviewConfig' => string '[]' (length=2)
		  'initialPreviewThumbTags' => string '[]' (length=2)
		  'uploadToken' => string 'SOME-TOKEN' (length=10)

		$_FILES
		array (size=1)
		  'fileBlob' => 
		    object(CodeIgniter\HTTP\Files\UploadedFile)[168]
		      protected 'path' => string 'D:\wamp64\tmp\php8333.tmp' (length=25)
		      protected 'originalName' => string 'PETUNJUK PENGERJAAN TES TERTULIS.docx' (length=37)
		      protected 'name' => string 'PETUNJUK PENGERJAAN TES TERTULIS.docx' (length=37)
		      protected 'originalMimeType' => string 'application/octet-stream' (length=24)
		      protected 'error' => int 0
		      protected 'hasMoved' => boolean false
		      protected 'size' => int 16114
		      private 'pathName' (SplFileInfo) => string 'D:\wamp64\tmp\php8333.tmp' (length=25)
		      private 'fileName' (SplFileInfo) => string 'php8333.tmp' (length=11)

	  */

		$uploadPath = $this->uploadWritePath . $this->user['peserta']['kode_test'];

		if (! is_dir($uploadPath))
		{
			mkdir($uploadPath, 0755);
		}

		$uploadPath = $uploadPath . '/' . $this->user['peserta']['no_registrasi'];

		if (! is_dir($uploadPath))
		{
			mkdir($uploadPath, 0755);
		}

		$p = DB::table('tes_praktik');

		foreach ($files as $file)
		{
			if ($file->isValid() && ! $file->hasMoved())
			{
				if ($file->move($uploadPath))
				{
					$filename = $file->getName();
					$extFile  = pathinfo($filename, PATHINFO_EXTENSION);

					$p->insert([
						'no_registrasi' => $this->user['peserta']['no_registrasi'],
						'tipe'          => $extFile,
						'filename'      => $filename,
						'waktu_unggah'  => date('Y-m-d H:i:s'),
					]);
				}
			}
			else
			{
				$return['error'] = $file->getErrorString() . '(' . $file->getError() . ')';
			}
		}
		
		return $this->response->setJSON($return);
	}

	public function files($filename)
	{
		$this->filePath = $this->uploadWritePath . $this->user['peserta']['kode_test'] . '/' . $this->user['peserta']['no_registrasi'] . '/';

		return parent::files($this->filePath . $filename);
	}
}
