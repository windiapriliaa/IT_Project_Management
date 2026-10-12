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

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM pengguna
     ORDER BY id_pengguna DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Kelola Pengguna</title>

    <link rel="stylesheet"
        href="../css/style.css">

</head>

<body>

    <div class="container">

        <div class="card">

            <h1>👥 Kelola Pengguna</h1>

            <a href="tambah_pengguna.php"
                class="btn">

                + Tambah Pengguna

            </a>

            <br><br>

            <table>

                <tr>

                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th>Kontak</th>
                    <th>Aksi</th>

                </tr>

                <?php while ($data = mysqli_fetch_assoc($query)): ?>

                    <tr>

                        <td>
                            <?= $data['id_pengguna'] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['nama_lengkap']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['peran']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['kontak']) ?>
                        </td>

                        <td>

                            <a
                                href="hapus_pengguna.php?id=<?= $data['id_pengguna'] ?>"
                                class="btn btn-danger"
                                onclick="return confirm('Hapus pengguna ini?')">

                                Hapus

                            </a>

                        </td>

                    </tr>

                <?php endwhile; ?>

            </table>

        </div>

    </div>

</body>

</html>