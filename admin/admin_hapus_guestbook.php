<?php

$title = 'Guest Book';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$idGuest = $_GET["idGuest"];

// Memanggil function hapusGuestbook() yang ada di admin_control.php
if (hapusGuestbook($idGuest) > 0) {
    echo "
        <script>
            alert('Guest Book berhasil dihapus!');
            document.location.href = 'admin_lihat_guestbook.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Guest Book gagal dihapus!');
            document.location.href = 'admin_lihat_guestbook.php';
        </script>
    ";
}
