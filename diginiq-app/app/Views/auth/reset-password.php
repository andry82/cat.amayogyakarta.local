<form class="form-signin" method="post">
	<h1 class="h3 mb-3 font-weight-normal text-center">Reset Password</h1>

	<input type="hidden" name="token" value="<?=old('token', $token);?>">

	<label for="inputPassword" class="sr-only">New Password</label>
	<input type="password" name="password" id="inputPassword" value="<?= old('password') ?>" class="form-control" placeholder="New Password" required>

	<label for="inputConfirmPassword" class="sr-only">Confirm New Password</label>
	<input type="password" name="confirmPassword" id="inputConfirmPassword" value="<?= old('confirmPassword') ?>" class="form-control" placeholder="Confirm your new Password" required>

	<button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
	<p class="mt-2 mb-3 text-muted text-center">&copy; 2020</p>
</form>