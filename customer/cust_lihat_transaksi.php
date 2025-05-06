<?php

$title = 'Transaksi Belanja';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

$username = $_SESSION["username"];
$allTransaksi = query("SELECT * FROM transaksi WHERE username = '$username' ORDER BY idTransaksi DESC");

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center">Transaksi Belanja</h1>
    </div>

    <section class="section">
        <div class="card card-body">

            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Cara Bayar</th>
                        <th scope="col">Bank</th>
                        <th scope="col">Status Transaksi</th>
                        <th scope="col">Status Pengiriman</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($allTransaksi as $transaksi) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $transaksi["idTransaksi"]; ?></td>
                            <td><?= $transaksi["username"]; ?></td>
                            <td><?= $transaksi["tanggalTransaksi"]; ?></td>
                            <td><?= $transaksi["caraBayar"]; ?></td>
                            <td><?= $transaksi["bank"]; ?></td>
                            <td><?= $transaksi["statusTransaksi"]; ?></td>
                            <td><?= $transaksi["statusPengiriman"]; ?></td>
                            <td>Rp<?= number_format($transaksi["totalHarga"], 0, ',', '.'); ?></td>
                            <td>
                                <a href="cust_detail_transaksi.php?id=<?= $transaksi["idTransaksi"]; ?>"
                                    class="btn btn-primary"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Transaksi">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Batalkan transaksi apabila status belum diterima -->
                                <?php if ($transaksi["statusTransaksi"] == 'Tertunda') : ?>
                                    <a href="cust_batal_transaksi.php?id=<?= $transaksi["idTransaksi"]; ?>"
                                        class="btn btn-danger"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Batalkan Transaksi"
                                        onclick="return confirm('Yakin ingin membatalkan pesanan dengan id <?= $transaksi["idTransaksi"]; ?>?');">
                                        <i class="bi bi-x"></i>
                                    </a>
                                <?php elseif (($transaksi["statusTransaksi"] == 'Diterima') && ($transaksi["statusPengiriman"] != 'Terkirim')) : ?>
                                    <a href="cust_selesaikan_transaksi.php?id=<?= $transaksi["idTransaksi"]; ?>"
                                        class="btn btn-primary"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Paket Diterima"
                                        onclick="return confirm('Yakin menerima pesanan dengan id <?= $transaksi["idTransaksi"]; ?>?');">
                                        <i class="bi bi-check"></i>
                                    </a>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </section>

</main>