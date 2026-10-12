<?php

session_start();

include "../koneksi.php";

if (
    !isset($_SESSION['id_pengguna']) ||
    $_SESSION['peran'] != 'vendor'
) {

    header("Location: ../login.php?peran=vendor");
    exit;
}

$id = $_SESSION['id_pengguna'];

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM vendor
     WHERE id_pengguna = $id
     LIMIT 1"
);

$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Profil Vendor</title>

    <link rel="stylesheet"
        href="../css/style.css">

</head>

<body>

    <div class="container">

        <div class="card">

            <h1>🔧 Profil Usaha</h1>

            <?php if ($data): ?>

                <p>
                    <strong>Nama Usaha:</strong>
                    <?= htmlspecialchars($data['nama_usaha']) ?>
                </p>

                <p>
                    <strong>Jenis Layanan:</strong>
                    <?= htmlspecialchars($data['jenis_layanan']) ?>
                </p>

                <p>
                    <strong>Daftar Harga:</strong>
                    <?= nl2br(htmlspecialchars($data['daftar_harga'])) ?>
                </p>

            <?php else: ?>

                <p>
                    Profil vendor belum dibuat.
                </p>

            <?php endif; ?>

            <a href="dashboard.php"
                class="btn">

                ← Kembali

            </a>

        </div>

    </div>

</body>

</html>