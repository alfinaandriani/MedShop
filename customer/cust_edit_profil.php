<?php

$title = 'Profil';

require 'cust_control.php';
require 'header_cust.php';
require 'sidebar_cust.php';

$username = $_GET["username"];
$customer = query("SELECT * FROM customer WHERE username = '$username'")[0];


if (isset($_POST["submit"])) {
    if (updateCust($_POST) > 0) {
        echo "
            <script>
                alert('Profil berhasil diupdate!');
                document.location.href = 'cust_detail_profil.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Profil gagal diupdate!');
                document.location.href = 'cust_detail_profil.php';
            </script>
        ";
    }
}

?>

<main id="main" class="main">

    <div class="pagetitle ">
        <h1 class="text-center">Update Profil</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="card card-body">

                <form action="" method="post">
                    <div class="col-12 mt-2">
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control" id="username" name="username" required readonly value="<?= $customer["username"]; ?>">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                        <input class="form-control" id="namaLengkap" name="namaLengkap" required value="<?= $customer["namaLengkap"]; ?>">
                    </div>

                    <input type="hidden" name="passwordOLD" value="<?= $customer["password"]; ?>">

                    <div class="col-12 mt-2">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="text" class="form-control" id="email" name="email" required value="<?= $customer["email"]; ?>">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="dob" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="dob" name="dob" required value="<?= $customer["dob"]; ?>">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?php echo ($customer["gender"] == "male") ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="male">Male</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php echo ($customer["gender"] == "female") ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required value="<?= $customer["alamat"]; ?>">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" required value="<?= $customer["kota"]; ?>">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="contact" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="contact" name="contact" required pattern="[0-9]*" value="<?= $customer["contact"]; ?>">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="paypalID" class="form-label">ID Paypal</label>
                        <input type="text" class="form-control" id="paypalID" name="paypalID" required pattern="[0-9]*" value="<?= $customer["paypalID"]; ?>">
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary mt-3"><i class="bi bi-save"></i> Update</button>
                    </div>

                </form>

            </div>
        </div>
    </section>

</main>