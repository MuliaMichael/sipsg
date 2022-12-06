<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Login Admin</title>
	<link href="css/styles.css" rel="stylesheet" />
	<script src="<?= base_url() ?>https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="<?= base_url() ?>https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="<?= base_url() ?>stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">
</head>
<div class="row">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="card-header">
					<h3 class="text-center font-weight-dark my-10"><?= lang('Auth.loginTitle') ?></h3>
				</div>
				<div class="card-body">
					<?= view('Myth\Auth\Views\_message_block') ?>
					<form action="<?= route_to('login') ?>" method="POST">

						<div class="form-floating mb-3">
							<?php if ($config->validFields === ['email']) : ?>
								<div class="form-group">
									<label for="login"><?= lang('Auth.email') ?></label>
									<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
									<div class="invalid-feedback">
										<?= session('errors.login') ?>
									</div>
								</div>
							<?php else : ?>
								<div class="form-group">
									<label for="login"><?= lang('Auth.emailOrUsername') ?></label>
									<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
									<div class="invalid-feedback">
										<?= session('errors.login') ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="form-floating mb-3">
							<div class="form-group">
								<label for="password"><?= lang('Auth.password') ?></label>
								<input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
								<div class="invalid-feedback">
									<?= session('errors.password') ?>
								</div>
							</div>

							<?php if ($config->allowRemembering) : ?>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
										<?= lang('Auth.rememberMe') ?>
									</label>
								</div>
							<?php endif; ?>
						</div>

						<?php if ($config->activeResetter) : ?>
							<div>
								<p><a href="<?= route_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
							</div>
						<?php endif; ?>
						<button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>

				</div>
			</div>
		</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<div id="layoutAuthentication_footer">
	<footer class="py-4 bg-light mt-auto">
		<div class="container-fluid px-4">
			<div class="d-flex align-items-center justify-content-between small">
				<div class="text-muted">Copyright &copy; Your Website 2022</div>
				<div>
					<a href="#">Privacy Policy</a>
					&middot;
					<a href="#">Terms &amp; Conditions</a>
				</div>
			</div>
		</div>
</div>
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="<?= base_url() ?>js/popper.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>js/main.js"></script>

</body>

</html>