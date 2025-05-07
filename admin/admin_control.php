<?php

require '../connect.php';

// Function untuk tambah produk baru ke db
function tambahProduk($data)
{
    global $connect;

    $idProduk = 'PRD-' . time();
    $namaProduk = htmlspecialchars($data["namaProduk"]);
    $kategoriProduk = htmlspecialchars($data["kategoriProduk"]);
    $hargaProduk = htmlspecialchars($data["hargaProduk"]);
    $stokProduk = htmlspecialchars($data["stokProduk"]);
    $gambarProduk = uploadGambar();
    if (!$gambarProduk) {
        die;
        return false;
        die;
    }

    // Insert data produk
    $query = "INSERT INTO produk VALUES ('$idProduk','$namaProduk','$kategoriProduk','$hargaProduk','$stokProduk','$gambarProduk')";

    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// Function untuk upload gambar produk
function uploadGambar()
{
    // Ambil data gambar
    $namaFile = $_FILES['gambarProduk']['name']; // Nama asli file
    $ukuranFile = $_FILES['gambarProduk']['size']; // Ukuran file
    $error = $_FILES['gambarProduk']['error']; // Kode error upload
    $tempPath = $_FILES['gambarProduk']['tmp_name']; // Lokasi temporary file

    // Cek ada file yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar dahulu!');
            </script>";
        return false;
    }

    // Cek jenis file gambar
    $jenisFileValid = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
    $jenisFile = explode('.', $namaFile);
    $jenisFile = strtolower(end($jenisFile));
    if (!in_array($jenisFile, $jenisFileValid)) {
        echo "<script>
                alert('Jenis File Tidak Valid!');
            </script>";
        return false;
        die;
    }

    // Cek ukuran file gambar (max 2MB)
    if ($ukuranFile > 2000000) {
        echo "<script>
                alert('Ukuran File Terlalu Besar!');
            </script>";
        return false;
        die;
    }

    // Membuat nama file unik
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $jenisFile;

    // Pindahkan file dari temp ke folder img
    move_uploaded_file($tempPath, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}

// Function untuk update produk
function updateProduk($data)
{
    global $connect;

    // Mengambil dan membersihkan data input
    $idProduk = $data["idProduk"];
    $namaProduk = htmlspecialchars($data["namaProduk"]);
    $kategoriProduk = htmlspecialchars($data["kategoriProduk"]);
    $hargaProduk = htmlspecialchars($data["hargaProduk"]);
    $stokProduk = htmlspecialchars($data["stokProduk"]);
    $beforeupdate = htmlspecialchars($data["beforeupdate"]);

    // Penanganan upload gambar baru
    if ($_FILES['gambarProduk']['error'] === 4) {
        $gambarProduk = $beforeupdate; // Jika tidak ada gambar baru, gunakan gambar lama
    } else {
        // Jika ada gambar baru, upload gambar baru
        $gambarProduk = uploadGambar(); // Upload gambar baru
        unlink('../img/' . $beforeupdate); // Hapus gambar lama
    }

    // Update data produk ke db
    $query = "UPDATE produk SET 
                namaProduk = '$namaProduk',
                kategoriProduk = '$kategoriProduk',
                hargaProduk = '$hargaProduk',
                stokProduk = '$stokProduk',
                gambarProduk = '$gambarProduk'
                WHERE idProduk = '$idProduk'
                ";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// Function untuk hapus produk dari db
function hapusProduk($id)
{
    global $connect;

    // Ambil data produk yang ingin dihapus
    $query = "SELECT * FROM produk WHERE idProduk = '$id'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);

    // Hapus produk dari db
    mysqli_query($connect, "DELETE FROM produk WHERE idProduk = '$id'");

    // Simpan nama gambar produk yang dihapus
    $gambarProduk = $row["gambarProduk"];

    // Hapus gambar produk dari folder img
    if (mysqli_affected_rows($connect) > 0) {
        unlink('../img/' . $gambarProduk);
    }

    return mysqli_affected_rows($connect);
}

// Function untuk hapus customer dari db
function hapusCust($username)
{
    global $connect;

    mysqli_query($connect, "DELETE FROM customer WHERE username = '$username'");
    return mysqli_affected_rows($connect);
}

// Function untuk hapus guestbook
function hapusGuestbook($idGuest)
{
    global $connect;
    mysqli_query($connect, "DELETE FROM guestbook WHERE idGuest = '$idGuest'");
    return mysqli_affected_rows($connect);
}

// Function menerima transaksi dan perbarui status transaksi
function terimaTransaksi($idTransaksi)
{
    global $connect;

    // Query memperbarui status transaksi
    $query = "UPDATE transaksi SET 
                statusTransaksi = 'Diterima',
                statusPengiriman = 'Dalam Perjalanan'
                WHERE idTransaksi = '$idTransaksi'
                ";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

// Function menolak transaksi dan mengembalikan stok produk
function tolakTransaksi($idTransaksi)
{
    global $connect;

    // Query memperbarui status transaksi
    $query = "UPDATE transaksi SET 
                statusTransaksi = 'Ditolak',
                statusPengiriman = 'Dibatalkan'
                WHERE idTransaksi = '$idTransaksi'
                ";
    mysqli_query($connect, $query);

    // Mengambil semua produk dalam keranjang
    $allKeranjang = query("SELECT * FROM keranjang WHERE idTransaksi = '$idTransaksi'");

    // Loop mengembalikan stok produk
    foreach ($allKeranjang as $keranjang) {
        $idProduk = $keranjang["idProduk"];
        $jumlah = $keranjang["jumlah"];
        // Upadate stoke produk berdasarkan jumlah pada keranjang yang dibatalkan
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk + '$jumlah' WHERE idProduk = '$idProduk'");
    }
    return mysqli_affected_rows($connect);
}

// Function untuk upadate data customer
function updateCust($data)
{
    global $connect;

    // Ambil data dan membersihkan input
    $username = $data["username"];
    $password = htmlspecialchars($data["password"]);
    $namaLengkap = htmlspecialchars($data["namaLengkap"]);
    $email = htmlspecialchars($data["email"]);
    $dob = htmlspecialchars($data["dob"]);
    $gender = htmlspecialchars($data["gender"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kota = htmlspecialchars($data["kota"]);
    $contact = htmlspecialchars($data["contact"]);
    $paypalID = htmlspecialchars($data["paypalID"]);

    // Penanganan password
    if ($password == '') {
        $password = $data["passwordOLD"]; // Jika password tidak diubah, gunakan password lama
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT); // Jika password diubah, hash password baru
    }

    // Query update menggunakan primary key username
    $query = "UPDATE customer SET 
            password = '$password',
            namaLengkap = '$namaLengkap',
            email = '$email',
            dob = '$dob',
            gender = '$gender',
            alamat = '$alamat',
            kota = '$kota',
            contact = '$contact',
            paypalID = '$paypalID'
            WHERE username = '$username'
            ";

    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}
