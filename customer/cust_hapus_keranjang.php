<?php

$title = 'Hapus Keranjang';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

$username = $_SESSION["username"];

// Memanggil function hapusKeranjang dari cust_control.php
if (hapusKeranjang($username) > 0) {
    echo "
        <script>
            alert('Keranjang berhasil dihapus!');
            document.location.href = 'cust_lihat_keranjang.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Keranjang gagal dihapus!');
            document.location.href = 'cust_lihat_keranjang.php';
        </script>
    ";
}
