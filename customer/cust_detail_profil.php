<?php

$title = 'Detail Akun';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

$username = $_SESSION["username"];
$customer = query("SELECT * FROM customer WHERE username = '$username'")[0];

$tanggalLahir = strtotime($customer["dob"]);
$tanggalFormatted = date("j F Y", $tanggalLahir);

?>

<main id="main" class="main">

    <div class="pagetitle ">
        <h1 class="text-center">Profil Saya</h1>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Username</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["username"]; ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Nama Lengkap</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["namaLengkap"]; ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Email</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["email"]; ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8">: <?= $tanggalFormatted; ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Gender</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["gender"]; ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Alamat</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["alamat"]; ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Kota</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["kota"]; ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 fw-bold">Contact</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["contact"]; ?></div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 fw-bold">Paypal ID</div>
                    <div class="col-lg-9 col-md-8">: <?= $customer["paypalID"]; ?></div>
                </div>

                <div class="text-center">
                    <a href="cust_edit_profil.php?username=<?= $customer["username"]; ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit Profil</a>
                </div>

            </div>
        </div>
    </section>

</main>