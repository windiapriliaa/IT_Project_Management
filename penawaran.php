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

$id = intval($_GET['id'] ?? 0);
$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM laporan
     WHERE id_laporan = $id"
);

$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Pekerjaan tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Penawaran</title>
    <link rel="stylesheet"
        href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>💰 Ajukan Penawaran</h1>

            <h3>
                <?= htmlspecialchars($data['judul_laporan']) ?>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($data['deskripsi'])) ?>
            </p>

            <form action="../pesan/kirim.php"
                method="POST">

                <input
                    type="hidden"
                    name="id_penerima"
                    value="1">

                <div class="form-group">
                    <label>Isi Penawaran</label>
                    <textarea
                        name="isi_pesan"
                        rows="5"
                        placeholder="Masukkan estimasi biaya dan waktu..."
                        required></textarea>

                </div>

                <button class="tombol-kirim">
                    Kirim Penawaran
                </button>

            </form>

            <a href="dashboard.php"
                class="btn">
                ← Kembali
            </a>

        </div>
    </div>
</body>

</html>