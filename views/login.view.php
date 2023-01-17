<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Poliklinik 2017</title>
	<link rel="stylesheet" href="public/assets/css/form-login.css">
</head>
<body>
	<div class="form-login">
		<div class="header">
			<div class="logo-header">
				<img class="icon" src="public/assets/img/hospital.svg" alt="">
			</div>
		</div>
		<div class="body">
			<?php if (isset($_SESSION['fail'])): ?>
			<div class="alert alert-danger">
				<?= $_SESSION['fail'] ?>
				<?php unset($_SESSION['fail']) ?>
			</div>
			<?php endif ?>
			<form action="?c=auth&m=authenticate" method="POST">
				<div class="form-group">
					<input type="text" name="username" class="form-input" placeholder="Username">
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-input" placeholder="Password">
				</div>
				<div class="form-group">
					<button type="submit" class="btn-login">Login</button>
				</div>
			</form>
		</div>
		<div class="footer">
			<p class="copyright">&copy; RPL Programmer Team</p>
		</div>
	</div>
</body>
</html>