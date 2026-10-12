<?php

session_start();

if (
  !isset($_SESSION['id_pengguna']) ||
  $_SESSION['peran'] != 'mahasiswa'
) {
  header("Location: ../login.php?peran=mahasiswa");
  exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="UTF-8">

  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

  <title>Buat Laporan - UIN Kampus Care</title>

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


    /* =================================
           CONTENT
        ================================= */

    .page-content {
      width: 90%;

      max-width: 850px;

      margin: auto;

      padding: 40px 0 60px;
    }


    /* =================================
           HEADER
        ================================= */

    .page-header {
      margin-bottom: 25px;
    }


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


    .page-header h1 {
      margin: 0 0 8px;

      font-size: 27px;

      color: #0f172a;
    }


    .page-header p {
      margin: 0;

      font-size: 13px;

      color: #64748b;

      line-height: 1.6;
    }


    /* =================================
           FORM CARD
        ================================= */

    .form-card {
      background: white;

      border:
        1px solid #e2e8f0;

      border-radius: 18px;

      padding: 32px;

      box-shadow:
        0 8px 25px rgba(15, 23, 42, 0.05);
    }


    .form-title {
      display: flex;

      align-items: center;

      gap: 12px;

      margin-bottom: 25px;

      padding-bottom: 20px;

      border-bottom:
        1px solid #e2e8f0;
    }


    .form-title-icon {
      width: 45px;
      height: 45px;

      display: flex;

      align-items: center;
      justify-content: center;

      background: #dbeafe;

      border-radius: 11px;

      font-size: 21px;
    }


    .form-title h2 {
      margin: 0;

      font-size: 17px;

      color: #0f172a;
    }


    .form-title p {
      margin: 3px 0 0;

      color: #64748b;

      font-size: 11px;
    }


    /* =================================
           FORM
        ================================= */

    .form-group {
      margin-bottom: 20px;
    }


    .form-group label {
      display: block;

      margin-bottom: 7px;

      color: #334155;

      font-size: 13px;

      font-weight: 600;
    }


    .required {
      color: #dc2626;
    }


    .form-control {
      width: 100%;

      padding: 12px 14px;

      border:
        1px solid #cbd5e1;

      border-radius: 9px;

      background: white;

      color: #0f172a;

      font-size: 13px;

      outline: none;

      transition: 0.2s;
    }


    .form-control:focus {
      border-color: #2563eb;

      box-shadow:
        0 0 0 3px rgba(37, 99, 235, 0.1);
    }


    .form-control::placeholder {
      color: #94a3b8;
    }


    textarea.form-control {
      resize: vertical;

      min-height: 130px;

      line-height: 1.6;
    }


    .form-help {
      display: block;

      margin-top: 6px;

      font-size: 11px;

      color: #94a3b8;
    }


    /* =================================
           FILE UPLOAD
        ================================= */

    .upload-box {
      border:
        1px dashed #94a3b8;

      background: #f8fafc;

      border-radius: 12px;

      padding: 22px;

      text-align: center;

      transition: 0.2s;
    }


    .upload-box:hover {
      border-color: #2563eb;

      background: #eff6ff;
    }


    .upload-icon {
      font-size: 28px;

      margin-bottom: 8px;
    }


    .upload-box strong {
      display: block;

      color: #334155;

      font-size: 13px;

      margin-bottom: 4px;
    }


    .upload-box span {
      display: block;

      color: #94a3b8;

      font-size: 11px;

      margin-bottom: 12px;
    }


    .file-input {
      font-size: 12px;

      color: #64748b;
    }


    /* =================================
           INFO BOX
        ================================= */

    .info-box {
      display: flex;

      gap: 10px;

      padding: 13px 15px;

      margin-bottom: 25px;

      background: #eff6ff;

      border:
        1px solid #bfdbfe;

      border-radius: 10px;

      color: #1e40af;

      font-size: 11px;

      line-height: 1.5;
    }


    .info-box-icon {
      font-size: 16px;

      flex-shrink: 0;
    }


    /* =================================
           BUTTON
        ================================= */

    .form-actions {
      display: flex;

      justify-content: space-between;

      align-items: center;

      gap: 12px;

      margin-top: 28px;

      padding-top: 22px;

      border-top:
        1px solid #e2e8f0;
    }


    .btn-back {
      display: inline-block;

      padding: 11px 18px;

      border-radius: 9px;

      background: #f1f5f9;

      color: #475569;

      text-decoration: none;

      font-size: 12px;

      font-weight: bold;

      transition: 0.2s;
    }


    .btn-back:hover {
      background: #e2e8f0;
    }


    .btn-submit {
      border: none;

      padding: 12px 22px;

      border-radius: 9px;

      background:
        linear-gradient(135deg,
          #2563eb,
          #1d4ed8);

      color: white;

      font-size: 12px;

      font-weight: bold;

      cursor: pointer;

      transition: 0.2s;
    }


    .btn-submit:hover {
      transform: translateY(-2px);

      box-shadow:
        0 8px 18px rgba(37, 99, 235, 0.25);
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

    @media (max-width: 600px) {

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


      .form-card {
        padding: 22px;
      }


      .page-header h1 {
        font-size: 23px;
      }


      .form-actions {
        flex-direction: column-reverse;

        align-items: stretch;
      }


      .btn-back,
      .btn-submit {
        width: 100%;

        text-align: center;
      }

    }
  </style>

</head>


<body>


  <!-- =================================
     NAVBAR
================================== -->

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
================================== -->

  <main class="page-content">


    <div class="page-header">

      <a
        href="dashboard.php"
        class="back-link">
        ← Kembali ke Dashboard
      </a>


      <h1>
        Buat Laporan 📝
      </h1>


      <p>
        Sampaikan masalah atau kerusakan fasilitas
        kampus agar dapat segera ditindaklanjuti.
      </p>

    </div>



    <!-- =================================
         FORM CARD
    ================================== -->

    <div class="form-card">


      <div class="form-title">

        <div class="form-title-icon">
          📝
        </div>

        <div>

          <h2>
            Form Laporan Kerusakan
          </h2>

          <p>
            Lengkapi informasi laporan dengan jelas.
          </p>

        </div>

      </div>



      <!-- INFO -->

      <div class="info-box">

        <div class="info-box-icon">
          ℹ️
        </div>

        <div>
          Pastikan informasi yang kamu masukkan
          sudah benar agar pihak kampus dapat
          menemukan dan menangani masalah dengan
          lebih cepat.
        </div>

      </div>



      <!-- FORM -->

      <form
        action="simpan_laporan.php"
        method="POST"
        enctype="multipart/form-data">


        <!-- JUDUL -->

        <div class="form-group">

          <label for="judul_laporan">

            Judul Laporan

            <span class="required">
              *
            </span>

          </label>


          <input
            type="text"
            id="judul_laporan"
            name="judul_laporan"
            class="form-control"
            placeholder="Contoh: AC tidak menyala"
            required>

          <small class="form-help">
            Buat judul singkat yang menggambarkan masalah.
          </small>

        </div>



        <!-- DESKRIPSI -->

        <div class="form-group">

          <label for="deskripsi">

            Deskripsi Kerusakan

            <span class="required">
              *
            </span>

          </label>


          <textarea
            id="deskripsi"
            name="deskripsi"
            class="form-control"
            placeholder="Jelaskan kondisi atau kerusakan yang terjadi secara detail..."
            required></textarea>


          <small class="form-help">
            Jelaskan kondisi fasilitas, kapan masalah terjadi,
            dan informasi lain yang diperlukan.
          </small>

        </div>



        <!-- LOKASI -->

        <div class="form-group">

          <label for="lokasi_ruang">

            Lokasi Ruangan

            <span class="required">
              *
            </span>

          </label>


          <input
            type="text"
            id="lokasi_ruang"
            name="lokasi_ruang"
            class="form-control"
            placeholder="Contoh: Gedung A Lantai 2 Ruang 201"
            required>


          <small class="form-help">
            Tuliskan gedung, lantai, dan nomor ruangan
            jika tersedia.
          </small>

        </div>



        <!-- FOTO -->

        <div class="form-group">

          <label>
            Foto Bukti
          </label>


          <div class="upload-box">

            <div class="upload-icon">
              📷
            </div>


            <strong>
              Tambahkan Foto Bukti
            </strong>


            <span>
              Foto dapat membantu pihak kampus
              memahami kondisi kerusakan.
            </span>


            <input
              type="file"
              name="foto_bukti"
              class="file-input"
              accept="image/*">

          </div>


          <small class="form-help">
            Format gambar yang dapat digunakan:
            JPG, JPEG, PNG.
          </small>

        </div>



        <!-- BUTTON -->

        <div class="form-actions">


          <a
            href="dashboard.php"
            class="btn-back">
            ← Kembali
          </a>


          <button
            type="submit"
            class="btn-submit">
            Kirim Laporan 🚀
          </button>


        </div>


      </form>


    </div>


  </main>



  <footer class="footer">

    © 2026 UIN Kampus Care
    • Sistem Pelayanan Kampus

  </footer>


</body>

</html>