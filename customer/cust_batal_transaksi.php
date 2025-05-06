<?php

$title = 'Batalkan Transaksi';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

$idTransaksi = $_GET["id"];

// Memanggil function batalTransaksi() yang ada di cust_control.php
if (batalkanTransaksi($idTransaksi) > 0) {
    echo "<script>
            alert('Transaksi Berhasil Dibatalkan!');
            document.location.href = 'cust_lihat_transaksi.php';
        </script>";
} else {
    echo "<script>
            alert('Transaksi Gagal Dibatalkan!');
            document.location.href = 'cust_lihat_transaksi.php';
        </script>";
}
