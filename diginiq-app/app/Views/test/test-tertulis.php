<div class="col-12 col-md-3 order-md-2">
	<div class="sticky-top">
		<hr>
		<div class="countdown-timer text-center">
		  <span><i class="fa-regular fa-clock"></i> Timer</span><br>
		  <span id="textTime" class="font-weight-bold display-4 text-danger">00:00:00</span>
		</div>
		<hr>
		<div class="pager-controller text-center mt-3">
		  <a href="#" id="btnSelesai" class="btn btn-lg btn-block btn-primary font"><i class="fa-solid fa-check"></i> SELESAI</a>
		</div>
    <hr>
        <!-- Tambahan Andry -->
        <div class="question-indicator mb-3">
          <?php foreach ($soal as $s) : 
            $state = empty($s['jawaban']) ? 'not-done' : 'done'; ?>
            <button type="button" class="btn btn-sm indicator <?=$state?>" data-target="pertanyaan_<?=$s['id'] . '_' . $s['nomor']?>" data-index="<?=$s['nomor']?>" aria-label="Soal <?=$s['nomor']?>"><?=$s['nomor']?></button>
          <?php endforeach; ?>
        </div>
        <!-- Tambahan Andry --> 
	</div>
</div>

<div class="col-12 col-md-9 order-md-1">
  <h2></h2>

  <div class="card shadow">
    <div class="card-body text-left">
      <form id="form-test">
      <input type="hidden" name="jml_soal" id="jml_soal" value="<?=count($soal)?>">
      <input type="hidden" name="sisa_waktu_tertulis" id="sisa_waktu_tertulis">
      <input type="hidden" id="no_registrasi" name="no_registrasi" value="<?=$user['peserta']['no_registrasi']?>">
        <div class="alert alert-info d-flex justify-content-center mb-3">
          <button type="button" class="btn btn-outline-secondary d-none"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
          <button type="button" class="btn btn-outline-secondary d-none" disabled>Berikutnya <i class="fa-solid fa-arrow-right"></i></button>
      <h4 class="text-center"><i class="fas fa-exclamation-triangle fa-3x"></i> Perhatikan!</h4><br>
      <ul>
        <li>Periksa ulang jawaban Anda sebelum klik tombol "SELESAI" karena Anda tidak bisa kembali ke halaman ini setelah klik SELESAI</li>
        <li>Perhatikan batas waktu pengerjaan soal karena jawaban akan terkirim otomatis jika waktu pengerjaan telah habis meskipun anda belum selesai menjawab seluruh soal tes tertulis.</li>
      </ul>
        </div>
        <hr>
        <ol class="list-soal ml-0 pl-3">
        <?php foreach ($soal as $s) : 
        $liClass = empty($s['jawaban']) ? 'not-done' : 'done'; ?>
          <li class="mb-4 item-soal <?=$liClass?>" id="pertanyaan_<?=$s['id'] . '_' . $s['nomor']?>">
            <p><?=$s['pertanyaan']?></p>
            <div class="list-jawaban">
              <div class="form-check">
                <input class="form-check-input jawaban" type="radio" data-key="<?=$s['id']?>" name="jawaban_<?=$s['id']?>" id="jawaban_<?=$s['id']?>_a" value="a" <?=checked_data('jawaban', 'a', $s)?>>
                <label class="form-check-label" for="jawaban_<?=$s['id']?>_a">
                  a. <?=$s['a']?>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input jawaban" type="radio" data-key="<?=$s['id']?>" name="jawaban_<?=$s['id']?>" id="jawaban_<?=$s['id']?>_b" value="b" <?=checked_data('jawaban', 'b', $s)?>>
                <label class="form-check-label" for="jawaban_<?=$s['id']?>_b">
            b. <?=$s['b']?>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input jawaban" type="radio" data-key="<?=$s['id']?>" name="jawaban_<?=$s['id']?>" id="jawaban_<?=$s['id']?>_c" value="c" <?=checked_data('jawaban', 'c', $s)?>>
                <label class="form-check-label" for="jawaban_<?=$s['id']?>_c">
            c. <?=$s['c']?>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input jawaban" type="radio" data-key="<?=$s['id']?>" name="jawaban_<?=$s['id']?>" id="jawaban_<?=$s['id']?>_d" value="d" <?=checked_data('jawaban', 'd', $s)?>>
                <label class="form-check-label" for="jawaban_<?=$s['id']?>_d">
            d. <?=$s['d']?>
                </label>
              </div>
            </div>
          </li>
      <?php endforeach; ?>
        </ol>
        <div class="d-none justify-content-between mt-3">
          <button type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
          <button type="button" class="btn btn-outline-secondary" disabled>Berikutnya <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </form>
    </div>
  </div>

</div>
<script>
	var timer = <?=$timer?>; // in minutes
</script>
<!-- Tambahan Andry -->
<style>
  /* grid layout indikator nomor soal */
  .question-indicator {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(36px, 1fr));
    gap: 6px;
  }
  
  .indicator {
    padding: 3px 3px !important;
    font-size: 13px;
    font-weight: 600;
    min-width: 30px;
    min-height: 30px;
    border-radius: 4px;
    border: 1px solid #dee2e6;
    background-color: #f8f9fa;
    color: #212529;
    transition: all 0.3s ease;
  }
  
  .indicator.done { 
    background-color: #28a745; 
    color: #fff; 
    border-color: #28a745;
  }
  
  .indicator.not-done { 
    background-color: #d91010ff; 
    color: #fff;
    border-color: #d91010ff;
  }
  
  .indicator.active { 
    box-shadow: 0 0 0 3px rgba(0,123,255,.25);
    border-color: #007bff;
  }
  
  .indicator:hover {
    transform: scale(1.05);
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const indicators = document.querySelectorAll('.indicator');
  const radios = document.querySelectorAll('.jawaban');

  // klik indikator -> scroll ke soal
  indicators.forEach(btn => {
    btn.addEventListener('click', function(){
      const targetId = this.getAttribute('data-target');
      const el = document.getElementById(targetId);
      if (el) {
        el.scrollIntoView({behavior:'smooth', block:'center'});
        indicators.forEach(b=>b.classList.remove('active'));
        this.classList.add('active');
      }
    });
  });

  // update status saat jawaban dipilih
  radios.forEach(r => {
    r.addEventListener('change', function(){
      const li = this.closest('.item-soal');
      if (!li) return;
      const id = li.id;
      // toggle kelas di list item
      li.classList.remove('not-done'); li.classList.add('done');

      // update indikator sesuai id
      const targetBtn = document.querySelector('.indicator[data-target="' + id + '"]');
      if (targetBtn) {
        targetBtn.classList.remove('not-done');
        targetBtn.classList.add('done');
      }
    });
  });

  // optional: set first indicator active
  if (indicators.length) indicators[0].classList.add('active');
});
</script>
<!-- Tambahan Andry -->
<div class="modal fade" id="finish-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Perhatian</h5>
      </div>
      <div class="modal-body">
         <p>Saat ini jaringan koneksi internet sedang tidak stabil. </p>
		 <p>Jangan tutup browser ini, sistem sedang menyimpan jawaban anda dan akan segera mengirimkan ke server begitu terhubung kembali dengan internet.</p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
