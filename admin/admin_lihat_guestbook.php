<?php

$title = 'Guest Book';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$allGuestBook = query("SELECT * FROM guestbook ORDER BY idGuest DESC");

?>

<main id="main" class="main">

    <div class="pagetitle ">
        <h1 class="text-center">Data Guest Book</h1>
    </div>

    <section class="section">
        <div class="card card-body">

            <div class="col-md-6 mt-2 mb-2">
                <input type="text" placeholder="Cari sesuatu di guest book" class="form-control" id="searchingTable">
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Pesan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($allGuestBook as $guestBook) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $guestBook["namaGuest"]; ?></td>
                            <td><?= $guestBook["emailGuest"]; ?></td>
                            <td><?= $guestBook["pesanGuest"]; ?></td>
                            <td>
                                <a href="hapus_guestbook.php?idGuest=<?= $guestBook["idGuest"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pesan dari <?= $guestBook["namaGuest"]; ?>?');"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </section>

</main>