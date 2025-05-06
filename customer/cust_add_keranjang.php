<?php

$title = 'Tambah Keranjang';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

$idProduk = $_GET["idProduk"];

// Memanggil function tambahKeranjang() yang ada di cust_control.php
if (tambahKeranjang($idProduk) > 0) {
    echo "<script>
            alert('Produk berhasil ditambahkan ke keranjang!');
            document.location.href = 'cust_produk.php';
        </script>";
} else {
    echo "<script>
            alert('Produk gagal ditambahkan ke keranjang!');
            document.location.href = 'cust_produk.php';
        </script>";
}
