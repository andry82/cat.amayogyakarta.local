<form class="form-signin" method="post">
	<h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>

	<label for="inputEmail" class="sr-only">Email address</label>
	<input type="email" name="email" id="inputEmail" class="form-control" value="<?= old('email') ?>" placeholder="Email address" required autofocus>

	<label for="inputPassword" class="sr-only">Password</label>
	<input type="password" name="password" id="inputPassword" class="form-control" value="<?= old('password') ?>" placeholder="Password" required>

	<div class="checkbox mb-3">
		<label>
			<input type="checkbox" name="remember" value="1">
			Remember me
		</label>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	<div class="mt-3">
		Forgot password? <a href="<?= route_to('reset-password') ?>">Reset here</a>
	</div>
	<p class="mt-2 mb-3 text-muted text-center">&copy; 2020</p>
</form>