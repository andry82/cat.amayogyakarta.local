<div class="col-12 col-md-3">
	<img src="<?=$theme_url?>images/login_admin.png" alt="" class="img-fluid animate__animated animate__headShake animate__slower">
</div>
<div class="col-12 col-md-5">
        <div class="row">
        <div class="col s12">
          <p class="red-text"><?=session()->getFlashdata('message')?></p>
        </div>
      </div>
  <?=form_open('/login-as', 'role="form" class="form-signin"')?>
		<h1 class="h3 mb-3 font-weight-normal text-center"></h1>

		<div class="mb-3">
	        <label for="inputEmail" class="form-label">Login ID</label>
	        <input type="text" class="form-control" id="inputEmail" name="email" value="<?= old('email') ?>" required autofocus>
	    </div>

		<div class="mb-3">
	        <label for="inputPassword" class="form-label">Password</label>
	        <input type="password" class="form-control" id="inputPassword" name="password" value="<?= old('password') ?>" required autofocus>
	    </div>

		<div class="mb-3">
	        <label for="target_user" class="form-label">Target user</label>
	        <input type="text" class="form-control" id="target_user" name="target_user" value="<?= old('target_user') ?>" required autofocus>
	    </div>

		<div class="mt-4">
			<button class="btn btn-lg btn-success" type="submit">MASUK</button>
		</div>
	</form>
</div>