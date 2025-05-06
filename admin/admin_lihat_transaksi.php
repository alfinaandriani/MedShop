<?php

$title = 'Transaksi Belanja';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$allTransaksi = query("SELECT * FROM transaksi ORDER BY idTransaksi DESC");

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center">Data Transaksi Customer</h1>
    </div>

    <section class="section">
        <div class="card card-body">

            <div class="col-md-6 mt-2 mb-2">
                <input type="text" placeholder="Cari sesuatu di transaksi" class="form-control" id="searchingTable">
            </div>

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
                        <th scope="col">Detail</th>
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
                                <?php if ($transaksi["statusTransaksi"] == 'Diterima' || $transaksi["statusTransaksi"] == 'Ditolak' || $transaksi["statusTransaksi"] == 'Dibatalkan') : ?>
                                    -
                                <?php else : ?>
                                    <a href="admin_terima_transaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>"
                                        class="btn btn-primary"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Terima Transaksi"
                                        onclick="return confirm('Yakin menerima pesanan dengan id <?= $transaksi["idTransaksi"]; ?>?');">
                                        <i class="bi bi-check"></i>
                                    </a>
                                    <a href="admin_tolak_transaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>"
                                        class="btn btn-danger"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Tolak Transaksi"
                                        onclick="return confirm('Yakin menolak pesanan dengan id <?= $transaksi["idTransaksi"]; ?>?');">
                                        <i class="bi bi-x"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="admin_detail_transaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>&username=<?= $transaksi["username"]; ?>"
                                    class="btn btn-primary"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Transaksi">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </section>

</main>