<?php

$title = "Selesaikan Transaksi";

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

$idTransaksi = $_GET["id"];

// Memanggil function selesaikanTransaksi() yang ada di cust_control.php
if (selesaikanTransaksi($idTransaksi) > 0) {
    echo "<script>
            alert('Transaksi Berhasil Diterima!');
            document.location.href = 'cust_lihat_transaksi.php';
        </script>";
} else {
    echo "<script>
            alert('Transaksi Gagal Diterima!');
            document.location.href = 'cust_lihat_transaksi.php';
        </script>";
}
