<?php

$title = 'Customer';

require 'admin_control.php';
require 'header_admin.php';
require 'sidebar_admin.php';

$allCustomer = query("SELECT * FROM customer");

?>

<main id="main" class="main">

    <div class="pagetitle ">
        <h1 class="text-center">Data Customer</h1>
    </div>

    <section class="section">
        <div class="card card-body">

            <div class="col-md-6 mt-2 mb-2">
                <input type="text" placeholder="Cari customer" class="form-control" id="searchingTable">
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Paypal ID</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($allCustomer as $customer) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $customer["username"]; ?></td>
                            <td><?= $customer["namaLengkap"]; ?></td>
                            <td><?= $customer["email"]; ?></td>
                            <td><?= $customer["dob"]; ?></td>
                            <td><?= $customer["gender"]; ?></td>
                            <td><?= $customer["alamat"]; ?></td>
                            <td><?= $customer["kota"]; ?></td>
                            <td><?= $customer["contact"]; ?></td>
                            <td><?= $customer["paypalID"]; ?></td>
                            <td>
                                <a href="admin_edit_cust.php?username=<?= $customer["username"]; ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="admin_hapus_cust.php?username=<?= $customer["username"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus <?= $customer["username"]; ?>?');"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </section>

</main>