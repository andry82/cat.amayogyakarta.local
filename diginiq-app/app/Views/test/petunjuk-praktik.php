  <div class="col-12 col-md-6 text-right">
    <img src="<?=$theme_url?>images/undraw_profile_pic_ic-5-t.svg" alt="" height="200" class="img-fluid-x animate__animated animate__headShake animate__slower">
  </div>
  <div class="col-12 col-md-6">
    <h2>Biodata Peserta</h2>
    <ul class="list-unstyled">
      <li class="row"><span class="d-block col-12 col-sm-3">No. Registrasi</span><span class="d-block col-12 col-sm-9">: <?=$user['peserta']['no_registrasi']?></span></li>
      <li class="row"><span class="d-block col-12 col-sm-3">Nama Lengkap</span><span class="d-block col-12 col-sm-9">: <?=$user['peserta']['nama_lengkap']?>
      </span></li>
      <li class="row"><span class="d-block col-12 col-sm-3">Kode Test</span><span class="d-block col-12 col-sm-9">: <?=$user['peserta']['kode_test']?></span></li>
      <li class="row"><span class="d-block col-12 col-sm-3">Desa</span><span class="d-block col-12 col-sm-9">: <?=$user['peserta']['nama_desa']?></span></li>
      <li class="row"><span class="d-block col-12 col-sm-3">Skor Tes Tertulis</span><span class="d-block col-12 col-sm-9">: <?=$poin?></span></li>
    </ul>
  </div>
</div>

<div class="col align-items-start mt-4">
    <div class="alert alert-warning mb-4 animate__animated animate__flash" role="alert">
      <h2 class="text-center">TES PRAKTIK</h2>
	  <div class="mb-4">
	      <h3>Petunjuk Pengerjaan Soal</h3>
	      <ol>
		  	<li>Sebelum mulai mengerjakan soal tes tertulis pastikan kembali Biodata anda telah benar.</li>
			<li>Soal tes tertulis berjumlah 50 soal pilihan ganda yang tersaji secara acak oleh sistem komputer (CAT).</li>
			<li>Untuk menjawab soal, pilihlah salah satu jawaban yang menurut anda benar dengan cara mengklik pada jawaban tersebut.</li>
			<li>Waktu pengerjaan tes tertulis adalah 30 menit di mulai ketika mengklik tombol “Mulai Test Tertulis”.</li>
			<li>Jika anda telah selesai menjawab seluruh soal, silahkan klik tombol “selesai” untuk mengirim jawaban dan melihat skor tes tertulis anda.</li>
			<li>Jawaban tes tertulis akan terkirim otomatis jika waktu pengerjaan telah habis meskipun anda belum selesai menjawab seluruh soal tes tertulis.</li>
	      </ol>
	    </div>
    </div>
   
	<div class="d-flex justify-content-center">
	    <a href="<?=site_url('test/praktik')?>" class="btn px-4 btn-warning btn-lg">MULAI TES PRAKTIK</a>
	</div>
  </div>