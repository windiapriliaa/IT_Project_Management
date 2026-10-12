<!DOCTYPE html>
<html lang="id">

<head>

      <meta charset="UTF-8">

      <title>Tambah Pengguna</title>

      <link rel="stylesheet"
            href="../css/style.css">

</head>

<body>

      <div class="container">

            <div class="card">

                  <h1>Tambah Pengguna</h1>

                  <form action="../proses_register.php"
                        method="POST">

                        <div class="form-group">

                              <label>Nama</label>

                              <input
                                    name="nama_lengkap"
                                    required>

                        </div>

                        <div class="form-group">

                              <label>NIM / NIP</label>

                              <input
                                    name="nomor_induk">

                        </div>

                        <div class="form-group">

                              <label>Email</label>

                              <input
                                    type="email"
                                    name="email"
                                    required>

                        </div>

                        <div class="form-group">

                              <label>Peran</label>

                              <select name="peran">

                                    <option value="mahasiswa">
                                          Mahasiswa
                                    </option>

                                    <option value="dosen">
                                          Dosen
                                    </option>

                                    <option value="admin_kampus">
                                          Admin Kampus
                                    </option>

                                    <option value="vendor">
                                          Vendor
                                    </option>

                                    <option value="admin_sistem">
                                          Admin Sistem
                                    </option>

                              </select>

                        </div>

                        <div class="form-group">

                              <label>Password</label>

                              <input
                                    type="password"
                                    name="kata_sandi"
                                    required>

                        </div>

                        <div class="form-group">

                              <label>Kontak</label>

                              <input
                                    name="kontak">

                        </div>

                        <button class="tombol-kirim">

                              Simpan

                        </button>

                  </form>

                  <a href="pengguna.php"
                        class="btn">

                        ← Kembali

                  </a>

            </div>

      </div>

</body>

</html>