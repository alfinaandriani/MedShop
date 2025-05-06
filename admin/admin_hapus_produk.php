<?php

$title = 'Delete Produk';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$idProduk = $_GET["id"];

// Memanggil function hapusProduk() yang ada di admin_control.php
if (hapusProduk($idProduk) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'admin_list_produk.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'admin_list_produk.php';
        </script>
    ";
}
