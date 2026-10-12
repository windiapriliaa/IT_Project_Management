<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Daftar - UIN Kampus Care</title>

    <link
        rel="stylesheet"
        href="css/style.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1e293b;
        }

        .register-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px 15px;
        }

        .register-wrapper {
            width: 100%;
            max-width: 520px;
        }

        .register-box {
            background: white;

            padding: 35px;

            border-radius: 20px;

            box-shadow:
                0 15px 40px rgba(15, 23, 42, 0.10);

            border: 1px solid #e2e8f0;
        }

        .logo {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #2563eb;

            color: white;

            border-radius: 15px;

            font-size: 27px;

            margin-bottom: 18px;
        }

        h1 {
            margin: 0;

            font-size: 28px;

            color: #0f172a;
        }

        .subtitle {
            margin-top: 8px;
            margin-bottom: 28px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 13px;

            font-weight: bold;
        }

        .required {
            color: #dc2626;
        }

        input,
        select {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #cbd5e1;

            border-radius: 10px;

            background: white;

            color: #334155;

            font-size: 14px;

            outline: none;

            transition: 0.2s;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        select {
            cursor: pointer;
        }

        .tombol-kirim {
            width: 100%;

            border: none;

            padding: 14px;

            margin-top: 5px;

            border-radius: 10px;

            background: #2563eb;

            color: white;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .tombol-kirim:hover {
            background: #1d4ed8;

            transform: translateY(-1px);
        }

        .alert {
            padding: 12px 14px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 13px;
        }

        .error {
            background: #fee2e2;

            color: #991b1b;

            border: 1px solid #fecaca;
        }

        .link {
            text-align: center;

            margin-top: 20px;

            margin-bottom: 0;

            color: #64748b;

            font-size: 13px;
        }

        .link a {
            color: #2563eb;

            text-decoration: none;

            font-weight: bold;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .role-info {
            margin-top: 7px;

            font-size: 11px;

            color: #94a3b8;

            line-height: 1.5;
        }

        @media (max-width: 600px) {

            .register-page {
                padding: 20px 12px;
            }

            .register-box {
                padding: 25px 20px;
            }

            h1 {
                font-size: 24px;
            }

        }
    </style>

</head>


<body>


    <div class="register-page">

        <div class="register-wrapper">

            <div class="register-box">


                <!-- LOGO -->

                <div class="logo">
                    🏫
                </div>


                <!-- JUDUL -->

                <h1>
                    Buat Akun
                </h1>

                <p class="subtitle">
                    Daftar akun untuk menggunakan
                    layanan UIN Kampus Care.
                </p>


                <!-- ERROR -->

                <?php if (isset($_GET['error'])): ?>

                    <div class="alert error">

                        <?= htmlspecialchars(
                            $_GET['error']
                        ) ?>

                    </div>

                <?php endif; ?>


                <!-- FORM -->

                <form
                    action="proses_registrasi.php"
                    method="POST">


                    <!-- NAMA -->

                    <div class="form-group">

                        <label>
                            Nama Lengkap
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama_lengkap"
                            placeholder="Masukkan nama lengkap"
                            required>

                    </div>


                    <!-- NIM / NIP -->

                    <div class="form-group">

                        <label>
                            NIM / NIP
                        </label>

                        <input
                            type="text"
                            name="nomor_induk"
                            placeholder="Masukkan NIM atau NIP">

                    </div>


                    <!-- PERAN -->

                    <div class="form-group">

                        <label>
                            Peran
                            <span class="required">*</span>
                        </label>

                        <select
                            name="peran"
                            required>

                            <option value="">
                                -- Pilih Peran --
                            </option>

                            <option value="mahasiswa">
                                👨‍🎓 Mahasiswa
                            </option>

                            <option value="dosen">
                                👨‍🏫 Dosen & Staf
                            </option>

                            <option value="admin_kampus">
                                🏢 Admin Kampus
                            </option>

                            <option value="vendor">
                                🔧 Vendor
                            </option>

                            <option value="admin_sistem">
                                ⚙️ Admin Sistem
                            </option>

                        </select>

                        <div class="role-info">
                            Pilih peran sesuai dengan akun
                            yang akan digunakan.
                        </div>

                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label>
                            Email
                            <span class="required">*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="contoh@email.com"
                            required>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label>
                            Password
                            <span class="required">*</span>
                        </label>

                        <input
                            type="password"
                            name="kata_sandi"
                            placeholder="Masukkan password"
                            required>

                    </div>


                    <!-- WHATSAPP -->

                    <div class="form-group">

                        <label>
                            No. WhatsApp
                        </label>

                        <input
                            type="text"
                            name="kontak"
                            placeholder="08xxxxxxxxxx">

                    </div>


                    <!-- BUTTON -->

                    <button
                        type="submit"
                        class="tombol-kirim">
                        Daftar Sekarang
                    </button>


                </form>


                <!-- LOGIN -->

                <p class="link">

                    Sudah punya akun?

                    <a href="login.php">
                        Login di sini
                    </a>

                </p>


                <!-- HOME -->

                <p class="link">

                    <a href="index.php">
                        ← Kembali ke halaman utama
                    </a>

                </p>


            </div>

        </div>

    </div>


</body>

</html>