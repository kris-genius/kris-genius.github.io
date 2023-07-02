<?php
if (isset($_POST['hapusSemua']) && $_POST['hapusSemua'] == true) {
  // Inisialisasi koneksi ke database
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'c45';
  $koneksi = mysqli_connect($host, $username, $password, $database);

  // Query untuk menghapus semua data dari tabel
  $query = "TRUNCATE TABLE datatraining";
  mysqli_query($koneksi, $query);

  // Tutup koneksi database
  mysqli_close($koneksi);
}
?>
