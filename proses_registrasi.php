<?php

include "koneksi.php";


// ===============================
// CEK METHOD
// ===============================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit;
}


// ===============================
// AMBIL DATA FORM
// ===============================

$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
$nomor_induk  = trim($_POST['nomor_induk'] ?? '');
$peran        = trim($_POST['peran'] ?? '');
$email        = trim($_POST['email'] ?? '');
$kata_sandi   = $_POST['kata_sandi'] ?? '';
$kontak       = trim($_POST['kontak'] ?? '');


// ===============================
// CEK DATA WAJIB
// ===============================

if (
    $nama_lengkap === '' ||
    $peran === '' ||
    $email === '' ||
    $kata_sandi === ''
) {

    header(
        "Location: register.php?error=" .
            urlencode("Data wajib belum lengkap.")
    );

    exit;
}


// ===============================
// CEK PERAN
// ===============================

$peran_valid = [
    'mahasiswa',
    'dosen',
    'admin_kampus',
    'vendor',
    'admin_sistem'
];

if (!in_array($peran, $peran_valid, true)) {

    header(
        "Location: register.php?error=" .
            urlencode("Peran tidak valid.")
    );

    exit;
}


// ===============================
// CEK EMAIL SUDAH ADA
// ===============================

$cek_email = mysqli_prepare(
    $koneksi,
    "SELECT id_pengguna
     FROM pengguna
     WHERE email = ?
     LIMIT 1"
);

mysqli_stmt_bind_param(
    $cek_email,
    "s",
    $email
);

mysqli_stmt_execute($cek_email);

$result_email =
    mysqli_stmt_get_result($cek_email);


if (mysqli_num_rows($result_email) > 0) {

    header(
        "Location: register.php?error=" .
            urlencode("Email sudah terdaftar.")
    );

    exit;
}


// ===============================
// CEK NIM / NIP
// ===============================

if ($nomor_induk !== '') {

    $cek_nim = mysqli_prepare(
        $koneksi,
        "SELECT id_pengguna
         FROM pengguna
         WHERE nomor_induk = ?
         LIMIT 1"
    );

    mysqli_stmt_bind_param(
        $cek_nim,
        "s",
        $nomor_induk
    );

    mysqli_stmt_execute($cek_nim);

    $result_nim =
        mysqli_stmt_get_result($cek_nim);


    if (mysqli_num_rows($result_nim) > 0) {

        header(
            "Location: register.php?error=" .
                urlencode("NIM / NIP sudah terdaftar.")
        );

        exit;
    }
}


// ===============================
// HASH PASSWORD
// ===============================

$password_hash = password_hash(
    $kata_sandi,
    PASSWORD_DEFAULT
);


// ===============================
// SIMPAN DATA
// ===============================

$query = mysqli_prepare(
    $koneksi,
    "INSERT INTO pengguna
    (
        nama_lengkap,
        nomor_induk,
        peran,
        email,
        kata_sandi,
        kontak
    )
    VALUES
    (
        ?, ?, ?, ?, ?, ?
    )"
);


mysqli_stmt_bind_param(
    $query,
    "ssssss",
    $nama_lengkap,
    $nomor_induk,
    $peran,
    $email,
    $password_hash,
    $kontak
);


// ===============================
// EKSEKUSI
// ===============================

if (mysqli_stmt_execute($query)) {

    header(
        "Location: login.php?peran=" .
            urlencode($peran) .
            "&success=" .
            urlencode("Registrasi berhasil. Silakan login.")
    );

    exit;
} else {

    header(
        "Location: register.php?error=" .
            urlencode(
                "Registrasi gagal: " .
                    mysqli_error($koneksi)
            )
    );

    exit;
}
