<?php

$title = 'Transaksi Belanja';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

// Mengambil ID Transaksi dari URL dan username dari session
$idTransaksi = $_GET["id"];
$username = $_SESSION["username"];

// Mengambil detail transaksi dari db
$detailTransaksi = query("SELECT * FROM transaksi
JOIN customer ON transaksi.username = customer.username
WHERE transaksi.idTransaksi = '$idTransaksi' AND transaksi.username = '$username';
")[0];

// Mengambil data keranjang dari transaksi
$keranjangUser = query("SELECT * FROM keranjang
JOIN produk ON keranjang.idProduk = produk.idProduk
WHERE keranjang.username = '$username' AND keranjang.idTransaksi = '$idTransaksi';
");

// Format tanggal transaksi
$tanggalTransaksi = strtotime($detailTransaksi["tanggalTransaksi"]);
$tanggalFormatted = date("j F Y", $tanggalTransaksi);

// Feedback
if (isset($_POST["submit"])) {
    if (feedback($_POST) > 0) {
        echo "
            <script>
                alert('Feedback berhasil dikirim!');
                document.location.href = 'cust_detail_transaksi.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Feedback gagal dikirim!');
                document.location.href = 'cust_detail_transaksi.php';
            </script>
        ";
    }
}


?>

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col">
                <!-- Header Invoice -->
                <div class="container mt-3">
                    <div class="row align-items-center">
                        <center>
                            <img src="../img/Logo MedShop.png" width="60px" class="mb-1">
                            <div class="text-invoice col-md-10">
                                <h2 class="mb-1">Med<span>Shop</span></h2>
                                <h4 class="mb-2 fw-bold">Invoice Belanja</h4>
                            </div>
                        </center>
                    </div>
                </div>
                <!-- Informasi Transaksi -->
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Username:</strong> <?= $detailTransaksi["username"]; ?></li>
                            <li class="list-group-item"><strong>Nama:</strong> <?= $detailTransaksi["namaLengkap"]; ?></li>
                            <li class="list-group-item"><strong>Alamat:</strong> <?= $detailTransaksi["alamat"]; ?></li>
                            <li class="list-group-item"><strong>No. Telp:</strong> <?= $detailTransaksi["contact"]; ?></li>
                            <li class="list-group-item"><strong>Tanggal Transaksi:</strong> <?= $tanggalFormatted; ?></li>
                            <li class="list-group-item"><strong>ID Paypal:</strong> <?= $detailTransaksi["paypalID"]; ?></li>
                            <li class="list-group-item"><strong>Nama Bank:</strong> <?= $detailTransaksi["bank"]; ?></li>
                            <li class="list-group-item"><strong>Cara Bayar:</strong> <?= $detailTransaksi["caraBayar"]; ?></li>
                            <li class="list-group-item"><strong>Status Transaksi:</strong> <?= $detailTransaksi["statusTransaksi"]; ?></li>
                            <li class="list-group-item"><strong>Status Pengiriman:</strong> <?= $detailTransaksi["statusPengiriman"]; ?></li>
                        </ul>
                    </div>
                    <!-- Daftar Produk -->
                    <div class="card col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">ID Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($keranjangUser as $keranjang) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $keranjang["idProduk"]; ?></td>
                                        <td><?= $keranjang["namaProduk"]; ?></td>
                                        <td><?= $keranjang["jumlah"]; ?></td>
                                        <td>Rp<?= number_format($keranjang["harga"], 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="fw-bold">Total Harga: Rp<?= number_format($detailTransaksi["totalHarga"], 0, ',', '.'); ?></div>
                        <div class="mt-3 text-end">
                            <h5 class="fw-bold">MedShop</h5>
                            <img src="../img/ttd1.png" alt="Tanda Tangan" style="width: 100px;">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="fw-bold">Feedback:</div>
                    <?= $detailTransaksi["feedBack"] ? $detailTransaksi["feedBack"] : "Belum ada feedback."; ?>
                </div>

                <?php if ($detailTransaksi["feedBack"] == NULL && $detailTransaksi["statusPengiriman"] == "Terkirim" && $detailTransaksi["statusTransaksi"] != 'Dibatalkan') : ?>
                    <!-- Form Feedback -->
                    <form action="" method="post" class="mt-3">
                        <input type="hidden" name="idTransaksi" value="<?= $detailTransaksi["idTransaksi"]; ?>">
                        <div class="mb-3">
                            <label for="feedbackInput" class="form-label">Berikan Feedback:</label>
                            <input type="text" class="form-control" id="feedbackInput" name="feedBack" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Feedback"><i class="bi bi-send-fill"></i> Kirim</button>
                    </form>
                <?php endif; ?>

                <div class="text-center mt-3">
                    <a href="cust_lihat_transaksi.php" style="text-decoration: none;">
                        <button id="kembali" class="btn btn-primary-outline mx-2"><i class="bi bi-arrow-left"></i> Kembali</button>
                    </a>
                    <button id="printButton" class="btn btn-primary mx-2"><i class="bi bi-printer"></i> Cetak</button>
                </div>

            </div>
        </div>
    </section>

    <script>
        // Saat tombol cetak halaman diklik
        document.getElementById("printButton").addEventListener("click", function() {
            // Sembunyikan tombol kembali dan cetak halaman
            document.getElementById("printButton").style.display = "none";
            document.getElementById("kembali").style.display = "none";

            // Cetak halaman
            window.print();
        });

        // Event yang dipicu setelah pencetakan selesai
        window.onafterprint = function() {
            // Kembalikan tata letak tombol-tombol cetak dan kembali ke posisi awal setelah pencetakan selesai
            document.getElementById("printButton").style.display = "inline-block";
            document.getElementById("kembali").style.display = "inline-block";
        };

        // Event yang dipicu sebelum pencetakan dimulai
        window.onbeforeprint = function() {
            // Sembunyikan tombol cetak dan kembali saat pencetakan dimulai
            document.getElementById("printButton").style.display = "none";
            document.getElementById("kembali").style.display = "none";
        };
    </script>
</main>