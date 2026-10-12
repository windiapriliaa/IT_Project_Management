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

$pengguna = mysqli_query(
    $koneksi,
    "SELECT
        nama_lengkap,
        peran,
        dibuat_pada
     FROM pengguna
     ORDER BY dibuat_pada DESC"
);

$laporan = mysqli_query(
    $koneksi,
    "SELECT
        laporan.id_laporan,
        laporan.judul_laporan,
        laporan.status,
        laporan.dibuat_pada,
        pengguna.nama_lengkap
     FROM laporan
     JOIN pengguna
     ON laporan.id_pengguna = pengguna.id_pengguna
     ORDER BY laporan.dibuat_pada DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Log Sistem</title>

    <link rel="stylesheet"
        href="../css/style.css">

</head>

<body>

    <div class="container">

        <div class="card">

            <h1>⚙️ Log Pengguna</h1>

            <table>

                <tr>

                    <th>Nama</th>
                    <th>Peran</th>
                    <th>Dibuat</th>

                </tr>

                <?php while ($data = mysqli_fetch_assoc($pengguna)): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($data['nama_lengkap']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['peran']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['dibuat_pada']) ?>
                        </td>

                    </tr>

                <?php endwhile; ?>

            </table>

        </div>


        <div class="card">

            <h1>📋 Aktivitas Laporan</h1>

            <table>

                <tr>

                    <th>Pelapor</th>
                    <th>Laporan</th>
                    <th>Status</th>
                    <th>Waktu</th>

                </tr>

                <?php while ($data = mysqli_fetch_assoc($laporan)): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($data['nama_lengkap']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['judul_laporan']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['status']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['dibuat_pada']) ?>
                        </td>

                    </tr>

                <?php endwhile; ?>

            </table>

        </div>

    </div>

</body>

</html>