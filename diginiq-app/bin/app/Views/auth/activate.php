<form class="form-signin" method="post">
	<h1 class="h3 mb-3 font-weight-normal text-center">Enter Activation Key</h1>

	<label for="inputToken" class="sr-only">Activation Key</label>
	<input type="text" name="token" id="inputToken" class="form-control" value="<?= old('token', $token) ?>" placeholder="Activation Key" required autofocus>

	<button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Activate</button>

	<div class="mt-3">
		Lost they key? <a href="<?= site_url('activation-request') ?>">Request new here</a>
	</div>
	<p class="mt-2 mb-3 text-muted text-center">&copy; 2020</p>
</form>