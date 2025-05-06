<?php

$title = 'Daftar Produk';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

// Mengambil data produk dari database
$allProduk = query("SELECT * FROM produk");

// Membuat array kategori produk
$kategori = array(
    "Alat Diagnostik",
    "Alat Bantu Pernapasan",
    "Alat Tes Pribadi",
    "Peralatan Emergency",
    "Lain-lain"
);

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center" style="color: #000">Selamat Berbelanja di <span style="color:var(--primary)">Med</span><span style="color:var(--secondary)">Shop</span></h1>
    </div>

    <!-- Live dropdown menggunakan jquery untuk filter kategoriProduk -->
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <p class="fw-bold">Pilih Kategori : </p>
                <select class="form-select mb-5" id="kategoriFilter">
                    <option value="all">Semua Kategori</option>
                    <!-- Menampilkan semua kategori yang tersedia -->
                    <?php foreach ($kategori as $k) : ?>
                        <option value="<?= $k; ?>"><?= $k; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="row">

            <?php foreach ($allProduk as $produk) : ?>
                <div id="produk" class="col-md-4 mb-4" data-kategori="<?= $produk["kategoriProduk"]; ?>">
                    <div class="card" style="width: 22rem;">
                        <!-- Gambar produk -->
                        <img src="../img/<?= $produk["gambarProduk"]; ?>" class="card-img-top custom-card-img" alt="..." style="height: 220px; object-fit: cover;">
                        <!-- Info Produk -->
                        <div class="card-body">
                            <p class="card-text text-muted small" style="margin-bottom: 5px"><?= $produk["kategoriProduk"]; ?></p>
                            <h5 class="card-title" style="margin: 0"><?= $produk["namaProduk"]; ?></h5>
                            <p class="fw-bold text-harga fs-5" style="margin-top: 10px; color: var(--primary);">
                                Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?>
                            </p>

                            <p class="card-text d-flex justify-content-center" style="margin: 0;">
                                <!-- Jika produk stok = 0 -->
                                <?php if ($produk["stokProduk"] == 0) : ?>
                                    <a href=" #" class="btn btn-danger">Stok Kosong</a>
                                <?php else : ?>
                                    <a href="cust_detail_produk.php?id=<?= $produk["idProduk"]; ?>" class="btn btn-primary-outline">Detail</a>
                                <?php endif; ?>
                                <a href="cust_add_keranjang.php?idProduk=<?= $produk["idProduk"]; ?>" class="btn btn-primary" style="margin-left: 20px;">Beli</a>
                            </p>
                        </div>
                    </div><!-- End card produk -->
                </div>
            <?php endforeach; ?>

        </div>

    </div>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("#kategoriFilter").on("change", function() {
            var selectedCategory = $(this).val();

            $(".col-md-4").each(function() {
                var cardCategory = $(this).data("kategori");
                var isCategoryMatch = selectedCategory === "all" || cardCategory === selectedCategory;

                if (isCategoryMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>