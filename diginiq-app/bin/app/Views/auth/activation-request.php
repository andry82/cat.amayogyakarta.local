<form class="form-signin" method="post">
	<h1 class="h3 mb-3 font-weight-normal text-center">Enter Registered Email</h1>

	<label for="inputEmail" class="sr-only">Activation Key</label>
	<input type="email" name="email" id="inputEmail" class="form-control" value="<?= old('email') ?>" placeholder="Email address" required autofocus>

	<button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Send Activation Request</button>

	<div class="mt-3">
		Already have a key? <a href="<?= site_url('activate') ?>">Activate here</a>
	</div>
	<p class="mt-2 mb-3 text-muted text-center">&copy; 2020</p>
</form>