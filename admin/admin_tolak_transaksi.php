<?php

$title = 'Transaksi Belanja';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$idTransaksi = $_GET["idTransaksi"];

// Memanggil function tolakTransaksi() yang ada di admin_control.php
if (tolakTransaksi($idTransaksi) > 0) {
    echo "
        <script>
            alert('Transaksi berhasil ditolak!');
            document.location.href = 'admin_lihat_transaksi.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Transaksi gagal ditolak!');
            document.location.href = 'admin_lihat_transaksi.php';
        </script>
    ";
}
