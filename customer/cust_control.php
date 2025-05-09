<?php

require '../connect.php';
require 'fpdf/fpdf.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

// Import namespace PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function untuk menambah produk ke keranjang
function tambahKeranjang($idProduk)
{
    global $connect;

    // Mengambil data session dan parameter
    $username = $_SESSION["username"];
    $idProduk = $idProduk;
    $jumlah = 1;

    // Mengambil harga produk dari database
    $harga = query("SELECT hargaProduk FROM produk WHERE idProduk = '$idProduk'")[0]["hargaProduk"];

    // Cek apakah produk sudah ada di keranjang dengan status 'Belum Dibayar'
    $cekProduk = mysqli_query($connect, "SELECT * FROM keranjang WHERE idProduk = '$idProduk' && username = '$username' && status = 'Belum Dibayar'");

    // Jika produk sudah ada, update jumlah dan total harga
    if (mysqli_num_rows($cekProduk) > 0) {
        $row = mysqli_fetch_assoc($cekProduk); // Ambil data produk dari keranjang
        $jumlah = $row["jumlah"] + 1; // Update jumlah produk
        $totalHarga = $harga * $jumlah; // Update total harga

        // Update tabel keranjang
        mysqli_query($connect, "UPDATE keranjang SET jumlah = '$jumlah', harga = '$totalHarga' WHERE idProduk = '$idProduk' && username = '$username' && status = 'Belum Dibayar'");

        // Update tabel produk kurangi stok
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk - 1 WHERE idProduk = '$idProduk'");

        return mysqli_affected_rows($connect);

        // Jika produk belum ada, tambahkan ke keranjang
    } else {
        $totalHarga = $harga * $jumlah; // Hitung total harga

        // Tambahkan produk ke keranjang
        $query = "INSERT INTO keranjang VALUES('', '$username', '$idProduk', '$jumlah', '$totalHarga', 'Belum Dibayar', '')";

        // Update tabel produk kurangi stok
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk - 1 WHERE idProduk = '$idProduk'");

        // Eksekusi query
        mysqli_query($connect, $query);
        return mysqli_affected_rows($connect);
    }
}

// Function untuk hapus keranjang
function hapusKeranjang($username)
{
    global $connect;

    // Mengambil semua produk di keranjang yang belum dibayar
    $allKeranjang = query("SELECT * FROM keranjang WHERE username = '$username' && status = 'Belum Dibayar'");

    // Mengembalikan stok produk
    foreach ($allKeranjang as $keranjang) {
        $idProduk = $keranjang["idProduk"];
        $jumlah = $keranjang["jumlah"];
        mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk + '$jumlah' WHERE idProduk = '$idProduk'");
    }

    // Hapus semua produk di keranjang
    $query = "DELETE FROM keranjang WHERE username = '$username' && status = 'Belum Dibayar'";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}

