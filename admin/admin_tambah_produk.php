<?php

$title = 'Tambah Produk';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

if (isset($_POST["submit"])) {
    if (tambahProduk($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'admin_list_produk.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'admin_list_produk.php';
            </script>
        ";
    }
}

$kategori = array(
    "Alat Diagnostik",
    "Alat Bantu Pernapasan",
    "Alat Tes Pribadi",
    "Peralatan Emergency",
    "Lain-lain"
);


?>

<main id="main" class="main">

    <div class="pagetitle ">
        <h1 class="text-center">Tambah Produk</h1>
    </div>

    <section class="section">
        <div class="card card-body">

            <form class="row g-3" method="post" enctype="multipart/form-data">

                <div class="col-12">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="namaProduk" name="namaProduk" required>
                </div>

                <div class="col-12">
                    <label for="kategoriProduk" class="form-label">Kategori Produk</label>
                    <select class="form-select" id="kategoriProduk" name="kategoriProduk" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k; ?>"><?= $k; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label for="hargaProduk" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="hargaProduk" name="hargaProduk" required>
                </div>

                <div class="col-12">
                    <label for="stokProduk" class="form-label">Stok Produk</label>
                    <input type="number" class="form-control" id="stokProduk" name="stokProduk" required>
                </div>

                <div class="col-12">
                    <label for="gambarProduk" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control" id="gambarProduk" name="gambarProduk" required>
                </div>

                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>

            </form>

        </div>
    </section>

</main>