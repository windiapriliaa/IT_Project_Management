<?php
session_start();
include "../koneksi.php";
if (
    !isset($_SESSION['id_pengguna']) ||
    $_SESSION['peran'] != 'admin_kampus'
) {
    header("Location: ../login.php?peran=admin_kampus");
    exit;
}

$id_laporan = intval($_POST['id_laporan'] ?? 0);
$status = $_POST['status'] ?? '';
$status_valid = [
    'baru',
    'diproses',
    'selesai',
    'ditolak'
];

if (!in_array($status, $status_valid)) {
    die("Status tidak valid.");
}

$query = mysqli_prepare(
    $koneksi,
    "UPDATE laporan
     SET status = ?
     WHERE id_laporan = ?"
);

mysqli_stmt_bind_param(
    $query,
    "si",
    $status,
    $id_laporan
);

mysqli_stmt_execute($query);
header(
    "Location: detail_laporan.php?id=" .
        $id_laporan
);

exit;
