<?php

$title = 'Registrasi';

require 'connect.php';

if (isset($_POST["submit"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan');
                header('Location: login_cust.php');
                </script>";
    } else {
        echo "<script>
                alert('User baru gagal ditambahkan');
                </script>";
    }
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

                                    <form class="row g-3 needs-validation" novalidate method="POST">
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Silakan buat nama pengguna!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Silakan masukkan password Anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Ketik Ulang Password</label>
                                            <input type="password" name="password2" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Silakan ketik ulang password Anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama</label>
                                            <input type="text" name="namaLengkap" class="form-control" id="yourName" required>
                                            <div class="invalid-feedback">Silakan masukkan nama Anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Silakan masukkan alamat Email yang valid!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="dob" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="dob" class="form-control" id="dob" required>
                                            <div class="invalid-feedback">Silakan masukkan Tanggal Lahir yang valid!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="gender" class="form-check-label">Gender</label><br>
                                            <input class="form-check-input" type="radio" name="gender" class="form-control" id="gender" value="male" required> Male
                                            <input class="form-check-input" type="radio" name="gender" class="form-control" id="gender" value="female" required> Female
                                        </div>

                                        <div class="col-12">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" id="alamat" required>
                                            <div class="invalid-feedback">Silakan masukkan alamat Anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="kota" class="form-label">Kota</label>
                                            <input type="text" name="kota" class="form-control" id="kota" required>
                                            <div class="invalid-feedback">Silakan masukkan Kota Anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="contact" class="form-label">Kontak</label>
                                            <input type="number" name="contact" class="form-control" id="contact" required pattern="[0-9]*">
                                            <div class="invalid-feedback">Silakan masukkan Kontak Anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="paypalID" class="form-label">ID Paypal</label>
                                            <input type="number" name="paypalID" class="form-control" id="paypalID" required pattern="[0-9]*">
                                            <div class="invalid-feedback">Silakan masukkan ID paypal Anda!</div>
                                        </div>

                                        <div class="text-center col-12">
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah punya akun? <a href="login_cust.php">Log in</a></p>
                                            <p class="small mb-0">Login sebagai Admin? <a href="login_admin.php">Log in Admin</a></p>
                                            <p class="small mb-0">Ingin mengirim guest book? <a href="guestBook.php">Guest Book</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>



</body>

</html>