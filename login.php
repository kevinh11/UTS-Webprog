<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>U12</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<header class="navbar navbar-expand-lg navbar-light">
		<div class="container">
			<a class="navbar-brand" href="#"><img src="logo.png" alt="Logo"></a>
			<nav class="navbar-nav mr-3">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="#">Menu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Promo</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Events</a>
					</li>
				</ul>
			</nav>
			<div class="navbar-text ms-auto">
				Lokasi
			</div>
		</div>
	</header>
	<div>
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="text-center">
						<h1>Login</h1>
					</div>
					<form action="login.php" method="post">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" name="username" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" required>
						</div>
						<button type="submit" class="btn btn-info mt-3">Sign in</button>
						<a class="btn btn-outline-dark ml-3 mt-3" href="/users/googleauth" role="button" style="text-transform:none">
							<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
							Sign in with Google
						</a>
						<!-- NI TOLOL BET TOMBOL GOOGLENYA WKAOWKAOKWOKAW
					BLOM ACTUALLY USE API AND SHIT OBV-->
					</form>
					<div class="text-center mt-3">
						<p>Tidak punya akun? <a href="signup.php" id="anchor">Bikin akun baru aja!</a></p>
					</div>

					<?php
						session_start();
						function generate_captcha() {
							$all = str_split('abcdefghijklmnopqrstuvwxyz0123456789');
							$length = rand(6,10);
							$captcha = '';	

							for ($i = 0; $i < $length; $i++) {
								$rand = rand(0, count($all)-1);
								$char = $all[$rand];
								shuffle($all);
								if ($rand > floor(0.7 * count($all)-1)) {
									$char = strtoupper($char);
								}
								$captcha = $captcha . $char;
							}
							echo $captcha;
							$_SESSION['captcha'] = $captcha;
						}

						generate_captcha();
					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>