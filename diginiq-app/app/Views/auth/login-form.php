<div class="col-12 col-md-3">
	<img src="<?=$theme_url?>images/login_admin.png" alt="" class="img-fluid animate__animated animate__headShake animate__slower">
</div>
<div class="col-12 col-md-5">
	<form class="form-signin" method="post">
		<h1 class="h3 mb-3 font-weight-normal text-center"></h1>

		<div class="mb-3">
	        <label for="inputEmail" class="form-label">Login ID</label>
	        <input type="text" class="form-control" id="inputEmail" name="email" value="<?= old('email') ?>" required autofocus>
	    </div>

		<div class="mb-3">
	        <label for="inputPassword" class="form-label">Password</label>
	        <input type="password" class="form-control" id="inputPassword" name="password" value="<?= old('password') ?>" required autofocus>
	    </div>

		<div class="checkbox mb-3 d-none">
			<label>
				<input type="checkbox" name="remember" value="1">
				Remember me
			</label>
		</div>

		<div class="mt-4">
			<button class="btn btn-lg btn-success" type="submit">MASUK</button>
		</div>

		<div class="mt-3 d-none">
			Forgot password? <a href="<?= route_to('reset-password') ?>">Reset here</a>
		</div>
	</form>
</div>