<?php

$title = 'Detail Produk';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

// Mengambil id produk dari URL
$id = $_GET["id"];

// Mengambil data produk berdasarkan id dari database
$produk = query("SELECT * FROM produk WHERE idProduk = '$id'")[0];

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center"><?= $produk["namaProduk"]; ?></h1>
    </div>

    <section class="section">
        <div class="card card-body">

            <form class="row g-3" method="post" enctype="multipart/form-data">

                <div class="col-12 text-center">
                    <img src="../img/<?= $produk["gambarProduk"]; ?>" width="300" class="mb-2"><br>
                </div>

                <div class="col-12">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <input class="form-control" id="namaProduk" name="namaProduk" readonly value="<?= $produk["namaProduk"]; ?>">
                </div>

                <div class="col-12">
                    <label for="kategoriProduk" class="form-label">Kategori Produk</label>
                    <input class="form-control" id="kategoriProduk" name="kategoriProduk" readonly value="<?= $produk["kategoriProduk"]; ?>">
                </div>

                <div class="col-12">
                    <label for="hargaProduk" class="form-label">Harga Produk</label>
                    <input class="form-control" id="hargaProduk" name="hargaProduk" readonly value="Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?>">
                </div>

                <div class="col-12">
                    <label for="stokProduk" class="form-label">Stok Produk</label>
                    <input class="form-control" id="stokProduk" name="stokProduk" readonly value="<?= $produk["stokProduk"]; ?>">
                </div>

                <center>
                    <a href="cust_produk.php" class="btn btn-primary-outline"><i class="bi bi-arrow-left"></i> Kembali</a>
                    <a href="cust_add_keranjang.php?idProduk=<?= $produk["idProduk"]; ?>" class="btn btn-primary"><i class="bi bi-cart"></i> Keranjang</a>
                </center>

            </form>

        </div>
    </section>

</main>