<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<script>
  $(document).ready(function() {
    // Menangani klik pada tombol "Hapus Semua Data"
    $('#hapusSemuaBtn').on('click', function() {
      $.ajax({
        url: 'importdelete/hapusdataprediksi.php', // Ganti dengan URL yang sesuai ke file PHP yang akan menghapus data
        type: 'POST',
        data: {
          hapusSemua: true
        }, // Kirim data bahwa Anda ingin menghapus semua data
        success: function(response) {
          alert('Semua data telah dihapus.'); // Tampilkan pesan sukses
          // Lakukan tindakan lain setelah data dihapus, seperti memuat ulang halaman atau melakukan operasi lainnya
          // Krisna Keren IG: @krisnanda_pratama15
          // Melakukan auto refresh setelah 0 detik (0000 milidetik)
          setTimeout(function() {
            location.reload();
          }, 0000);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText); // Tampilkan pesan error dalam konsol browser
          alert('Terjadi kesalahan saat menghapus data.'); // Tampilkan pesan error
        }
      });
    });
  });
</script>

<div class="prediksi">
  <div class="kepala">
    <div class="isikepala">
      <span><a href="">Home</a> / Hasil Data Mining</span>
    </div>
  </div>
  <div class="konten">
    <div class="isi-konten">
      <?php
      include('../koneksi.php');
      $sql = "SELECT dh.*, h.pembayaran FROM datahasil dh JOIN hasil h ON dh.idsiswa = h.idsiswa";
      $result = mysqli_query($koneksi, $sql);
      ?>
      <div class="judultb">
        <h3>Hasil Prediksi</h3>
      </div>
      <div>
        <button id="hapusSemuaBtn">Hapus Semua Data</button>
      </div>
      <div class="tb">
        <table id="example" class="display datatables_wrapper border" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NISN</th>
              <th>Nama</th>
              <th>Penerima PIP/KIP</th>
              <th>Tanggungan Ortu</th>
              <th>Penghasilan Ortu</th>
              <th>Daya Listrik</th>
              <th>Hasil</th>
              <th class="tambahdata">
                <div class="kotak"><a href="<?php echo "?p=prediksi"; ?>">Prediksi</a></div>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $nomor = 1;
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $row['noinduk']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['pip']; ?></td>
                <td><?php echo $row['tgortu']; ?></td>
                <td><?php echo $row['phortu']; ?></td>
                <td><?php echo $row['listrik']; ?></td>
                <td><?php echo $row['pembayaran']; ?></td>
                <td class="hapus">
                  <a href="hapusprediksi.php?idsiswa=<?php echo $row['idsiswa']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>

                </td>
              </tr>
            <?php $nomor++; // Increment nomor urut 
            }  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style>
  .datalatih {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
  }

  .konten {
    display: flex;
    flex-direction: column;
    background: #f2f2f2;
    height: 100%;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  .isi-konten {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    margin-bottom: 10px;
    padding: 20px;
  }

  td a {
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
    margin: 5px;
    text-decoration: none;
  }

  td a i.fa-edit {
    color: blue;
  }

  td a i.fa-trash {
    color: red;
  }

  .hapus {
    text-align: center;
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

  .tambahdata a {
    text-decoration: none;
    color: #ffffff;
  }

  .kotak {
    background-color: #ff9915;
    padding: 5px;
    border-radius: 2px;
    box-shadow: 0 0 10px #ff9915;
  }

  .import {
    padding: 5px;
    cursor: pointer;
  }

  #hapusSemuaBtn {
    padding: 5px;
    cursor: pointer;
  }
</style>