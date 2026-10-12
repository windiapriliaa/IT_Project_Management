<?php
$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "uin_campus_care"
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
