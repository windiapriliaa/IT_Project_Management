<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: ../login.php");
    exit;
}

$id_pengirim = $_SESSION['id_pengguna'];
$id_penerima = intval(
    $_POST['id_penerima'] ?? 0
);

$isi_pesan = trim(
    $_POST['isi_pesan'] ?? ''
);

if (
    $id_penerima <= 0 ||
    $isi_pesan == ''
) {
    die("Data pesan tidak lengkap.");
}

$query = mysqli_prepare(
    $koneksi,
    "INSERT INTO pesan
    (id_pengirim, id_penerima, isi_pesan)
    VALUES (?, ?, ?)"
);

mysqli_stmt_bind_param(
    $query,
    "iis",
    $id_pengirim,
    $id_penerima,
    $isi_pesan
);

mysqli_stmt_execute($query);
header("Location: index.php");
exit;
