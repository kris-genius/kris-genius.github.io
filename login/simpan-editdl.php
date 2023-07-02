<?php
// Panggil file koneksi.php yang sudah ada
require_once "../koneksi.php";

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil nilai dari form
  $noinduk = $_POST['noinduk'];
  $nama = $_POST['nama'];
  $pip = $_POST['pip'];
  $tgortu = $_POST['tgortu'];
  $phortu = $_POST['phortu'];
  $listrik = $_POST['listrik'];
  $hasil = $_POST['pembayaran'];

  // Buat query untuk meng-update data siswa
  $sql = "UPDATE datatraining SET  nama='$nama', pip='$pip', tgortu='$tgortu', phortu='$phortu', listrik='$listrik', pembayaran='$hasil' WHERE noinduk='$noinduk'";

  // Jalankan query dan cek apakah query berhasil dijalankan atau tidak
  if ($koneksi->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
    // Jika query berhasil dijalankan, kembali ke halaman utama dengan pesan sukses

    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=../login/?p=datalatih'>";
    exit();
  } else {
    // Jika query gagal dijalankan, tampilkan pesan error
    echo "Error: " . $sql . "<br>" . $koneksi->error;
  }

  // Tutup koneksi database
  $koneksi->close();
}
