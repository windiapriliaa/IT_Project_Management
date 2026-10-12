<?php
session_start();
include "../koneksi.php";
if (
    !isset($_SESSION['id_pengguna']) ||
    $_SESSION['peran'] != 'dosen'
) {
    header("Location: ../login.php?peran=dosen");
    exit;
}

$id_pengguna = $_SESSION['id_pengguna'];
$jenis = $_POST['jenis'] ?? '';
$judul = $_POST['judul'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$lokasi = $_POST['lokasi'] ?? '';
$judul_final = "[" .
    strtoupper($jenis) .
    "] " .
    $judul;
$query = mysqli_prepare(
    $koneksi,
    "INSERT INTO laporan
    (id_pengguna, judul_laporan, deskripsi, lokasi_ruang)
    VALUES (?, ?, ?, ?)"
);

mysqli_stmt_bind_param(
    $query,
    "isss",
    $id_pengguna,
    $judul_final,
    $deskripsi,
    $lokasi
);

mysqli_stmt_execute($query);
header("Location: dashboard.php");
exit;
