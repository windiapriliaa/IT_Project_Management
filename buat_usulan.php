<?php
session_start();
if (
    !isset($_SESSION['id_pengguna']) ||
    $_SESSION['peran'] != 'dosen'
) {
    header("Location: ../login.php?peran=dosen");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buat Usulan</title>
    <link rel="stylesheet"
        href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>🎓 Buat Usulan</h1>
            <form action="simpan_usulan.php"
                method="POST">
                <div class="form-group">
                    <label>Jenis Laporan</label>
                    <select name="jenis">
                        <option value="kerusakan">
                            Lapor Kerusakan Fasilitas
                        </option>

                        <option value="pengadaan">
                            Ajukan Pengadaan Barang
                        </option>

                    </select>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input
                        type="text"
                        name="judul"
                        required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        rows="5"
                        required></textarea>

                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input
                        type="text"
                        name="lokasi"
                        required>
                </div>

                <button class="tombol-kirim">
                    Kirim Usulan
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