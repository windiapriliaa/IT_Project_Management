<?php

session_start();

include "../koneksi.php";

if (
    !isset($_SESSION['id_pengguna']) ||
    $_SESSION['peran'] != 'mahasiswa'
) {
    header("Location: ../login.php?peran=mahasiswa");
    exit;
}

$id_pengguna = $_SESSION['id_pengguna'];

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM laporan
     WHERE id_pengguna = $id_pengguna
     ORDER BY dibuat_pada DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Status Laporan - UIN Kampus Care</title>

    <link rel="stylesheet"
        href="../css/style.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f5f7fb;

            color: #1e293b;
        }


        /* =================================
           NAVBAR
        ================================= */

        .topbar {
            height: 70px;

            background: white;

            border-bottom:
                1px solid #e2e8f0;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 7%;

            position: sticky;

            top: 0;

            z-index: 10;
        }


        .brand {
            display: flex;

            align-items: center;

            gap: 12px;
        }


        .brand-icon {
            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #1d4ed8);

            color: white;

            border-radius: 11px;

            font-size: 20px;
        }


        .brand-text h2 {
            margin: 0;

            font-size: 17px;

            color: #0f172a;
        }


        .brand-text span {
            font-size: 11px;

            color: #64748b;
        }


        .user-area {
            display: flex;

            align-items: center;

            gap: 15px;
        }


        .user-name {
            text-align: right;
        }


        .user-name strong {
            display: block;

            font-size: 13px;

            color: #0f172a;
        }


        .user-name span {
            font-size: 11px;

            color: #64748b;
        }


        .logout-btn {
            text-decoration: none;

            padding: 9px 15px;

            border-radius: 8px;

            background: #fee2e2;

            color: #dc2626;

            font-size: 12px;

            font-weight: bold;
        }


        .logout-btn:hover {
            background: #fecaca;
        }


        /* =================================
           CONTENT
        ================================= */

        .page-content {
            width: 90%;

            max-width: 1150px;

            margin: auto;

            padding: 40px 0 60px;
        }


        /* =================================
           PAGE HEADER
        ================================= */

        .back-link {
            display: inline-block;

            margin-bottom: 15px;

            color: #64748b;

            text-decoration: none;

            font-size: 13px;

            font-weight: 500;
        }


        .back-link:hover {
            color: #2563eb;
        }


        .page-header {
            margin-bottom: 25px;
        }


        .page-header h1 {
            margin: 0 0 8px;

            font-size: 28px;

            color: #0f172a;
        }


        .page-header p {
            margin: 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =================================
           SUCCESS ALERT
        ================================= */

        .success-alert {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 13px 16px;

            margin-bottom: 22px;

            background: #ecfdf5;

            border:
                1px solid #a7f3d0;

            color: #047857;

            border-radius: 10px;

            font-size: 12px;

            font-weight: 500;
        }


        /* =================================
           SUMMARY
        ================================= */

        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;

            margin-bottom: 25px;
        }


        .summary-card {
            background: white;

            border:
                1px solid #e2e8f0;

            border-radius: 15px;

            padding: 20px;

            display: flex;

            align-items: center;

            gap: 14px;

            box-shadow:
                0 4px 15px rgba(15, 23, 42, 0.04);
        }


        .summary-icon {
            width: 45px;
            height: 45px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            font-size: 20px;
        }


        .summary-blue {
            background: #dbeafe;
        }


        .summary-orange {
            background: #ffedd5;
        }


        .summary-green {
            background: #dcfce7;
        }


        .summary-info span {
            display: block;

            color: #64748b;

            font-size: 11px;

            margin-bottom: 3px;
        }


        .summary-info strong {
            font-size: 22px;

            color: #0f172a;
        }


        /* =================================
           TABLE CARD
        ================================= */

        .table-card {
            background: white;

            border:
                1px solid #e2e8f0;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, 0.05);
        }


        .table-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 22px 25px;

            border-bottom:
                1px solid #e2e8f0;
        }


        .table-header h2 {
            margin: 0;

            font-size: 17px;

            color: #0f172a;
        }


        .table-header span {
            font-size: 11px;

            color: #94a3b8;
        }


        .table-wrapper {
            width: 100%;

            overflow-x: auto;
        }


        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 750px;
        }


        th {
            padding: 14px 18px;

            background: #f8fafc;

            color: #475569;

            font-size: 11px;

            font-weight: 700;

            text-align: left;

            border-bottom:
                1px solid #e2e8f0;

            white-space: nowrap;
        }


        td {
            padding: 16px 18px;

            font-size: 12px;

            color: #475569;

            border-bottom:
                1px solid #f1f5f9;

            vertical-align: middle;
        }


        tbody tr {
            transition: 0.15s;
        }


        tbody tr:hover {
            background: #f8fafc;
        }


        tbody tr:last-child td {
            border-bottom: none;
        }


        .number {
            width: 50px;

            color: #94a3b8;

            font-weight: bold;
        }


        .title-cell {
            color: #0f172a;

            font-weight: 600;

            max-width: 250px;
        }


        .location-cell {
            max-width: 230px;

            line-height: 1.5;
        }


        .date-cell {
            white-space: nowrap;

            color: #64748b;

            font-size: 11px;
        }


        /* =================================
           STATUS BADGE
        ================================= */

        .status-badge {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 10px;

            font-weight: 700;

            white-space: nowrap;

            text-transform: capitalize;
        }


        .status-badge::before {
            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: currentColor;
        }


        .status-baru {
            background: #dbeafe;

            color: #2563eb;
        }


        .status-diproses {
            background: #ffedd5;

            color: #ea580c;
        }


        .status-selesai {
            background: #dcfce7;

            color: #16a34a;
        }


        .status-ditolak {
            background: #fee2e2;

            color: #dc2626;
        }


        /* =================================
           EMPTY STATE
        ================================= */

        .empty-state {
            padding: 60px 25px;

            text-align: center;
        }


        .empty-icon {
            width: 65px;
            height: 65px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: #eff6ff;

            font-size: 28px;
        }


        .empty-state h3 {
            margin: 0 0 7px;

            font-size: 16px;

            color: #334155;
        }


        .empty-state p {
            margin: 0 auto 20px;

            max-width: 400px;

            color: #94a3b8;

            font-size: 12px;

            line-height: 1.6;
        }


        .create-button {
            display: inline-block;

            padding: 10px 16px;

            border-radius: 8px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            font-size: 12px;

            font-weight: bold;
        }


        .create-button:hover {
            background: #1d4ed8;
        }


        /* =================================
           FOOTER
        ================================= */

        .footer {
            text-align: center;

            padding: 25px;

            color: #94a3b8;

            font-size: 11px;
        }


        /* =================================
           RESPONSIVE
        ================================= */

        @media (max-width: 750px) {

            .topbar {
                height: auto;

                padding: 15px 20px;

                gap: 12px;
            }


            .user-name {
                display: none;
            }


            .page-content {
                width: 92%;

                padding-top: 25px;
            }


            .summary-grid {
                grid-template-columns: 1fr;
            }


            .page-header h1 {
                font-size: 23px;
            }


            .table-header {
                padding: 18px;
            }

        }
    </style>

