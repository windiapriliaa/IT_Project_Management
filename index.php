<?php

session_start();

include "../koneksi.php";

if (!isset($_SESSION['id_pengguna'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_SESSION['id_pengguna'];

$query = mysqli_query(
    $koneksi,
    "SELECT
        pesan.*,
        pengirim.nama_lengkap AS nama_pengirim,
        penerima.nama_lengkap AS nama_penerima
     FROM pesan

     JOIN pengguna AS pengirim
     ON pesan.id_pengirim = pengirim.id_pengguna

     JOIN pengguna AS penerima
     ON pesan.id_penerima = penerima.id_pengguna

     WHERE pesan.id_pengirim = $id
     OR pesan.id_penerima = $id

     ORDER BY pesan.waktu_kirim DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Pesan - UIN Kampus Care
    </title>

    <!-- PENTING: style.css, bukan ztyle.css -->
    <link
        rel="stylesheet"
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


        /* ================================
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

            gap: 12px;
        }


        .user-info {

            text-align: right;
        }


        .user-info strong {

            display: block;

            font-size: 13px;

            color: #0f172a;
        }


        .user-info span {

            font-size: 11px;

            color: #64748b;
        }


        .back-btn {

            text-decoration: none;

            padding: 9px 14px;

            border-radius: 8px;

            background: #eff6ff;

            color: #2563eb;

            font-size: 12px;

            font-weight: bold;
        }


        .back-btn:hover {

            background: #dbeafe;
        }


        .logout-btn {

            text-decoration: none;

            padding: 9px 14px;

            border-radius: 8px;

            background: #fee2e2;

            color: #dc2626;

            font-size: 12px;

            font-weight: bold;
        }


        .logout-btn:hover {

            background: #fecaca;
        }


        /* ================================
           CONTENT
        ================================= */

        .page-content {

            width: 90%;

            max-width: 1100px;

            margin: auto;

            padding: 40px 0 60px;
        }


        /* ================================
           HEADER
        ================================= */

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

            font-size: 13px;

            color: #64748b;

            line-height: 1.6;
        }


        /* ================================
           MESSAGE CARD
        ================================= */

        .message-card {

            background: white;

            border:
                1px solid #e2e8f0;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, 0.05);
        }


        .message-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 20px 25px;

            border-bottom:
                1px solid #e2e8f0;
        }


        .message-header h2 {

            margin: 0;

            font-size: 17px;

            color: #0f172a;
        }


        .message-header span {

            font-size: 11px;

            color: #94a3b8;
        }


        /* ================================
           TABLE
        ================================= */

        .table-wrapper {

            overflow-x: auto;
        }


        table {

            width: 100%;

            min-width: 750px;

            border-collapse: collapse;
        }


        th {

            padding: 14px 18px;

            background: #f8fafc;

            color: #475569;

            font-size: 11px;

            text-align: left;

            border-bottom:
                1px solid #e2e8f0;
        }


        td {

            padding: 17px 18px;

            font-size: 12px;

            color: #475569;

            border-bottom:
                1px solid #f1f5f9;

            vertical-align: top;
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


        /* ================================
           PERSON
        ================================= */

        .person {

            display: flex;

            align-items: center;

            gap: 10px;

            min-width: 150px;
        }


        .avatar {

            width: 34px;

            height: 34px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #dbeafe;

            color: #2563eb;

            font-size: 14px;

            font-weight: bold;
        }


        .person-name {

            color: #0f172a;

            font-weight: 600;

            font-size: 12px;
        }


        .person-label {

            display: block;

            color: #94a3b8;

            font-size: 9px;

            margin-top: 2px;
        }


        /* ================================
           MESSAGE
        ================================= */

        .message-content {

            max-width: 400px;

            line-height: 1.6;

            color: #475569;

            background: #f8fafc;

            padding: 10px 13px;

            border-radius: 10px;

            border:
                1px solid #f1f5f9;
        }


        /* ================================
           TIME
        ================================= */

        .time {

            color: #64748b;

            font-size: 11px;

            white-space: nowrap;
        }


        /* ================================
           EMPTY STATE
        ================================= */

        .empty-state {

            padding: 70px 25px;

            text-align: center;
        }


        .empty-icon {

            width: 70px;

            height: 70px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin: 0 auto 15px;

            background: #eff6ff;

            border-radius: 50%;

            font-size: 30px;
        }


        .empty-state h3 {

            margin: 0 0 7px;

            color: #334155;

            font-size: 16px;
        }


        .empty-state p {

            max-width: 420px;

            margin: auto;

            color: #94a3b8;

            font-size: 12px;

            line-height: 1.6;
        }


        /* ================================
           FOOTER
        ================================= */

        .footer {

            text-align: center;

            padding: 25px;

            color: #94a3b8;

            font-size: 11px;
        }


        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 750px) {

            .topbar {

                height: auto;

                padding: 15px 20px;

                gap: 12px;

                flex-wrap: wrap;
            }


            .user-info {

                display: none;
            }


            .page-content {

                width: 92%;

                padding-top: 25px;
            }


            .page-header h1 {

                font-size: 23px;
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
                💬
            </div>


            <div class="brand-text">

                <h2>
                    UIN Kampus Care
                </h2>

                <span>
                    Pusat Pesan
                </span>

            </div>

        </div>


        <div class="user-area">


            <div class="user-info">

                <strong>
                    <?= htmlspecialchars(
                        $_SESSION['nama_lengkap']
                    ) ?>
                </strong>

                <span>
                    <?= htmlspecialchars(
                        ucfirst(
                            str_replace(
                                '_',
                                ' ',
                                $_SESSION['peran']
                            )
                        )
                    ) ?>
                </span>

            </div>


            <a
                href="../index.php"
                class="back-btn">
                🏠 Beranda
            </a>


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


        <div class="page-header">

            <h1>
                💬 Pesan
            </h1>

            <p>
                Lihat komunikasi antara kamu dengan
                pengguna lain di UIN Kampus Care.
            </p>

        </div>



        <!-- MESSAGE CARD -->

        <div class="message-card">


            <div class="message-header">

                <h2>
                    Riwayat Pesan
                </h2>

                <span>
                    Pesan terbaru ditampilkan di atas
                </span>

            </div>



            <?php if (
                $query &&
                mysqli_num_rows($query) > 0
            ): ?>


                <div class="table-wrapper">

                    <table>


                        <thead>

                            <tr>

                                <th>
                                    Pengirim
                                </th>

                                <th>
                                    Penerima
                                </th>

                                <th>
                                    Isi Pesan
                                </th>

                                <th>
                                    Waktu
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <?php

                            while (
                                $data =
                                mysqli_fetch_assoc($query)
                            ):

                                $nama_pengirim =
                                    $data['nama_pengirim'];

                                $inisial =
                                    strtoupper(
                                        substr(
                                            $nama_pengirim,
                                            0,
                                            1
                                        )
                                    );

                            ?>


                                <tr>


                                    <!-- PENGIRIM -->

                                    <td>

                                        <div class="person">

                                            <div class="avatar">

                                                <?= htmlspecialchars(
                                                    $inisial
                                                ) ?>

                                            </div>


                                            <div>

                                                <div
                                                    class="person-name">

                                                    <?= htmlspecialchars(
                                                        $nama_pengirim
                                                    ) ?>

                                                </div>

                                                <span
                                                    class="person-label">
                                                    Pengirim
                                                </span>

                                            </div>

                                        </div>

                                    </td>



                                    <!-- PENERIMA -->

                                    <td>

                                        <div class="person">

                                            <div class="avatar">

                                                <?= htmlspecialchars(
                                                    strtoupper(
                                                        substr(
                                                            $data['nama_penerima'],
                                                            0,
                                                            1
                                                        )
                                                    )
                                                ) ?>

                                            </div>


                                            <div>

                                                <div
                                                    class="person-name">

                                                    <?= htmlspecialchars(
                                                        $data['nama_penerima']
                                                    ) ?>

                                                </div>

                                                <span
                                                    class="person-label">
                                                    Penerima
                                                </span>

                                            </div>

                                        </div>

                                    </td>



                                    <!-- PESAN -->

                                    <td>

                                        <div
                                            class="message-content">

                                            <?= nl2br(
                                                htmlspecialchars(
                                                    $data['isi_pesan']
                                                )
                                            ) ?>

                                        </div>

                                    </td>



                                    <!-- WAKTU -->

                                    <td>

                                        <span
                                            class="time">

                                            🕒
                                            <?= date(
                                                'd/m/Y H:i',
                                                strtotime(
                                                    $data['waktu_kirim']
                                                )
                                            ) ?>

                                        </span>

                                    </td>


                                </tr>


                            <?php endwhile; ?>


                        </tbody>

                    </table>

                </div>


            <?php else: ?>


                <!-- EMPTY STATE -->

                <div class="empty-state">

                    <div class="empty-icon">
                        💬
                    </div>


                    <h3>
                        Belum Ada Pesan
                    </h3>


                    <p>
                        Belum ada percakapan yang tersedia.
                        Pesan yang kamu kirim atau terima
                        akan muncul di halaman ini.
                    </p>

                </div>


            <?php endif; ?>


        </div>


    </main>



    <footer class="footer">

        © 2026 UIN Kampus Care
        • Pusat Pesan

    </footer>


</body>

</html>