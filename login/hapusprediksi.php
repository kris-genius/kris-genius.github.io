<?php
// Panggil file koneksi.php yang sudah ada
require_once "../koneksi.php";

// Cek apakah ID siswa telah diberikan melalui URL
if (isset($_GET['idsiswa'])) {
  $idsiswa = $_GET['idsiswa'];

  // Buat query untuk menghapus data dari tabel datahasil
  $sql1 = "DELETE FROM datahasil WHERE idsiswa=$idsiswa";

  // Buat query untuk menghapus data dari tabel datahasil
  $sql2 = "DELETE FROM hasil WHERE idsiswa=$idsiswa";

  // Jalankan query untuk menghapus data dari tabel datatraining
  if ($koneksi->query($sql1) === TRUE) {
    // Jika query berhasil dijalankan, lanjutkan untuk menghapus data dari tabel datahasil
    if ($koneksi->query($sql2) === TRUE) {
      echo "Data berhasil dihapus";
      // Jika kedua query berhasil dijalankan, kembali ke halaman utama dengan pesan sukses
      echo "<META HTTP-EQUIV='Refresh' Content='1; URL=../login/?p=hasilprediksi'>";
      exit();
    } else {
      // Jika query untuk menghapus data dari tabel datahasil gagal dijalankan, tampilkan pesan error
      echo "Error: " . $sql2 . "<br>" . $koneksi->error;
    }
  } else {
    // Jika query untuk menghapus data dari tabel datatraining gagal dijalankan, tampilkan pesan error
    echo "Error: " . $sql1 . "<br>" . $koneksi->error;
  }

  // Tutup koneksi database
  $koneksi->close();
} else {
  // Jika ID siswa tidak diberikan melalui URL, tampilkan pesan error
  echo "Error: ID siswa tidak diberikan";
}
