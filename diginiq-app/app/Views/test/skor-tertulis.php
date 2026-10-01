<div class="col-12 col-md-6 text-center">
	<img src="<?=$theme_url?>images/selesai-cat.png" alt="" height="250px" class="img-fluid-x mb-3 animate__animated animate__pulse">
	<h3 class="display-4 text-center animate__animated animate__tada">Tes Tertulis sudah selesai<br>Skor Tes Tertulis</h3>
	<p class="h1 text-center mb-4 text-center animate__animated animate__fadeInDown animate__delay-1s"><strong class="text-success"><?=$poin?></strong></p>

	<?php /* if ($user['tests']['ada_tes_praktik']) : ?>
	<a href="<?=site_url('petunjuk/praktik')?>" class="btn btn-lg btn-warning text-uppercase px-4">Lanjut Tes Praktik</a>
	<?php endif; */ ?>
</div>
<input type="hidden" id="no_registrasi" name="no_registrasi" value="<?=$user['peserta']['no_registrasi']?>">