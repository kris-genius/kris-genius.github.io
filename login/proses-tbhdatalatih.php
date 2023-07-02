<?php
// Panggil file koneksi.php yang sudah ada
require_once "../koneksi.php";

// Simpan data dari form ke dalam variabel
$noinduk = $_POST['noinduk'];
$nama = $_POST['nama'];
$pip = $_POST['pip'];
$tgortu = $_POST['tgortu'];
$phortu = $_POST['phortu'];
$listrik = $_POST['listrik'];
$hasil = $_POST['pembayaran'];

// Buat query untuk menyimpan data ke dalam tabel
$sql = "INSERT INTO datatraining (noinduk, nama, pip, tgortu, phortu, listrik, pembayaran) VALUES ('$noinduk', '$nama', '$pip', '$tgortu', '$phortu', '$listrik', '$hasil')";

// Jalankan query dan cek apakah berhasil disimpan atau tidak
if ($koneksi->query($sql) === TRUE) {
  echo "Data berhasil disimpan";
  header("Location: ../login/?p=datalatih");
} else {
  echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
?>



