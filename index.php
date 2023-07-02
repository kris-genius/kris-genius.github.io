<!doctype html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pre SPP | Login</title>
  <!-- CSS dari Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- CSS manual -->
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <div class="global-container">
    <div class="card login-form">
      <div class="card-body">
        <h1 class="card-title text-center">LOGIN</h1>
      </div>
      <div class="sisikanan">
        <div class="card-text">
          <form method="POST" action="login.php">
            <div class="judul">
              <h4 class="a">Pre-SPP</h4>
              <h4 class="b">MTsS Al-Islamiyah Karang Anyar</h4>
            </div>
            <p class="teks">Silahkan Masuk Dengan Akun Yang Telah Terdaftar!</p>
            <div class="mb-3">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="pesan">
              <!--Untuk buat pesan ketampilan login -->
              <?php
              if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") {
                  echo "<i class='bi bi-exclamation-triangle'><p class='error'>Login gagal! sername dan password salah!</p></i>";
                } else if ($_GET['pesan'] == "logout") {
                  echo "<i class='bi bi-exclamation-triangle'><p class='success'>Anda telah berhasil logout</p></i>";
                } else if ($_GET['pesan'] == "belum_login") {
                  echo "<p class='warning'>Anda harus login untuk mengakses halaman admin</i></p></i>";
                }
              }
              ?>
            </div>

          </form>

        </div>
        <div class="kaki">
          <span class="tulis">
            Copyright &copy; 2023 | Made with <span style="color: #e25555;">&#9829;</span> by Krisnanda Pratama
          </span>
        </div>
      </div>
    </div>
  </div>

</body>

</html>