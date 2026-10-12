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

$id = intval($_GET['id'] ?? 0);
$query = mysqli_query(
    $koneksi,
    "SELECT
        laporan.*,
        pengguna.nama_lengkap,
        pengguna.email,
        pengguna.kontak
     FROM laporan
     JOIN pengguna
     ON laporan.id_pengguna = pengguna.id_pengguna
     WHERE laporan.id_laporan = $id"
);

$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Laporan tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Laporan</title>
    <link rel="stylesheet"
        href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>📋 Detail Laporan</h1>

            <p>
                <strong>Pelapor:</strong>
                <?= htmlspecialchars($data['nama_lengkap']) ?>
            </p>

            <p>
                <strong>Email:</strong>
                <?= htmlspecialchars($data['email']) ?>
            </p>

            <p>
                <strong>Kontak:</strong>
                <?= htmlspecialchars($data['kontak']) ?>
            </p>

            <p>
                <strong>Judul:</strong>
                <?= htmlspecialchars($data['judul_laporan']) ?>
            </p>

            <p>
                <strong>Deskripsi:</strong><br>
                <?= nl2br(htmlspecialchars($data['deskripsi'])) ?>
            </p>

            <p>
                <strong>Lokasi:</strong>
                <?= htmlspecialchars($data['lokasi_ruang']) ?>
            </p>

            <p>
                <strong>Status sekarang:</strong>
                <span class="status <?= $data['status'] ?>">
                    <?= htmlspecialchars($data['status']) ?>
                </span>
            </p>

            <?php if (!empty($data['foto_bukti'])): ?>
                <p>
                    <strong>Foto Bukti:</strong>
                </p>

                <img
                    src="../uploads/<?= htmlspecialchars($data['foto_bukti']) ?>"
                    style="max-width:400px;border-radius:10px;">

            <?php endif; ?>
            <hr>
            <h2>Update Status</h2>
            <form action="update_status.php"
                method="POST">
                <input
                    type="hidden"
                    name="id_laporan"
                    value="<?= $data['id_laporan'] ?>">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="baru">
                            Baru
                        </option>
                        <option value="diproses">
                            Diproses
                        </option>

                        <option value="selesai">
                            Selesai
                        </option>

                        <option value="ditolak">
                            Ditolak
                        </option>

                    </select>
                </div>
                <button class="tombol-kirim">
                    Simpan Status
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