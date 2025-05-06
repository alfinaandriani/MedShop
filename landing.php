<?php
$title = 'Selamat Datang di MedShop';
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .header-nav .nav-link {
            padding: 20px;
            font-weight: 600;
        }

        .header-nav .nav-link:hover {
            font-weight: 600;
            color: #fff;
            background-color: var(--primary);
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <div class="header-logo">
                <a href="#" class="d-flex align-items-center">
                    <img src="../img/Logo MedShop.png" alt="logo">
                    <h2>Med<span>Shop</span></h2>
                </a>
            </div>

            <!-- Navigation Center -->
            <nav class="header-nav mx-auto">
                <ul class="d-flex align-items-center mb-0">
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                </ul>
            </nav>

            <!-- Login Button -->
            <div class="login-btn">
                <a class="getstarted scrollto fw-bold m-4" href="login_admin.php">Admin</a>
            </div>
        </div>
    </header><!-- End Header -->>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 style="font-size: 2.8rem; font-weight: 800; margin-bottom: 20px;">Selamat Datang di <span style="color:var(--primary)">Med</span><span style="color:var(--secondary)">Shop</span></h1>
                    <h2 style="font-size: 1.5rem; margin-bottom: 30px;">Alat Kesehatan Lengkap, Praktis & Terpercaya</h2>

                    <div class="action-buttons">
                        <a href="login_cust.php" class="btn btn-primary" style="min-width: 180px">Login</a>
                        <a href="registrasi.php" class="btn btn-primary-outline" style="min-width: 180px">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    <main>
        <!-- ======= About Section ======= -->
        <section id="about" class="about-section">
            <div class="container">
                <h3 style="font-weight: 700; margin-bottom: 20px; text-align: center;">Tentang MedShop</h3>
                <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 30px;">
                    MedShop adalah toko alat kesehatan online terkemuka yang menyediakan akses mudah ke alat-alat kesehatan. Kami memiliki semangat untuk menjadikan layanan kesehatan dapat diakses, terjangkau, dan nyaman bagi semua orang.
                </p>

                <ul class="benefits-list">
                    <li>100% Produk Asli</li>
                    <li>Pembayaran Aman</li>
                    <li>Dukungan Pelanggan 24/7</li>
                </ul>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact-section">
            <div class="container">
                <div class="section-title">
                    <h2>Hubungi Kami</h2>
                    <p>Punya pertanyaan? Kami siap membantu!</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="info-box">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>info@medshop.com</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="info-box">
                            <i class="bi bi-phone"></i>
                            <h3>Telpon</h3>
                            <p>+62 123 456 789</p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer class="footer">
        <div class="container">
            <div class="copyright text-center">
                &copy; Hak Cipta <strong><span>MedShop</span></strong>. Semua Hak Dilindungi
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>