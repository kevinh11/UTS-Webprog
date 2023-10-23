<?php
include('components/header.php');
?>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class='login-page'>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center">
                        <h1>Sign Up</h1>
                    </div>
                    <form action="signup.php" method="post">
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
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPass" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="birthDate" name="signUpBirthDate" required>
                        </div>
                        <div class="form-check mb-3 mt-3">
                            <label>Jenis Kelamin: </label>
                        <div class="form-check">
                            <label class="form-check-label" for="jenisKelamin">Laki-Laki</label>
                            <input type="radio" class="form-check-input" id="jenisKelamin" name="signUpGender" value="M">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="jenisKelamin">Perempuan</label>
                            <input type="radio" class="form-check-input" id="jenisKelamin" name="signUpGender" value="F">
                        </div>
                        </div>
                        <?php generate_captcha() ?>
                        <input type="hidden" name="generatedCaptcha" value="<?php echo $_SESSION['captcha']; ?>">
                        <div class="form-group mt-2">
                            <label for="signUp">Verify You are not a Bot: </label>
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
    $conn = mysqli_connect('localhost', 'root', '', 'restaurant');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userCaptcha = $_POST['signUpCaptcha'];
        $generatedCaptcha = $_POST['generatedCaptcha'];

        if ($userCaptcha !== $generatedCaptcha) {
            echo "CAPTCHA verification failed. Please enter the correct CAPTCHA.";
        } else {
            $firstName = isset($_POST['signUpFirst']) ? $_POST['signUpFirst'] : NULL;
            $lastName = isset($_POST['signUpLast']) ? $_POST['signUpLast'] : NULL;
            $email = $_POST['signUpEmail'];
            $password = $_POST['signUpPass'];
            $confirmPassword = $_POST['confirmPass'];
            $tanggalLahir = $_POST['signUpBirthDate'];
            $jenisKelamin = $_POST['signUpGender'];

            if ($password !== $confirmPassword) {
                echo "Passwords do not match. Please try again.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO user (user_first, user_last, user_email, user_pass, user_birth, user_gender) VALUES (?, ?, ?, ?, ?, ?)";
                $insertStatement = $conn->prepare($query);
                $insertStatement->bind_param("ssssss", $firstName, $lastName, $email, $hashedPassword, $tanggalLahir, $jenisKelamin);
                if ($insertStatement->execute()) {
                    header('Location: login.php');
                    exit;
                } else {
                    echo "Registration failed: " . $conn->error;
                }

                $conn->close();
            }
        }
    }
    ?>

    <?php
    include('components/footer.php');
    ?>

</body>

</html>