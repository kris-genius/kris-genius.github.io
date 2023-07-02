<?php
session_start(); // aktifkan session

// include file koneksi.php
require '../koneksi.php';

// jika belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
  header('location: ../?pesan=belum_login');
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Prediksi</title>
</head>


<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="styleku.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfmake/build/pdfmake.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfmake/build/vfs_fonts.js"></script>


</script>

<script src="preloader.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      scrollX: true,
      dom: "<'row'<'col-sm-6'l>'B'<'col-sm-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print',

      ]

    });
  });
</script>

<script>
  function tablePrint() {
    $('#example').DataTable().button('print').trigger();
  }
</script>

<body>
  <div class="preloader">
    <div class="spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

  <div class="container">

    <div class="sidebar">
      <div class="header">
        <div class="list-item">
          <img src="img/icon.png" alt="gambar logo" class="icon">
          <span class="description-header">Prediksi C4.5</span>
        </div>

        <div class="logo">
          <a href=""><img src="img/logo.png" alt="" class="sekolah"></a>
        </div>
      </div>

      <div class="menu">
        <div class="list-item">
          <a href="<?php echo "/prec45/login"; ?>">
            <img src="img/db.png" alt="">
            <span class="description">Beranda</span>
          </a>
        </div>
        <div class="list-item">
          <a href="<?php echo "?p=datalatih"; ?>">
            <img src="img/datatrain.png" alt="">
            <span class="description">Data Training</span>
          </a>
        </div>
        <div class="list-item">
          <a href="<?php echo "?p=pohonkeputusan"; ?>">
            <img class="svg-icon" src="img/pohon.svg" alt="">
            <span class="description">Pohon Keputusan</span>
          </a>
        </div>
        <div class="list-item">
          <a href="<?php echo "?p=datasiswa"; ?>">
            <img src="img/siswa.png" alt="">
            <span class="description">Data Siswa</span>
          </a>
        </div>
        <div class="list-item">
          <a href="<?php echo "?p=hasilprediksi"; ?>">
            <img src="img/dm.png" alt="">
            <span class="description">Hasil Data Mining</span>
          </a>
        </div>
        <div class="list-item">
          <a href="<?php echo "?p=info"; ?>">
            <img src="img/info.png" alt="">
            <span class="description">Bantuan</span>
          </a>
        </div>
      </div>
    </div>

    <div class="wrapper">
      <div class="navbar">
        <div id="tbmenu">
          <input type="checkbox" id="menu-checkbox">
          <label for="menu-checkbox" id="menu-label">
            <img src="img/menu.svg" alt="menu">
          </label>
        </div>
        <div class="menunav">
          <a href="<?php echo "/prec45/login"; ?>">
            <img src="img/home.svg" alt="">
            <span class="description">Beranda</span>
          </a>
        </div>
        <div class="kanan">
          <div class="akun">
            <span class="description"><?php echo $_SESSION['username']; ?></span>
            <img src="img/person.svg" alt="">
          </div>
          <div class="keluar">
            <a href="../logout.php">
              <span class="description">LogOut</span>
              <img src="img/out.svg" alt="">
            </a>
          </div>
        </div>
      </div>


      <div class="main">
        <div class="isi">

          <?php

          if (isset($_GET["p"])) {
            if ($_GET["p"] == "beranda") {
              include "beranda.php";
            } else if ($_GET["p"] == "datalatih") {
              include "datalatih.php";
            } else if ($_GET["p"] == "pohonkeputusan") {
              include "pohonkeputusan.php";
            } else if ($_GET["p"] == "datasiswa") {
              include "datasiswa.php";
            } else if ($_GET["p"] == "hasilprediksi") {
              include "hasilprediksi.php";
            } else if ($_GET["p"] == "info") {
              include "info.php";
            } else if ($_GET["p"] == "prediksi") {
              include "prediksi.php";
            } else if ($_GET["p"] == "ubah-datalatih") {
              include "ubah-datalatih.php";
            } else if ($_GET["p"] == "ubah-datasiswa") {
              include "ubah-datasiswa.php";
            } else if ($_GET["p"] == "tbhdatasiswa") {
              include "tbhdatasiswa.php";
            } else {
              include "tbhdatalatih.php";
            }
          } else {
            include "beranda.php";
          }
          ?>

        </div>
        <div class="kaki">
          <span class="tulis">
            Copyright &copy; 2023 | Made with <span style="color: #e25555;">&#9829;</span> by Krisnanda Pratama
          </span>
        </div>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>