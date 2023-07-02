<?php
// Panggil file koneksi.php yang sudah ada
require_once "../koneksi.php";

// Cek apakah ID siswa telah diberikan melalui URL
if (isset($_GET['idsiswa'])) {
  $idsiswa = $_GET['idsiswa'];

  // Buat query untuk menghapus data siswa
  $sql = "DELETE FROM datatraining WHERE idsiswa=$idsiswa";

  // Jalankan query dan cek apakah query berhasil dijalankan atau tidak
  if ($koneksi->query($sql) === TRUE) {
    echo "Data berhasil dihapus";
    // Jika query berhasil dijalankan, kembali ke halaman utama dengan pesan sukses
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=../login/?p=datalatih'>";
    exit();
  } else {
    // Jika query gagal dijalankan, tampilkan pesan error
    echo "Error: " . $sql . "<br>" . $koneksi->error;
  }

  // Tutup koneksi database
  $koneksi->close();
} else {
  // Jika ID siswa tidak diberikan melalui URL, tampilkan pesan error
  echo "Error: ID siswa tidak diberikan";
}
?>
