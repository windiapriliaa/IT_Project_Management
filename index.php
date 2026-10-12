<?php
session_start();

if (isset($_SESSION['peran'])) {
    switch ($_SESSION['peran']) {
        case 'mahasiswa':
            header("Location: mahasiswa/dashboard.php");
            exit;

        case 'dosen':
            header("Location: dosen/dashboard.php");
            exit;

        case 'admin_kampus':
            header("Location: admin_kampus/dashboard.php");
            exit;

        case 'vendor':
            header("Location: vendor/dashboard.php");
            exit;

        case 'admin_sistem':
            header("Location: admin_sistem/dashboard.php");
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UIN Kampus Care</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #eef4ff, #f8fbff);
            color: #1e293b;
            min-height: 100vh;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            width: 100%;
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 21px;
            font-weight: bold;
            color: #1746a2;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #1746a2;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .nav-text {
            font-size: 14px;
            color: #64748b;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            text-align: center;
            padding: 70px 20px 40px;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1746a2;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 46px;
            line-height: 1.2;
            color: #0f2f6b;
            margin-bottom: 15px;
        }

        .hero h1 span {
            color: #2563eb;
        }

        .hero p {
            max-width: 650px;
            margin: auto;
            font-size: 17px;
            line-height: 1.7;
            color: #64748b;
        }

        /* =========================
           ROLE
        ========================= */

        .content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .section-title h2 {
            font-size: 24px;
            color: #1e293b;
            margin-bottom: 7px;
        }

        .section-title p {
            color: #64748b;
            font-size: 14px;
        }

        .role-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .role-card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            text-decoration: none;
            color: inherit;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.06);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .role-card::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 4px;
            background: #2563eb;
            top: 0;
            left: 0;
        }

        .role-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15);
            border-color: #93c5fd;
        }

        .role-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 18px;
        }

        .role-card h3 {
            font-size: 18px;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .role-card p {
            font-size: 13px;
            line-height: 1.6;
            color: #64748b;
            min-height: 42px;
        }

        .login-link {
            display: inline-block;
            margin-top: 17px;
            color: #2563eb;
            font-size: 13px;
            font-weight: bold;
        }

        /* =========================
           INFO
        ========================= */

        .info-box {
            max-width: 900px;
            margin: 45px auto 0;
            background: white;
            border-radius: 18px;
            padding: 25px 30px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.05);
        }

        .info-icon {
            font-size: 35px;
        }

        .info-box h3 {
            font-size: 17px;
            margin-bottom: 5px;
            color: #1e293b;
        }

        .info-box p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            margin-top: 70px;
            background: #0f2f6b;
            color: white;
            text-align: center;
            padding: 25px;
        }

        footer strong {
            font-size: 16px;
        }

        footer p {
            margin-top: 7px;
            font-size: 12px;
            color: #cbd5e1;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .role-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero h1 {
                font-size: 38px;
            }
        }

        @media (max-width: 600px) {

            .navbar {
                padding: 0 20px;
            }

            .nav-text {
                display: none;
            }

            .hero {
                padding-top: 50px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 15px;
            }

            .role-container {
                grid-template-columns: 1fr;
            }

            .info-box {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <div class="logo">
            <div class="logo-icon">🏫</div>
            <span>UIN Kampus Care</span>
        </div>

        <div class="nav-text">
            Sistem Pelayanan Kampus
        </div>

    </nav>


    <!-- HERO -->
    <section class="hero">

        <div class="badge">
            ✨ Layanan Digital Kampus
        </div>

        <h1>
            Selamat Datang di<br>
            <span>UIN Kampus Care</span>
        </h1>

        <p>
            Platform untuk menyampaikan laporan, usulan,
            dan kebutuhan pelayanan kampus secara mudah,
            cepat, dan terorganisir.
        </p>

    </section>


    <!-- ROLE -->
    <main class="content">

        <div class="section-title">
            <h2>Pilih Peran Anda</h2>
            <p>Silakan pilih peran untuk masuk ke dalam sistem</p>
        </div>


        <div class="role-container">

            <!-- MAHASISWA -->
            <a href="login.php?peran=mahasiswa" class="role-card">

                <div class="role-icon">
                    🎓
                </div>

                <h3>Mahasiswa</h3>

                <p>
                    Laporkan kerusakan fasilitas,
                    masalah lingkungan, atau kebutuhan
                    pelayanan kampus.
                </p>

                <span class="login-link">
                    Masuk sebagai Mahasiswa →
                </span>

            </a>


            <!-- DOSEN -->
            <a href="login.php?peran=dosen" class="role-card">

                <div class="role-icon">
                    👨‍🏫
                </div>

                <h3>Dosen & Staff</h3>

                <p>
                    Sampaikan usulan, laporan fasilitas,
                    dan kebutuhan pelayanan kampus.
                </p>

                <span class="login-link">
                    Masuk sebagai Dosen & Staff →
                </span>

            </a>


            <!-- ADMIN KAMPUS -->
            <a href="login.php?peran=admin_kampus" class="role-card">

                <div class="role-icon">
                    🏢
                </div>

                <h3>Admin Kampus</h3>

                <p>
                    Kelola laporan dan pantau proses
                    penyelesaian masalah di lingkungan kampus.
                </p>

                <span class="login-link">
                    Masuk sebagai Admin →
                </span>

            </a>


            <!-- VENDOR -->
            <a href="login.php?peran=vendor" class="role-card">

                <div class="role-icon">
                    🔧
                </div>

                <h3>Vendor</h3>

                <p>
                    Kelola layanan dan informasi pekerjaan
                    yang berkaitan dengan kebutuhan kampus.
                </p>

                <span class="login-link">
                    Masuk sebagai Vendor →
                </span>

            </a>


            <!-- ADMIN SISTEM -->
            <a href="login.php?peran=admin_sistem" class="role-card">

                <div class="role-icon">
                    ⚙️
                </div>

                <h3>Admin Sistem</h3>

                <p>
                    Kelola pengguna, sistem, dan aktivitas
                    aplikasi UIN Kampus Care.
                </p>

                <span class="login-link">
                    Masuk sebagai Admin Sistem →
                </span>

            </a>

        </div>


        <!-- INFO -->
        <div class="info-box">

            <div class="info-icon">
                💡
            </div>

            <div>
                <h3>Butuh bantuan?</h3>

                <p>
                    Pilih peran sesuai dengan akun Anda.
                    Setelah masuk, Anda dapat menggunakan
                    fitur yang tersedia sesuai hak akses.
                </p>
            </div>

        </div>

    </main>


    <!-- FOOTER -->
    <footer>

        <strong>UIN Kampus Care</strong>

        <p>
            © 2026 UIN Kampus Care • Sistem Pelayanan Digital Kampus
        </p>

    </footer>

</body>

</html>