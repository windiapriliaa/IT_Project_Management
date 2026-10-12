<?php
session_start();
include "../koneksi.php";
if (
    !isset($_SESSION['id_pengguna']) ||
    $_SESSION['peran'] != 'mahasiswa'
) {

    header("Location: ../login.php?peran=mahasiswa");
    exit;
}

$id_pengguna = $_SESSION['id_pengguna'];
$judul = $_POST['judul_laporan'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$lokasi = $_POST['lokasi_ruang'] ?? '';

if (
    $judul == '' ||
    $deskripsi == '' ||
    $lokasi == ''
) {
    die("Data laporan belum lengkap.");
}

$nama_file = NULL;
if (
    isset($_FILES['foto_bukti']) &&
    $_FILES['foto_bukti']['error'] == 0
) {
    $folder = "../uploads/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $nama_asli = $_FILES['foto_bukti']['name'];
    $ekstensi = strtolower(
        pathinfo($nama_asli, PATHINFO_EXTENSION)
    );

    $ekstensi_diizinkan = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];

    if (!in_array($ekstensi, $ekstensi_diizinkan)) {
        die("Format foto tidak diizinkan.");
    }

    $nama_file =
        time() . "_" .
        uniqid() . "." .
        $ekstensi;
    move_uploaded_file(
        $_FILES['foto_bukti']['tmp_name'],
        $folder . $nama_file
    );
}

$query = mysqli_prepare(
    $koneksi,
    "INSERT INTO laporan
    (id_pengguna, judul_laporan, deskripsi, lokasi_ruang, foto_bukti)
    VALUES (?, ?, ?, ?, ?)"
);

mysqli_stmt_bind_param(
    $query,
    "issss",
    $id_pengguna,
    $judul,
    $deskripsi,
    $lokasi,
    $nama_file
);

if (mysqli_stmt_execute($query)) {

    header("Location: status_laporan.php?success=1");
    exit;
}

echo "Gagal menyimpan laporan.";
