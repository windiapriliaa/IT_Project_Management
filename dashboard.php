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

$query = mysqli_query(
   $koneksi,
   "SELECT *
     FROM laporan
     WHERE status = 'diproses'
     ORDER BY dibuat_pada DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

   <meta charset="UTF-8">

   <meta name="viewport"
      content="width=device-width, initial-scale=1.0">

   <title>Dashboard Vendor - UIN Kampus Care</title>

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
               #7c3aed,
               #6d28d9);

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


      .profile-btn {
         text-decoration: none;

         padding: 9px 14px;

         border-radius: 8px;

         background: #f3e8ff;

         color: #7c3aed;

         font-size: 12px;

         font-weight: bold;
      }


      .profile-btn:hover {
         background: #ede9fe;
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

         max-width: 1200px;

         margin: auto;

         padding: 40px 0 60px;
      }


      /* ================================
           WELCOME
        ================================= */

      .welcome-box {
         background:
            linear-gradient(135deg,
               #5b21b6,
               #7c3aed);

         border-radius: 20px;

         padding: 35px 40px;

         color: white;

         position: relative;

         overflow: hidden;

         margin-bottom: 30px;

         box-shadow:
            0 15px 35px rgba(124, 58, 237, 0.15);
      }


      .welcome-box::after {
         content: "";

         position: absolute;

         width: 220px;
         height: 220px;

         border-radius: 50%;

         background:
            rgba(255, 255, 255, 0.08);

         right: -50px;

         top: -80px;
      }


      .welcome-box h1 {
         margin: 0 0 8px;

         font-size: 27px;
      }


      .welcome-box p {
         margin: 0;

         color: #ede9fe;

         font-size: 13px;

         line-height: 1.6;
      }


      .welcome-icon {
         position: absolute;

         right: 55px;

         bottom: 15px;

         font-size: 70px;

         opacity: 0.15;
      }


      /* ================================
           SUMMARY
        ================================= */

      .summary-grid {
         display: grid;

         grid-template-columns:
            repeat(3, 1fr);

         gap: 18px;

         margin-bottom: 30px;
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


      .purple-icon {
         background: #f3e8ff;
      }


      .orange-icon {
         background: #ffedd5;
      }


      .blue-icon {
         background: #dbeafe;
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


      /* ================================
           SECTION HEADER
        ================================= */

      .section-header {
         display: flex;

         justify-content: space-between;

         align-items: end;

         margin-bottom: 15px;
      }


      .section-header h2 {
         margin: 0 0 5px;

         font-size: 18px;

         color: #0f172a;
      }


      .section-header p {
         margin: 0;

         color: #64748b;

         font-size: 12px;
      }


      .job-count {
         padding: 7px 11px;

         background: #f3e8ff;

         color: #7c3aed;

         border-radius: 20px;

         font-size: 10px;

         font-weight: bold;
      }


      /* ================================
           TABLE
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


      .table-wrapper {
         overflow-x: auto;
      }


      table {
         width: 100%;

         min-width: 800px;

         border-collapse: collapse;
      }


      th {
         padding: 15px 18px;

         background: #f8fafc;

         color: #475569;

         font-size: 11px;

         text-align: left;

         border-bottom:
            1px solid #e2e8f0;
      }


      td {
         padding: 17px 18px;

         color: #475569;

         font-size: 12px;

         border-bottom:
            1px solid #f1f5f9;

         vertical-align: middle;
      }


      tbody tr {
         transition: 0.15s;
      }


      tbody tr:hover {
         background: #fafafa;
      }


      tbody tr:last-child td {
         border-bottom: none;
      }


      .number {
         width: 50px;

         color: #94a3b8;

         font-weight: bold;
      }


      .job-title {
         color: #0f172a;

         font-weight: 600;

         max-width: 260px;
      }


      .location {
         color: #64748b;

         max-width: 250px;

         line-height: 1.5;
      }


      /* ================================
           STATUS
        ================================= */

      .status-badge {
         display: inline-flex;

         align-items: center;

         gap: 6px;

         padding: 6px 10px;

         background: #ffedd5;

         color: #ea580c;

         border-radius: 20px;

         font-size: 10px;

         font-weight: bold;

         white-space: nowrap;
      }


      .status-badge::before {
         content: "";

         width: 6px;
         height: 6px;

         border-radius: 50%;

         background: currentColor;
      }


      /* ================================
           ACTION BUTTON
        ================================= */

      .offer-btn {
         display: inline-block;

         padding: 9px 13px;

         background:
            linear-gradient(135deg,
               #7c3aed,
               #6d28d9);

         color: white;

         text-decoration: none;

         border-radius: 8px;

         font-size: 11px;

         font-weight: bold;

         transition: 0.2s;

         white-space: nowrap;
      }


      .offer-btn:hover {
         transform: translateY(-2px);

         box-shadow:
            0 6px 15px rgba(124, 58, 237, 0.25);
      }


      /* ================================
           EMPTY STATE
        ================================= */

      .empty-state {
         padding: 65px 25px;

         text-align: center;
      }


      .empty-icon {
         width: 70px;
         height: 70px;

         display: flex;

         align-items: center;
         justify-content: center;

         margin: 0 auto 15px;

         background: #f3e8ff;

         border-radius: 50%;

         font-size: 30px;
      }


      .empty-state h3 {
         margin: 0 0 7px;

         color: #334155;

         font-size: 16px;
      }


      .empty-state p {
         max-width: 430px;

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

      @media (max-width: 850px) {

         .topbar {
            height: auto;

            padding: 15px 20px;

            gap: 12px;

            flex-wrap: wrap;
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


         .welcome-box {
            padding: 28px 25px;
         }


         .welcome-icon {
            display: none;
         }

      }


      @media (max-width: 550px) {

         .user-area {
            width: 100%;

            justify-content: flex-end;
         }


         .section-header {
            align-items: flex-start;

            gap: 10px;

            flex-direction: column;
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
            🔧
         </div>

         <div class="brand-text">

            <h2>
               UIN Kampus Care
            </h2>

            <span>
               Portal Vendor
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
               Vendor
            </span>

         </div>


         <a
            href="profil.php"
            class="profile-btn">
            Profil Usaha
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


      <!-- WELCOME -->

      <section class="welcome-box">


         <h1>
            Selamat Datang,
            <?= htmlspecialchars(
               $_SESSION['nama_lengkap']
            ) ?>! 👋
         </h1>


         <p>
            Temukan pekerjaan yang tersedia di kampus
            dan ajukan penawaran untuk layanan yang
            sesuai dengan bidang usaha kamu.
         </p>


         <div class="welcome-icon">
            🔧
         </div>


      </section>



      <?php

      /*
    |--------------------------------------------------------------------------
    | Hitung pekerjaan tersedia
    |--------------------------------------------------------------------------
    */

      $jumlah_pekerjaan = 0;

      if ($query) {

         $jumlah_pekerjaan =
            mysqli_num_rows($query);
      }

      ?>


      <!-- SUMMARY -->

      <div class="summary-grid">


         <div class="summary-card">

            <div class="summary-icon purple-icon">
               🔧
            </div>

            <div class="summary-info">

               <span>
                  Pekerjaan Tersedia
               </span>

               <strong>
                  <?= $jumlah_pekerjaan ?>
               </strong>

            </div>

         </div>


         <div class="summary-card">

            <div class="summary-icon orange-icon">
               ⏳
            </div>

            <div class="summary-info">

               <span>
                  Status Pekerjaan
               </span>

               <strong>
                  Aktif
               </strong>

            </div>

         </div>


         <div class="summary-card">

            <div class="summary-icon blue-icon">
               💼
            </div>

            <div class="summary-info">

               <span>
                  Peran
               </span>

               <strong>
                  Vendor
               </strong>

            </div>

         </div>


      </div>



      <!-- SECTION -->

      <div class="section-header">

         <div>

            <h2>
               🔧 Pekerjaan Tersedia
            </h2>

            <p>
               Daftar laporan yang sedang diproses
               dan membutuhkan tindak lanjut.
            </p>

         </div>


         <span class="job-count">

            <?= $jumlah_pekerjaan ?>
            pekerjaan

         </span>

      </div>



      <!-- TABLE CARD -->

      <div class="table-card">


         <?php if (
            $query &&
            mysqli_num_rows($query) > 0
         ): ?>


            <div class="table-wrapper">

               <table>

                  <thead>

                     <tr>

                        <th>
                           No
                        </th>

                        <th>
                           Pekerjaan
                        </th>

                        <th>
                           Lokasi
                        </th>

                        <th>
                           Status
                        </th>

                        <th>
                           Aksi
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

                     ?>

                        <tr>


                           <td class="number">

                              <?= $no++ ?>

                           </td>


                           <td class="job-title">

                              <?= htmlspecialchars(
                                 $data['judul_laporan']
                              ) ?>

                           </td>


                           <td class="location">

                              📍
                              <?= htmlspecialchars(
                                 $data['lokasi_ruang']
                              ) ?>

                           </td>


                           <td>

                              <span
                                 class="status-badge">

                                 <?= htmlspecialchars(
                                    $data['status']
                                 ) ?>

                              </span>

                           </td>


                           <td>

                              <a
                                 href="penawaran.php?id=<?= $data['id_laporan'] ?>"
                                 class="offer-btn">
                                 Ajukan Penawaran →
                              </a>

                           </td>


                        </tr>

                     <?php endwhile; ?>

                  </tbody>

               </table>

            </div>


         <?php else: ?>


            <div class="empty-state">

               <div class="empty-icon">
                  🔧
               </div>


               <h3>
                  Belum Ada Pekerjaan
               </h3>


               <p>
                  Saat ini belum ada laporan yang
                  tersedia untuk ditindaklanjuti.
                  Silakan cek kembali nanti.
               </p>

            </div>


         <?php endif; ?>


      </div>


   </main>



   <footer class="footer">

      © 2026 UIN Kampus Care
      • Portal Vendor

   </footer>


</body>

</html>