<?php
if (isset($_POST['importBtn'])) {
  // Memeriksa apakah file CSV diunggah
  if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == UPLOAD_ERR_OK) {
    // Mengambil file yang diunggah
    $csvFile = $_FILES['csvFile']['tmp_name'];

    // Inisialisasi koneksi ke database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'c45';
    $koneksi = mysqli_connect($host, $username, $password, $database);

    $handle = fopen($csvFile, "r");

    // Mendapatkan header kolom
    $header = fgetcsv($handle, 1000, ";");

    // Menyimpan data ke dalam database
    while (($data = fgetcsv($handle, 1000, ";")) !== false) {
      // Mengeleminasi baris header
      if ($data !== $header) {
        $noinduk = $data[0];
        $nama = $data[1];
        $pip = $data[2];
        $tgortu = $data[3];
        $phortu = $data[4];
        $listrik = $data[5];
        $pembayaran = $data[6];

        // Lakukan operasi INSERT ke database dengan data yang telah diambil
        // Gantikan 'nama_tabel' dengan nama tabel sesuai kebutuhan
        // Sesuaikan kolom-kolom di VALUES sesuai dengan struktur tabel
        $query = "INSERT INTO datatraining (noinduk, nama, pip, tgortu, phortu, listrik, pembayaran) VALUES ('$noinduk', '$nama', '$pip', '$tgortu', '$phortu', '$listrik', '$pembayaran')";
        // Eksekusi query menggunakan koneksi database yang telah disiapkan sebelumnya
        mysqli_query($koneksi, $query);
      }
    }

    fclose($handle);

    // Tampilkan pesan sukses atau error
    if (mysqli_error($koneksi)) {
      echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    } else {
      echo "Import berhasil.";
      echo "<META HTTP-EQUIV='Refresh' Content='1; URL=../?p=datalatih'>";
      exit();
    }
  } else {
    echo "File CSV belum diunggah.";
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=../?p=datalatih'>";
      exit();
  }
}
?>