</head>


<body>


    <!-- =================================
     NAVBAR
================================= -->

    <header class="topbar">

        <div class="brand">

            <div class="brand-icon">
                🏫
            </div>

            <div class="brand-text">

                <h2>
                    UIN Kampus Care
                </h2>

                <span>
                    Portal Mahasiswa
                </span>

            </div>

        </div>


        <div class="user-area">

            <div class="user-name">

                <strong>
                    <?= htmlspecialchars(
                        $_SESSION['nama_lengkap']
                    ) ?>
                </strong>

                <span>
                    Mahasiswa
                </span>

            </div>


            <a
                href="../logout.php"
                class="logout-btn">
                Keluar
            </a>

        </div>

    </header>



    <!-- =================================
     CONTENT
================================= -->

    <main class="page-content">


        <!-- HEADER -->

        <div class="page-header">

            <a
                href="dashboard.php"
                class="back-link">
                ← Kembali ke Dashboard
            </a>


            <h1>
                Status Laporan 📋
            </h1>


            <p>
                Pantau perkembangan laporan yang telah
                kamu kirim kepada pihak kampus.
            </p>

        </div>



        <!-- SUCCESS -->

        <?php if (isset($_GET['success'])): ?>

            <div class="success-alert">

                <span>
                    ✅
                </span>

                <span>
                    Laporan berhasil dikirim!
                    Pihak kampus akan menindaklanjuti
                    laporan kamu.
                </span>

            </div>

        <?php endif; ?>



        <?php

        /*
    |--------------------------------------------------------------------------
    | Hitung statistik laporan
    |--------------------------------------------------------------------------
    */

        $total_laporan = 0;
        $diproses = 0;
        $selesai = 0;

        /*
    | Query tambahan untuk statistik
    */

        $stat_query = mysqli_query(
            $koneksi,
            "SELECT status, COUNT(*) AS jumlah
         FROM laporan
         WHERE id_pengguna = $id_pengguna
         GROUP BY status"
        );


        if ($stat_query) {

            while ($stat = mysqli_fetch_assoc($stat_query)) {

                $total_laporan += $stat['jumlah'];

                if ($stat['status'] == 'diproses') {
                    $diproses = $stat['jumlah'];
                }

                if ($stat['status'] == 'selesai') {
                    $selesai = $stat['jumlah'];
                }
            }
        }

        ?>


        <!-- SUMMARY -->

        <div class="summary-grid">


            <div class="summary-card">

                <div class="summary-icon summary-blue">
                    📋
                </div>

                <div class="summary-info">

                    <span>
                        Total Laporan
                    </span>

                    <strong>
                        <?= $total_laporan ?>
                    </strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon summary-orange">
                    ⏳
                </div>

                <div class="summary-info">

                    <span>
                        Sedang Diproses
                    </span>

                    <strong>
                        <?= $diproses ?>
                    </strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon summary-green">
                    ✅
                </div>

                <div class="summary-info">

                    <span>
                        Selesai
                    </span>

                    <strong>
                        <?= $selesai ?>
                    </strong>

                </div>

            </div>


        </div>



        <!-- =================================
         TABLE
    ================================== -->

        <div class="table-card">


            <div class="table-header">

                <h2>
                    Riwayat Laporan
                </h2>

                <span>
                    Laporan terbaru ditampilkan di atas
                </span>

            </div>



            <?php if (mysqli_num_rows($query) > 0): ?>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    Judul Laporan
                                </th>

                                <th>
                                    Lokasi
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Tanggal
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php

                            $no = 1;

                            while (
                                $data =
                                mysqli_fetch_assoc($query)
                            ):

                                $status =
                                    strtolower(
                                        $data['status']
                                    );

                            ?>

                                <tr>


                                    <td class="number">

                                        <?= $no++ ?>

                                    </td>


                                    <td class="title-cell">

                                        <?= htmlspecialchars(
                                            $data['judul_laporan']
                                        ) ?>

                                    </td>


                                    <td class="location-cell">

                                        📍
                                        <?= htmlspecialchars(
                                            $data['lokasi_ruang']
                                        ) ?>

                                    </td>


                                    <td>

                                        <span
                                            class="
                                            status-badge
                                            status-<?= htmlspecialchars(
                                                        $status
                                                    ) ?>
                                        ">

                                            <?= htmlspecialchars(
                                                $data['status']
                                            ) ?>

                                        </span>

                                    </td>


                                    <td class="date-cell">

                                        <?= date(
                                            'd/m/Y H:i',
                                            strtotime(
                                                $data['dibuat_pada']
                                            )
                                        ) ?>

                                    </td>


                                </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>


            <?php else: ?>


                <!-- EMPTY -->

                <div class="empty-state">

                    <div class="empty-icon">
                        📋
                    </div>

                    <h3>
                        Belum Ada Laporan
                    </h3>

                    <p>
                        Kamu belum mengirim laporan apa pun.
                        Jika menemukan kerusakan atau masalah
                        fasilitas kampus, kamu bisa membuat
                        laporan baru.
                    </p>

                    <a
                        href="buat_laporan.php"
                        class="create-button">
                        + Buat Laporan
                    </a>

                </div>


            <?php endif; ?>


        </div>


    </main>



    <footer class="footer">

        © 2026 UIN Kampus Care
        • Sistem Pelayanan Kampus

    </footer>


</body>

</html>