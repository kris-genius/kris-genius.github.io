<?php
// Panggil file koneksi.php yang sudah ada
require_once "../koneksi.php";

// Simpan data dari form ke dalam variabel
$noinduk = $_POST['noinduk'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$pip = $_POST['pip'];
$tgortu = $_POST['tgortu'];
$phortu = $_POST['phortu'];
$listrik = $_POST['listrik'];

// Buat query untuk menyimpan data ke dalam tabel
$sql = "INSERT INTO datasiswa (noinduk, nama, kelas, pip, tgortu, phortu, listrik) VALUES ('$noinduk', '$nama', '$kelas', '$pip', '$tgortu', '$phortu', '$listrik')";

// Jalankan query dan cek apakah berhasil disimpan atau tidak
if ($koneksi->query($sql) === TRUE) {
  echo "Data berhasil disimpan";
  header("Location: ../login/?p=datasiswa");
} else {
  echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
?>



