<?php

$title = 'Transaksi Belanja';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$idTransaksi = $_GET["idTransaksi"];

// Memanggil function terimaTransaksi() yang ada di admin_control.php
if (terimaTransaksi($idTransaksi) > 0) {
    echo "
        <script>
            alert('Transaksi berhasil diterima!');
            document.location.href = 'admin_lihat_transaksi.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Transaksi gagal diterima!');
            document.location.href = 'admin_lihat_transaksi.php';
        </script>
    ";
}
