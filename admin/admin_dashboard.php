<?php
$title = "Dashboard Admin";

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

// 
$totalTransaksiSelesai = count(query("SELECT * FROM transaksi WHERE statusPengiriman = 'Terkirim'"));
$totalTransaksiBelumSelesai = count(query("SELECT * FROM transaksi WHERE statusPengiriman = 'Dalam Perjalanan' OR statusPengiriman = 'Tertunda'"));
$totalTransaksiDitolak = count(query("SELECT * FROM transaksi WHERE statusTransaksi = 'Ditolak'"));
$totalBatalTransaksi = count(query("SELECT * FROM transaksi WHERE statusTransaksi = 'Dibatalkan'"));
$totalProduk = count(query("SELECT * FROM produk"));
$totalGuestBook = count(query("SELECT * FROM guestbook"));
$totalCustomer = count(query("SELECT * FROM customer"));
$totalKeuangan = query("SELECT SUM(totalHarga) FROM transaksi WHERE statusPengiriman = 'Terkirim'")[0]['SUM(totalHarga)'];

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center">Dashboard Admin</h1>
    </div>

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi Sudah Selesai</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-bag-check"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalTransaksiSelesai; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi Belum Selesai</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalTransaksiBelumSelesai; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi Dibatalkan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-bag-x"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalBatalTransaksi; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi Ditolak</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-bag-dash"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalTransaksiDitolak; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalProduk; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Customer</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalCustomer; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pemasukan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Rp<?= number_format($totalKeuangan, 0, ',', '.'); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Guestbook</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalGuestBook; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Row -->
    </section>

</main>