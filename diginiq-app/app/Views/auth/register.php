<form class="form-signin" method="post">
	<h1 class="h3 mb-3 font-weight-normal text-center">Registration</h1>

	<label for="inputUsername" class="sr-only">Username</label>
	<input type="text" name="username" id="inputUsername" class="form-control" value="<?= old('username') ?>" placeholder="Username" required autofocus>

	<label for="inputFullname" class="sr-only">Fullname</label>
	<input type="text" name="fullname" id="inputFullname" class="form-control" value="<?= old('fullname') ?>" placeholder="Full Name" required autofocus>

	<label for="inputEmail" class="sr-only">Email address</label>
	<input type="email" name="email" id="inputEmail" class="form-control" value="<?= old('email') ?>" placeholder="Email address" required autofocus>

	<label for="inputPassword" class="sr-only">Password</label>
	<input type="password" name="password" id="inputPassword" value="<?= old('password') ?>" class="form-control" placeholder="Password" required>

	<label for="inputConfirmPassword" class="sr-only">Password</label>
	<input type="password" name="confirmPassword" id="inputConfirmPassword" value="<?= old('confirmPassword') ?>" class="form-control" placeholder="Confirm your Password" required>

	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	<p class="mt-2 mb-3 text-muted text-center">&copy; 2020</p>
</form>