<div class="datasiswa">
    <div class="konten">
        <div class="isi-konten">

            <?php
            // Panggil file koneksi.php yang sudah ada
            require_once "../koneksi.php";

            // Cek apakah ada parameter idsiswa yang dikirim melalui URL
            if (isset($_GET['idsiswa'])) {
                $idsiswa = $_GET['idsiswa'];

                // Buat query untuk menampilkan data siswa berdasarkan idsiswa
                $sql = "SELECT * FROM datasiswa WHERE idsiswa='$idsiswa'";
                $result = $koneksi->query($sql);

                // Cek apakah data siswa ditemukan atau tidak
                if ($result->num_rows > 0) {
                    // Tampilkan form untuk mengedit data siswa
                    $row = $result->fetch_assoc();
            ?>
                    <form action="simpan-editsw.php" method="POST">
                        <div class="label">
                            <label for="noinduk">NISN</label>
                            <div class="kotak">
                                <input name="noinduk" type="text" value="<?php echo $row['noinduk']; ?>" required>
                            </div>
                        </div>
                        <div class="label">
                            <label for="nama">Nama</label>
                            <div class="kotak">
                                <input name="nama" type="text" value="<?php echo $row['nama']; ?>" required>
                            </div>
                        </div>
                        <div class="label">
                            <label for="kelas">Kelas</label>
                            <div class="kotak">
                                <select name="kelas" id="kelas">
                                    <option value=""></option>
                                    <option value="9A" <?php if ($row['kelas'] == '9A') echo 'selected'; ?>>9A</option>
                                    <option value="9B" <?php if ($row['kelas'] == '9B') echo 'selected'; ?>>9B</option>
                                    <option value="9C" <?php if ($row['kelas'] == '9C') echo 'selected'; ?>>9C</option>
                                    <option value="8A" <?php if ($row['kelas'] == '8A') echo 'selected'; ?>>8A</option>
                                    <option value="8B" <?php if ($row['kelas'] == '8B') echo 'selected'; ?>>8B</option>
                                    <option value="7A" <?php if ($row['kelas'] == '7A') echo 'selected'; ?>>7A</option>
                                    <option value="7B" <?php if ($row['kelas'] == '7B') echo 'selected'; ?>>7B</option>
                                </select>
                            </div>
                        </div>
                        <div class="label">
                            <label for="pip">Penerima PIP/KIP</label>
                            <div class="kotak">
                                <select name="pip" id="pip">
                                    <option value=""></option>
                                    <option value="Ya" <?php if ($row['pip'] == 'Ya') echo 'selected'; ?>>Ya</option>
                                    <option value="Tidak" <?php if ($row['pip'] == 'Tidak') echo 'selected'; ?>>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="label">
                            <label for="tgortu">Tanggungan Orang Tua</label>
                            <div class="kotak">
                                <select name="tgortu" id="tgortu">
                                    <option value=""></option>
                                    <option value="1-2 0rang" <?php if ($row['tgortu'] == '1-2 0rang') echo 'selected'; ?>>1-2 0rang</option>
                                    <option value="3-4 0rang" <?php if ($row['tgortu'] == '3-4 0rang') echo 'selected'; ?>>3-4 0rang</option>
                                    <option value=">4 Orang" <?php if ($row['tgortu'] == '>4 Orang') echo 'selected'; ?>>&gt;4 Orang</option>
                                </select>
                            </div>
                        </div>
                        <div class="label">
                            <label for="phortu">Penghasilan Orang Tua</label>
                            <div class="kotak">
                                <select name="phortu" id="phortu">
                                    <option value=""></option>
                                    <option value="&le;1.000.000" <?php if ($row['phortu'] == '&le;1.000.000') echo 'selected'; ?>>&le;1.000.000</option>
                                    <option value=">1.000.000 s/d 2.500.000" <?php if ($row['phortu'] == '>1.000.000 s/d 2.500.000') echo 'selected'; ?>>&gt;1.000.000 s/d 2.500.000</option>
                                    <option value=">2.500.000 s/d 4.000.000" <?php if ($row['phortu'] == '>2.500.000 s/d 4.000.000') echo 'selected'; ?>>&gt;2.500.000 s/d 4.000.000</option>
                                    <option value=">4.000.000" <?php if ($row['phortu'] == '>4.000.000') echo 'selected'; ?>>&gt;4.000.000</option>
                                </select>
                            </div>
                        </div>
                        <div class="label">
                            <label for="listrik">Daya Listrik</label>
                            <div class="kotak">
                                <select name="listrik" id="listrik">
                                    <option value=""></option>
                                    <option value="450 VA" <?php if ($row['listrik'] == '450 VA') echo 'selected'; ?>>450 VA</option>
                                    <option value="900 VA" <?php if ($row['listrik'] == '900 VA') echo 'selected'; ?>>900 VA</option>
                                    <option value="1300 VA" <?php if ($row['listrik'] == '1300 VA') echo 'selected'; ?>>1300 VA</option>
                                    <option value="&ge;2200 VA" <?php if ($row['listrik'] == '&ge;2200 VA') echo 'selected'; ?>>&ge;2200 VA</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="batal">
                                <a href="?p=datasiswa">Batal</a>
                            </div>
                        </div>
                    </form>


            <?php
                } else {
                    echo "Data siswa tidak ditemukan.";
                }
            } else {
                echo "Parameter idsiswa tidak ditemukan.";
            }
            // Tutup koneksi database
            $koneksi->close();
            ?>


        </div>
    </div>
</div>


<style>
    .datasiswa {
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
</style>

<style>
    h3 {

        margin-bottom: 5px;
    }


    /* Style untuk label */
    .label {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 10px;
    }

    .label>label {
        margin-right: 10px;
        flex-basis: 30%;
    }

    /* Style untuk input dan select box */
    .kotak {
        display: flex;
        align-items: center;
        flex-basis: 70%;
    }

    input[type="text"],
    select {
        padding: 8px;
        border: 2px solid #ccc;
        border-radius: 5px;
        flex: 1;
        margin-right: 10px;
    }


    /* Style untuk tombol submit */
    button[type="submit"] {
        margin-top: 20px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #ff9915;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
    }

    button[type="submit"]:hover {
        background-color: #d47901;
    }

    .btn {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .batal {
        margin-top: 20px;
        margin-left: 20px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #ff9915;
    }

    .batal a {
        text-decoration: none;
        color: #fff;
    }

    .batal:hover {
        background-color: #d47901;
    }
</style>