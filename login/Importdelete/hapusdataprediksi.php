<?php
if (isset($_POST['hapusSemua']) && $_POST['hapusSemua'] == true) {
  // Inisialisasi koneksi ke database
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'c45';
  $koneksi = mysqli_connect($host, $username, $password, $database);

  // Query untuk menghapus semua data dari tabel
  $query = "TRUNCATE TABLE datahasil";
  mysqli_query($koneksi, $query);

  $query1 = "TRUNCATE TABLE hasil";
  mysqli_query($koneksi, $query1);

  // Tutup koneksi database
  mysqli_close($koneksi);
}
?>
