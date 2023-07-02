<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<div class="menu-beranda">
  <div class="kepala">
    <div class="isikepala">
      <span><a href="">Home</a> / Beranda</span>
    </div>
  </div>
  <div class="menu-beranda-top">
    <div class="menu-beranda-box menu-beranda-box1">
      <div class="menu-beranda-box-content">
        <div class="menu-beranda-avatar">
          <img src="img/akun.jpg" alt="Gambar Akun">
        </div>
        <h3 class="akun"><?php echo $_SESSION['username']; ?></h3>
        <br>
        <H4 class="pesan">Selamat Datang Di Aplikasi Prediksi Keterlambatan Pembayaran SPP MTsS Al-Islamiyah Karang Anyar Menggunakan Metode Klasifikasi Dengan Algoritma C4.5 (Decision Tree).</H4>
      </div>
    </div>

    <div class="menu-beranda-box menu-beranda-box2">
      <h3>Rincian</h3>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <h4 class="mb-0">Jumlah Siswa</h6>
          </div>
          <div class="col-sm-9"><?php
                                // Panggil file koneksi.php yang sudah ada
                                require_once "../koneksi.php";

                                // Buat query untuk menghitung jumlah data
                                $sql2 = "SELECT COUNT(*) as total FROM datasiswa";

                                // Jalankan query dan simpan hasilnya ke dalam variabel $result
                                $result = $koneksi->query($sql2);

                                // Periksa apakah query berhasil dijalankan
                                if ($result) {
                                  // Ambil data hasil query
                                  $row = $result->fetch_assoc();

                                  // Tampilkan jumlah data
                                  echo  $row['total'];
                                } else {
                                  // Jika query gagal dijalankan, tampilkan pesan error
                                  echo "Error: " . $koneksi->error;
                                }


                                ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h4 class="mb-0">Data Latih</h6>
          </div>
          <div class="col-sm-9"><?php
                                // Panggil file koneksi.php yang sudah ada
                                require_once "../koneksi.php";

                                // Buat query untuk menghitung jumlah data
                                $sql3 = "SELECT COUNT(*) as total FROM datatraining";

                                // Jalankan query dan simpan hasilnya ke dalam variabel $result
                                $result = $koneksi->query($sql3);

                                // Periksa apakah query berhasil dijalankan
                                if ($result) {
                                  // Ambil data hasil query
                                  $row = $result->fetch_assoc();

                                  // Tampilkan jumlah data
                                  echo  $row['total'];
                                } else {
                                  // Jika query gagal dijalankan, tampilkan pesan error
                                  echo "Error: " . $koneksi->error;
                                }

                                // Tutup koneksi database
                                $koneksi->close();
                                ?>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <h4 class="mb-0">Tahun Ajaran</h6>
        </div>
        <div class="col-sm-9">2022/2023</div>
      </div>
      <hr>


    </div>
  </div>
  <div class="menu-beranda-bottom">
    <div class="menu-beranda-box menu-beranda-box3">
      <div class="judultb">
        <h3>Data Siswa</h3>
      </div>
      <div class="tb">
        <table id='example' class='display datatables_wrapper border' style='width:100%'>
          <thead>
            <tr>
              <th>No</th>
              <th>NISN</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Penerima PIP/KIP</th>
              <th>Tanggungan Ortu</th>
              <th>Penghasilan Ortu</th>
              <th>Daya Listrik</th>
            </tr>
          </thead>
          <tbody>

            <?php
            // Mengambil data dari database
            include "../koneksi.php";
            $sql = "SELECT * FROM datasiswa";
            $result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result) > 0) {
              // Menampilkan data ke dalam tabel
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row["noinduk"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["kelas"] . "</td>";
                echo "<td>" . $row["pip"] . "</td>";
                echo "<td>" . $row["tgortu"] . "</td>";
                echo "<td>" . $row["phortu"] . "</td>";
                echo "<td>" . $row["listrik"] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "0 results";
            }

            // Menutup koneksi database
            mysqli_close($koneksi);
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>



  <style>
    .menu-beranda {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .menu-beranda-top {
      display: flex;
      justify-content: space-between;
      align-items: stretch;
      height: 50%;
    }

    .menu-beranda-bottom {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 50%;
    }

    .menu-beranda-box {
      flex-basis: calc(50% - 20px);
      padding: 20px;
      background-color: #f2f2f2;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      border-radius: 5px;
    }

    .menu-beranda-box1 {
      margin-right: 20px;
    }

    .menu-beranda-box2 {
      margin-left: 20px;
    }

    .menu-beranda-box3 {
      flex-basis: calc(100% - 40px);
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      .menu-beranda {
        flex-direction: column;
      }

      .menu-beranda-top {
        flex-wrap: wrap;
      }

      .menu-beranda-box {
        flex-basis: 100%;
        margin: 0;
      }

      .menu-beranda-box1,
      .menu-beranda-box2,
      .menu-beranda-box3 {
        margin-top: 20px;
      }
    }

    /*untuk tampilan kotan akunnya*/
    .menu-beranda-avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 10px;
    }

    .menu-beranda-avatar img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .menu-beranda-box-content {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100%;
      margin-bottom: 10px;
      border-bottom: 1px solid #fff000;
    }

    .akun {
      text-align: center;
    }

    .pesan {
      text-align: center;
      margin: 0px 2px;
    }
  </style>

  <style>
    h3 {

      margin-bottom: 5px;
    }

    .tb {
      padding-top: 10px;
    }

    /*
table {
  border-collapse: collapse;
  border: 2px solid #aaaaaa;
  width: 100%;
}

table th, table td {
  text-align: left;
  padding: 8px;
}

table th {
  background-color: #f2f2f2;
  color: #333;
  border-bottom: 2px solid #333;
}

table tr:nth-child(odd) {
  background-color: #ddd;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

table tr:hover {
  background-color: #aaa;
}
*/
    .judultb {
      border-bottom: 1px solid #aaaaaa;
      margin-bottom: 5px;
    }

    .row {
      display: flex;
      justify-content: space-between;
      padding: 20px;
    }

    .isikepala {
      padding-bottom: 20px;
      text-align: right;
    }

    .isikepala a {
      text-decoration: none;
      color: #00c4b3;
    }

    .isikepala span {
      text-decoration: none;
      color: #888888;
    }
  </style>