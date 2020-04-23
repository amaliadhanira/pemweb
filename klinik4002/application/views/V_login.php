<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<link href="<?= base_url('assets/css/bootstrap.css')?>" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="col">
			<form action="<?= site_url('login/auth') ?>" method="post">
				<div class="form-group">
					<h2>Login</h2>
					<?php if ($this->session->flashdata('error_msg')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error_msg'); ?>
					</div>
					<?php endif; ?>

					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control">
					</div>
					
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" name="remember" id="remember-me">
						<label class="form-check-label" for="remember-me">Remember me</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				</div>
			</form>
		</div>
	</div>

	<script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
</body>
</html>