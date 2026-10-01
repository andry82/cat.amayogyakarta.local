<div class="col-12 col-md-9">
  <div class="card shadow pl-4">
    <div class="card-body text-left px-5">
      <div class="alert alert-warning d-flex justify-content-center mb-3">
        <h4 class="text-center">Hasil Skor Tes Tertulis <strong><?=$skor?></strong></h4>
      </div>
        <hr>
        <ol class="list-soal ml-0 pl-3">
        <?php foreach ($soal as $s):
        $liClass = empty($s['jawaban']) ? 'not-done' : 'done'; ?>
          <li class="mb-4 item-soal <?=$liClass?>" id="pertanyaan_<?=$s['id'] . '_' . $s['nomor']?>">
            <p><?=$s['pertanyaan']?></p>
            <div class="list-jawaban">
              <label class="px-3 <?=$s['kunci_jawaban'] === 'a' ? 'text-success' : ''?> <?=$s['jawaban'] === $s['kunci_jawaban'] && $s['jawaban'] === 'a' ? 'border border-success' : ($s['jawaban'] === 'a' ? 'border border-danger' : '')?>">
                a. <?=$s['a']?>
              </label><br>
              <label class="px-3 <?=$s['kunci_jawaban'] === 'b' ? 'text-success' : ''?> <?=$s['jawaban'] === $s['kunci_jawaban'] && $s['jawaban'] === 'b'? 'border border-success' : ($s['jawaban'] === 'b' ? 'border border-danger' : '')?>">
                b. <?=$s['b']?>
              </label><br>
              <label class="px-3 <?=$s['kunci_jawaban'] === 'c' ? 'text-success' : ''?> <?=$s['jawaban'] === $s['kunci_jawaban'] && $s['jawaban'] === 'c' ? 'border border-success' : ($s['jawaban'] === 'c' ? 'border border-danger' : '')?>">
                c. <?=$s['c']?>
              </label><br>
              <label class="px-3 <?=$s['kunci_jawaban'] === 'd' ? 'text-success' : ''?> <?=$s['jawaban'] === $s['kunci_jawaban'] && $s['jawaban'] === 'd'? 'border border-success' : ($s['jawaban'] === 'd' ? 'border border-danger' : '')?>">
                d. <?=$s['d']?>
              </label>
            </div>
          </li>
      <?php endforeach; ?>
        </ol>
        <div class="justify-content-between mt-3">
          <hr>
          <h4>Keterangan</h4>
          <hr>
          <label class="text-success mb-2">
            Teks hijau adalah jawaban yang benar 
          </label><br>
          <label class="text-success border border-success px-3 mb=-2">
            Teks hijau dengan kotak hijau berarti pilihan jawaban benar
          </label><br>
          <label class="border border-danger px-3">
            Teks dengan kotak merah berarti pilihan jawaban salah
          </label>
        </div>
      </form>
    </div>
  </div>
</div>