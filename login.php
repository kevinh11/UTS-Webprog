<?php
	include('components/header.php');
?>

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
		<div class="container mt-5 d-flex flex-column justify-content-center ">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="text-center">
						<h1>Login</h1>
					</div>
					<form action="login.php" method="post" id='loginForm'>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="loginEmail" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="loginPass" required>
						</div>
						<!-- NI TOLOL BET TOMBOL GOOGLENYA WKAOWKAOKWOKAW-->
						<div class="form-group">
							<label for="captcha">Verify You are not a Bot:</label>
							<input type="text" id='captchaForm' class="form-control" name="loginCaptcha" required>
						</div>
					</form>
					<?php
					session_start();
					function generate_captcha()
					{
						$all = str_split('abcdefghijklmnopqrstuvwxyz0123456789');
						$length = rand(6, 10);
						$captcha = '';

						for ($i = 0; $i < $length; $i++) {
							$rand = rand(0, count($all) - 1);
							$char = $all[$rand];
							shuffle($all);
							if ($rand > floor(0.7 * count($all) - 1)) {
								$char = strtoupper($char);
							}
							$captcha = $captcha . $char;
						}
						echo "<p id='captcha'>$captcha</p>";
						$_SESSION['captcha'] = $captcha;
					}

					generate_captcha();
					?>

			<?php
			$conn = mysqli_connect('localhost', 'root', '', 'restaurant');//ganti nama database

			if (isset($_POST['loginPass'])) {
				$email = $_POST['loginEmail'];
				$pass = $_POST['loginPass'];

				$attempts = 

				$query = "SELECT admin_pass FROM admin WHERE admin_email = ?";
				$admin_check = $conn->prepare($query);
				$admin_check->bind_param("s", $email);
				$admin_check->execute();
				$admin_check->bind_result($hashedPass);
				$admin_result = $admin_check->fetch();

				$query = "SELECT user_pass FROM user WHERE user_email = ?";
				$user_check = $conn->prepare($query);
				$user_check->bind_param("s", $email);
				$user_check->execute();
				$user_check->bind_result($hashedPass);
				$user_result = $user_check->fetch();

				if ($admin_result && password_verify($pass, $hashedPass)) {
					header('Location:admin.php');
					setcookie('loggedIn', true, time() + (86400 * 7));
					setcookie('userStatus', 'admin', time() + (86400 * 7));
					exit;
				} elseif ($user_result && password_verify($pass, $hashedPass)) {
					setcookie('loggedIn', true, time() + (86400 * 7));
					setcookie('userStatus', 'customer', time() + (86400 * 7));

					header('Location:user.php');
					exit;
				} else {
					echo "<p class='text-danger'>Login failed. Please check your email and password.</p>";
				}
			}
			?>

				<button type="submit" class="btn btn-info mt-3">Log In</button>
					<a class="btn btn-outline-dark ml-3 mt-3" href="/users/googleauth" role="button" style="text-transform:none">
						<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
						Sign in with Google
					</a>
					<div class="text-center mt-3">
						<p>Tidak punya akun? <a href="signup.php" id="anchor">Bikin akun baru aja!</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		include('components/footer.php');
	?>

	<script src='jsFiles/captcha.js'></script>
</body>
				
</html>

