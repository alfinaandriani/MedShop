<?php

$title = 'Customer';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$username = $_GET["username"];

// Memanggil function hapusCust() yang ada di admin_control.php
if (hapusCust($username) > 0) {
    echo "
        <script>
            alert('Customer berhasil dihapus!');
            document.location.href = 'admin_lihat_cust.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Customer gagal dihapus!');
            document.location.href = 'admin_lihat_cust.php';
        </script>
    ";
}
