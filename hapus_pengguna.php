<?php

session_start();

include "../koneksi.php";

if (
    !isset($_SESSION['id_pengguna']) ||
    $_SESSION['peran'] != 'admin_sistem'
) {

    header("Location: ../login.php?peran=admin_sistem");
    exit;
}

$id = intval($_GET['id'] ?? 0);

if ($id == $_SESSION['id_pengguna']) {
    die("Akun yang sedang digunakan tidak boleh dihapus.");
}

$query = mysqli_prepare(
    $koneksi,
    "DELETE FROM pengguna
     WHERE id_pengguna = ?"
);

mysqli_stmt_bind_param(
    $query,
    "i",
    $id
);

mysqli_stmt_execute($query);

header("Location: pengguna.php");

exit;
