<?php

$title = "Daftar Produk";

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$allProduk = query("SELECT * FROM produk");

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center">Daftar Produk</h1>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">

                <a href="admin_tambah_produk.php" class="btn btn-primary mb-2"><i class="bi bi-plus-lg"></i> Tambah Produk</a><br>

                <div class="col-md-6 mt-2 mb-2">
                    <input type="text" placeholder="Cari sesuatu di produk" class="form-control" id="searchingTable">
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($allProduk as $produk) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $produk["idProduk"]; ?></td>
                                <td><?= $produk["namaProduk"]; ?></td>
                                <td><?= $produk["kategoriProduk"]; ?></td>
                                <td>Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?></td>
                                <td><?= $produk["stokProduk"]; ?></td>
                                <td><img src="../img/<?= $produk["gambarProduk"]; ?>" width="100px"></td>
                                <td>
                                    <a href="admin_edit_produk.php?id=<?= $produk["idProduk"]; ?>" class="btn btn-primary"> <i class="bi bi-pencil-square"></i></a>
                                    <a href="admin_hapus_produk.php?id=<?= $produk["idProduk"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk <?= $produk["namaProduk"]; ?>?');"> <i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>

</main>