function checkout($data)
{
    global $connect;

    // Inisialisasi data transaksi
    $idTransaksi = 'TRS-' . time();
    $username = $data["username"];
    $tanggalTransaksi = date("Y-m-d");
    $caraBayar = $data["caraBayar"];
    $bank = $data["bank"];
    $statusTransaksi = "Tertunda";
    $totalHarga = $data["totalHarga"];
    $contact = $data["contact"]; // Ini adalah nomor telepon yang akan digunakan

    // Simpan data transaksi ke db
    $queryTransaksi = "INSERT INTO transaksi 
        VALUES('$idTransaksi', '$username', '$tanggalTransaksi', '$caraBayar', '$bank', '$statusTransaksi', '$totalHarga', 'Tertunda','')";
    mysqli_query($connect, $queryTransaksi);

    // Update status keranjang
    $queryKeranjang = "UPDATE keranjang 
        SET status = 'Dibayar', idTransaksi='$idTransaksi' 
        WHERE username = '$username' && status = 'Belum Dibayar'";
    mysqli_query($connect, $queryKeranjang);

    // Ambil info untuk invoice
    $queryItems = "SELECT produk.idProduk, produk.namaProduk, keranjang.jumlah, keranjang.harga 
                   FROM keranjang 
                   JOIN produk ON keranjang.idProduk = produk.idProduk 
                   WHERE keranjang.username = '$username' AND keranjang.idTransaksi = '$idTransaksi'";
    $resultItems = mysqli_query($connect, $queryItems);

    $items = [];
    while ($row = mysqli_fetch_assoc($resultItems)) {
        $items[] = $row;
    }

    // Ambil email user
    $queryUser = "SELECT email FROM customer WHERE username = '$username'";
    $resultUser = mysqli_query($connect, $queryUser);
    $emailUser = mysqli_fetch_assoc($resultUser)["email"];

    // Ambil contact user
    $contactUser = query("SELECT contact FROM customer WHERE username = '$username'")[0]["contact"];
    $contact = $contactUser ? $contactUser : $contact; // Gunakan contact dari form jika tidak ada di database

    // Membuat invoice PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Logo
    $logoWidth = 15;
    $centerX = ($pdf->GetPageWidth() - $logoWidth) / 2;
    $pdf->Image('../img/Logo MedShop.png', $centerX, 10, $logoWidth);

    // Header text
    $pdf->SetY(30);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'MedShop', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Invoice Belanja', 0, 1, 'C');
    $pdf->Ln(10);

    // Info transaksi
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "ID Transaksi: $idTransaksi", 0, 1);
    $pdf->Cell(0, 10, "Nama: $username", 0, 1);
    $pdf->Cell(0, 10, "Tanggal: $tanggalTransaksi", 0, 1);
    $pdf->Cell(0, 10, "Metode: $caraBayar via $bank", 0, 1);
    $pdf->Ln(5);

    // Tabel belanja
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(50, 10, 'ID Produk', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Produk', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Harga', 1, 0, 'C');
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    $no = 1;
    foreach ($items as $item) {
        $pdf->Cell(10, 10, $no++, 1, 0, 'C');
        $pdf->Cell(50, 10, $item['idProduk'], 1, 0, 'C');
        $pdf->Cell(80, 10, $item['namaProduk'], 1, 0, 'C');
        $pdf->Cell(20, 10, $item['jumlah'], 1, 0, 'C');
        $pdf->Cell(30, 10, "Rp" . number_format($item['harga'], 0, ',', '.'), 1, 0, 'C');
        $pdf->Ln();
    }

    $pdf->Cell(140, 10, 'Total belanja (termasuk pajak)', 1);
    $pdf->Cell(50, 10, "Rp" . number_format($totalHarga, 0, ',', '.'), 1, 0, 'C');
    $pdf->Ln(20);

    // Virtual account 
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "Informasi Pembayaran", 0, 1);
    $pdf->SetFont('Arial', '', 12);

    // Format nomor telepon (hilangkan karakter non-digit)
    $cleanContact = preg_replace('/[^0-9]/', '', $contact);

    // Generate virtual account number
    $virtualAccount = '';
    switch (strtoupper($bank)) {
        case 'BCA':
            $virtualAccount = '123' . substr($cleanContact, -10); // Ambil 10 digit terakhir
            break;
        case 'BNI':
            $virtualAccount = '456' . substr($cleanContact, -10);
            break;
        case 'BRI':
            $virtualAccount = '789' . substr($cleanContact, -10);
            break;
        case 'MANDIRI':
            $virtualAccount = '147' . substr($cleanContact, -10);
            break;
        default:
            $virtualAccount = 'Siapkan uang tunai untuk COD';
    }

    // Tambahkan informasi pembayaran yang lebih jelas
    $pdf->Cell(0, 10, "Via: $bank", 0, 1);
    $pdf->Cell(0, 10, "Nomor Virtual Account: $virtualAccount", 0, 1);
    $pdf->Cell(0, 10, "Jumlah yang harus dibayar: Rp" . number_format($totalHarga, 0, ',', '.'), 0, 1);
    $pdf->Ln(10);

    // Tanda tangan
    $pdf->Cell(0, 10, 'Hormat kami,', 0, 1, 'R');
    $pdf->Cell(0, 10, 'MedShop', 0, 1, 'R');
    $pdf->Image('../img/ttd1.png', 170, $pdf->GetY(), 30);

    // Simpan PDF
    $namaFile = 'Invoice_' . $idTransaksi . '.pdf';
    $lokasiFile = 'invoices/' . $namaFile;
    if (!file_exists('invoices')) mkdir('invoices', 0777, true);
    $pdf->Output('F', $lokasiFile);

    // Kirim email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alfinaandriani2902@gmail.com';
        $mail->Password = 'ktrithxckdhxoqpb';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('alfinaandriani2902@gmail.com', 'MedShop');
        $mail->addAddress($emailUser);
        $mail->Subject = "Invoice Pembayaran - $idTransaksi";

        // Isi email yang lebih informatif
        $mail->Body = "Yth. $username,

