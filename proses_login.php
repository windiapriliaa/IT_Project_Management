<?php
session_start();
include "koneksi.php";
$email = $_POST['email'] ?? '';
$kata_sandi = $_POST['kata_sandi'] ?? '';
$peran = $_POST['peran'] ?? '';
if ($email == '' || $kata_sandi == '') {
    header("Location: login.php?peran=$peran&error=Email dan password wajib diisi");
    exit;
}

$query = mysqli_prepare(
    $koneksi,
    "SELECT * FROM pengguna
     WHERE email = ? AND peran = ?
     LIMIT 1"
);

mysqli_stmt_bind_param(
    $query,
    "ss",
    $email,
    $peran
);

mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$user = mysqli_fetch_assoc($result);
if (!$user) {
    header("Location: login.php?peran=$peran&error=Akun tidak ditemukan");
    exit;
}

if (!password_verify($kata_sandi, $user['kata_sandi'])) {
    header("Location: login.php?peran=$peran&error=Password salah");
    exit;
}

$_SESSION['id_pengguna'] = $user['id_pengguna'];
$_SESSION['nama_lengkap'] = $user['nama_lengkap'];
$_SESSION['peran'] = $user['peran'];
$_SESSION['email'] = $user['email'];

switch ($user['peran']) {
    case 'mahasiswa':
        header("Location: mahasiswa/dashboard.php");
        break;
    case 'dosen':
        header("Location: dosen/dashboard.php");
        break;
    case 'admin_kampus':
        header("Location: admin_kampus/dashboard.php");
        break;
    case 'vendor':
        header("Location: vendor/dashboard.php");
        break;
    case 'admin_sistem':
        header("Location: admin_sistem/dashboard.php");
        break;
}
exit;
