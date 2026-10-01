<div class="col-12 text-center mb-3">
	<h2 class="mb-5">Soal Praktik</h2>
	<div class="col-12 my-4 countdown-timer text-center">
	  <span class=""><i class="fa-regular fa-clock"></i> Timer</span><br>
	  <span id="textTime" class="font-weight-bold display-4 text-danger">00:00:00</span>
	</div>
	<input type="hidden" id="no_registrasi" name="no_registrasi" value="<?=$user['peserta']['no_registrasi']?>">
</div>
<div class="col-12 col-md-3 text-center">
	<a href="" class="btn text-primary">
	  <i class="fa-solid fa-file-word display-3 mb-2"></i><br>
	  <span class="h4">Ms Word</span>
	</a>
	</div>
	<div class="col-12 col-md-3 text-center">
	<a href="" class="btn text-success">
	  <i class="fa-solid fa-file-excel display-3 mb-2"></i><br>
	  <span class="h4">Ms Excel</span>
	</a>
	</div>
	<div class="col-12 col-md-3 text-center">
	<a href="" class="btn text-warning">
	  <i class="fa-solid fa-file-powerpoint display-3 mb-2"></i><br>
	  <span class="h4">Ms PowerPoint</span>
	</a>
	</div>
	<div class="col-12 col-md-3 text-center">
	<a href="" class="btn text-secondary">
	  <i class="fa-solid fa-envelope-open display-3 mb-2"></i><br>
	  <span class="h4">Email</span>
	</a>
</div>
<script>
	var timer = <?=$timer?>; // in minutes
</script>