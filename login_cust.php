<?php

$title = 'Login Customer';

session_start();
require 'connect.php';

// SET COOKIE
if (isset($_COOKIE['username']) && isset($_COOKIE['key'])) {
    $username = $_COOKIE['username'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($connect, "SELECT username FROM customer WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

// SET SESSION DAN REDIRECT LOGIN
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($connect, "SELECT * FROM customer WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION['username'] = $row["username"];
            $_SESSION["login"] = true;

            if (isset($_POST['remember'])) {
                setcookie('username', $row['username'], time() + 60);
                setcookie('key', hash('sha256', $row['username']));
            }
            header("Location: Customer/cust_produk.php");
        }
    }

    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="img/Logo MedShop.png" rel="icon">
    <link href="img/Logo MedShop.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a class="login-logo d-flex align-items-center w-auto">
                                    <img src="img/Logo MedShop.png" alt="logo">
                                    <h2 class="d-none d-lg-block">Med<span>Shop</span></h2>
                                </a>
                            </div>

                            <div class="card-login mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Selamat Datang di</h5>
                                        <a class="login-logo d-flex align-items-center justify-content-center w-auto">
                                            <img src="img/Logo MedShop.png" alt="logo" class="me-2" style="height: 40px;">
                                            <h2 class="d-none d-lg-block fs-4 m-0">Med<span class="fs-4">Shop</span></h2>
                                        </a>
                                    </div>

                                    <form class="row g-3 needs-validation" method="post">

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Silakan masukkan username Anda!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Silakan masukkan password Anda!</div>
                                        </div>

                                        <!-- if $error -->
                                        <?php if (isset($error)) : ?>
                                            <p class="text-center" style="color: red">Username / Password salah!</p>
                                        <?php endif; ?>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" name="login">Log in</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Tidak punya akun? <a href="registrasi.php">Buat Akun</a></p>
                                            <p class="small mb-0">Login sebagai Admin? <a href="login_admin.php">Log in Admin</a></p>
                                            <p class="small mb-0">Ingin mengirim Guest Book? <a href="guestBook.php">Guest Book</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>