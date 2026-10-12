<?php
$peran = $_GET['peran'] ?? 'mahasiswa';

$nama_peran = [
    'mahasiswa' => 'Mahasiswa',
    'dosen' => 'Dosen & Staf',
    'admin_kampus' => 'Admin Kampus',
    'vendor' => 'Vendor',
    'admin_sistem' => 'Admin Sistem'
];

if (!array_key_exists($peran, $nama_peran)) {
    $peran = 'mahasiswa';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login <?= htmlspecialchars($nama_peran[$peran]) ?> - UIN Kampus Care</title>

    <link rel="stylesheet" href="css/style.css">

    <style>
        /* ==============================
           LOGIN PAGE
        ============================== */

        .login-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;

            background:
                linear-gradient(135deg,
                    #eff6ff 0%,
                    #f8fafc 50%,
                    #eef4ff 100%);
        }

        .login-wrapper {
            width: 100%;
            max-width: 950px;

            display: grid;
            grid-template-columns: 1fr 1fr;

            background: white;

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 25px 60px rgba(15, 23, 42, 0.12);

            border: 1px solid #e2e8f0;
        }

        /* ==============================
           LEFT SIDE
        ============================== */

        .login-info {
            background: linear-gradient(145deg,
                    #1e3a8a,
                    #2563eb);

            color: white;

            padding: 50px 40px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-logo {
            width: 65px;
            height: 65px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(255, 255, 255, 0.15);

            border: 1px solid rgba(255, 255, 255, 0.25);

            border-radius: 17px;

            font-size: 32px;

            margin-bottom: 25px;
        }

        .login-info h1 {
            font-size: 31px;

            margin-bottom: 12px;
        }

        .login-info h1 span {
            color: #bfdbfe;
        }

        .login-info>p {
            color: #dbeafe;

            font-size: 14px;

            line-height: 1.7;

            margin-bottom: 30px;
        }

        .role-info {
            display: flex;

            align-items: center;

            gap: 13px;

            padding: 15px;

            border-radius: 12px;

            background: rgba(255, 255, 255, 0.12);

            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .role-info-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: white;

            border-radius: 10px;

            font-size: 21px;
        }

        .role-info small {
            display: block;

            color: #bfdbfe;

            font-size: 11px;

            margin-bottom: 2px;
        }

        .role-info strong {
            font-size: 15px;
        }

        /* ==============================
           RIGHT SIDE
        ============================== */

        .login-form-area {
            padding: 50px 45px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-heading {
            margin-bottom: 28px;
        }

        .login-heading h2 {
            color: #0f172a;

            font-size: 27px;

            margin-bottom: 7px;
        }

        .login-heading p {
            color: #64748b;

            font-size: 14px;
        }

        /* ==============================
           ALERT
        ============================== */

        .login-error {
            padding: 12px 14px;

            background: #fef2f2;

            border: 1px solid #fecaca;

            color: #b91c1c;

            border-radius: 9px;

            font-size: 13px;

            margin-bottom: 20px;
        }

        /* ==============================
           FORM
        ============================== */

        .login-form .form-group {
            margin-bottom: 18px;
        }

        .login-form label {
            display: block;

            color: #334155;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 13px;
            top: 50%;

            transform: translateY(-50%);

            font-size: 16px;
        }

        .login-form input {
            width: 100%;

            padding: 12px 14px 12px 42px;

            border: 1px solid #cbd5e1;

            border-radius: 9px;

            font-size: 14px;

            outline: none;

            transition: 0.2s;
        }

        .login-form input:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .login-button {
            width: 100%;

            border: none;

            padding: 13px;

            margin-top: 5px;

            border-radius: 9px;

            background: linear-gradient(135deg,
                    #2563eb,
                    #1d4ed8);

            color: white;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .login-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.25);
        }

        /* ==============================
           LINKS
        ============================== */

        .register-text {
            text-align: center;

            margin-top: 22px;

            color: #64748b;

            font-size: 13px;
        }

        .register-text a {
            color: #2563eb;

            font-weight: bold;
        }

        .back-link {
            text-align: center;

            margin-top: 15px;
        }

        .back-link a {
            color: #64748b;

            font-size: 13px;
        }

        .back-link a:hover {
            color: #2563eb;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 750px) {

            .login-wrapper {
                grid-template-columns: 1fr;

                max-width: 480px;
            }

            .login-info {
                padding: 35px 30px;
            }

            .login-info h1 {
                font-size: 26px;
            }

            .login-form-area {
                padding: 35px 30px;
            }
        }

        @media (max-width: 450px) {

            .login-page {
                padding: 15px;
            }

            .login-info {
                padding: 30px 25px;
            }

            .login-form-area {
                padding: 30px 25px;
            }
        }
    </style>
</head>


<body>

    <div class="login-page">

        <div class="login-wrapper">

            <!-- ==========================
             BAGIAN KIRI
        =========================== -->

            <div class="login-info">

                <div class="login-logo">
                    🏫
                </div>

                <h1>
                    UIN <span>Kampus Care</span>
                </h1>

                <p>
                    Selamat datang kembali.
                    Silakan masuk menggunakan akun Anda
                    untuk mengakses layanan UIN Kampus Care.
                </p>

                <div class="role-info">

                    <div class="role-info-icon">
                        <?php
                        $icon = [
                            'mahasiswa' => '🎓',
                            'dosen' => '👨‍🏫',
                            'admin_kampus' => '🏢',
                            'vendor' => '🔧',
                            'admin_sistem' => '⚙️'
                        ];

                        echo $icon[$peran];
                        ?>
                    </div>

                    <div>
                        <small>
                            Anda login sebagai
                        </small>

                        <strong>
                            <?= htmlspecialchars($nama_peran[$peran]) ?>
                        </strong>
                    </div>

                </div>

            </div>


            <!-- ==========================
             BAGIAN KANAN
        =========================== -->

            <div class="login-form-area">

                <div class="login-heading">

                    <h2>
                        Selamat Datang 👋
                    </h2>

                    <p>
                        Masukkan email dan password Anda
                    </p>

                </div>


                <?php if (isset($_GET['error'])): ?>

                    <div class="login-error">
                        ⚠️
                        <?= htmlspecialchars($_GET['error']) ?>
                    </div>

                <?php endif; ?>


                <form
                    action="proses_login.php"
                    method="POST"
                    class="login-form">

                    <input
                        type="hidden"
                        name="peran"
                        value="<?= htmlspecialchars($peran) ?>">


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉️
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Masukkan email Anda"
                                required>

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="kata_sandi">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>

                            <input
                                type="password"
                                id="kata_sandi"
                                name="kata_sandi"
                                placeholder="Masukkan password Anda"
                                required>

                        </div>

                    </div>


                    <!-- BUTTON -->

                    <button
                        type="submit"
                        class="login-button">
                        Masuk ke Sistem →
                    </button>

                </form>


                <!-- REGISTER -->

                <div class="register-text">

                    Belum punya akun?

                    <a href="register.php">
                        Daftar sekarang
                    </a>

                </div>


                <!-- BACK -->

                <div class="back-link">

                    <a href="index.php">
                        ← Kembali pilih role
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>