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
                        <h1>Sign Up</h1>
                    </div>
                    <!-- form actions masih kurang tau gw -->
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="signUpFirst">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" name="signUpLast">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="signUpEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="signUpPass" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPass" required>
                        </div>
                        <?php generate_captcha() ?>
                        <div class="form-group mt-2">
                            <label for="captcha">Verify You are not a Bot: </label>
                            <input type="text" class="form-control" name="signUpCaptcha" required>
                        </div>
                        <button type="submit" class="btn btn-info mt-3">Sign Up</button>
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
                        echo $captcha;
                        $_SESSION['captcha'] = $captcha;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'webprog'); //isi nama database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userCaptcha = $_POST['captcha'];
        $generatedCaptcha = $_SESSION['captcha'];

        if ($userCaptcha !== $generatedCaptcha) {
            echo "CAPTCHA verification failed. Please enter the correct CAPTCHA.";
        } else {
            $firstName = isset($_POST['signUpFirst']) ? $_POST['signUpFirst'] : NULL;
            $lastName = isset($_POST['signUpLast']) ? $_POST['signUpLast'] : NULL;
            $email = $_POST['signUpEmail'];
            $password = $_POST['signUpPass'];
            $confirmPassword = $_POST['confirmPass'];

            if ($password !== $confirmPassword) {
                echo "Passwords do not match. Please try again.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $query = "INSERT INTO users (user_first, user_last, user_email, user_pass) VALUES (?, ?, ?)";
                $insertStatement = $conn->prepare($query);
                $insertStatement->bind_param("sss", $username, $email, $hashedPassword);

                if ($insertStatement->execute()) {
                    header('Location: user.php'); //admin ngga register kn?
                    exit;
                } else {
                    echo "Registration failed: " . $conn->error;
                }

                $conn->close();
            }
        }
    }
    ?>

</body>

</html>