Terima kasih telah berbelanja di MedShop.

Detail Pesanan:
- Nomor Transaksi: $idTransaksi
- Tanggal: $tanggalTransaksi
- Total Pembayaran: Rp" . number_format($totalHarga, 0, ',', '.') . "
- Metode Pembayaran: $caraBayar via $bank
- Nomor Virtual Account: $virtualAccount

Silakan lakukan pembayaran dalam waktu 24 jam ke nomor virtual account di atas.

Invoice lengkap kami lampirkan dalam email ini.

Jika Anda memiliki pertanyaan, silakan hubungi kami.

Hormat kami,
Tim MedShop";

        $mail->addAttachment($lokasiFile);
        $mail->send();
    } catch (Exception $e) {
        error_log("Email gagal dikirim: {$mail->ErrorInfo}");
    }

    return mysqli_affected_rows($connect);
}

// Function untuk batalkan transaksi
function batalkanTransaksi($idTransaksi)
{
    global $connect;

    // Ambil status transaksi
    $statusTransaksi = query("SELECT statusTransaksi FROM transaksi WHERE idTransaksi = '$idTransaksi'")[0]["statusTransaksi"];
    $username = $_SESSION["username"];

    // Jika status transaksi sudah Diterima maka tidak bisa dibatalkan
    if ($statusTransaksi == 'Diterima') {
        return 0;
    } else {
        // Ambil semua produk di keranjang lalu tambahkan ke stok produk
        $allKeranjang = query("SELECT * FROM keranjang WHERE idTransaksi = '$idTransaksi' && username = '$username' && status = 'Dibayar'");
        foreach ($allKeranjang as $keranjang) {
            $idProduk = $keranjang["idProduk"];
            $jumlah = $keranjang["jumlah"];
            mysqli_query($connect, "UPDATE produk SET stokProduk = stokProduk + '$jumlah' WHERE idProduk = '$idProduk'");
        }
        // Update status transaksi dan pengiriman menjadi dibatalkan
        mysqli_query($connect, "UPDATE transaksi SET statusTransaksi = 'Dibatalkan', statusPengiriman = 'Dibatalkan' WHERE idTransaksi = '$idTransaksi' AND username = '$username'");
        // Update status keranjang menjadi dibatalkan
        mysqli_query($connect, "UPDATE keranjang SET status = 'Dibatalkan' WHERE idTransaksi = '$idTransaksi'");
        return mysqli_affected_rows($connect);
    }
}

// Function untuk selesaikan transaksi
function selesaikanTransaksi($idTransaksi)
{
    global $connect;

    // Ambil status transaksi
    $statusTransaksi = query("SELECT statusTransaksi FROM transaksi WHERE idTransaksi = '$idTransaksi'")[0]["statusTransaksi"];
    $username = $_SESSION["username"];

    // Jika status transaksi sudah ditolak atau dibatalkan maka tidak bisa diseelesaikan
    if ($statusTransaksi == 'Ditolak' || $statusTransaksi == 'Dibatalkan') {
        return 0;
    } else {
        // Update status pengiriman menjadi terkirim 
        $query = "UPDATE transaksi SET statusPengiriman = 'Terkirim' WHERE idTransaksi = '$idTransaksi' && username = '$username'";
        mysqli_query($connect, $query);
        return mysqli_affected_rows($connect);
    }
}

// Function untuk feedback
function feedback($data)
{
    global $connect;

    $idTransaksi = $data["idTransaksi"];
    $feedBack = htmlspecialchars($data["feedBack"]);

    $query = "UPDATE transaksi SET feedBack = '$feedBack' WHERE idTransaksi = '$idTransaksi'";
    mysqli_query($connect, $query);
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
