<div class="datalatih">
    <div class="konten">
        <div class="isi-konten">
            <form action="proses-tbhdatasiswa.php" method="post">
                <div class="label">
                    <label for="noinduk">NISN</label>
                    <div class="kotak">
                        <input name="noinduk" type="text" required>
                    </div>
                </div>
                <div class="label">
                    <label for="nama">Nama</label>
                    <div class="kotak">
                        <input name="nama" type="text" required>
                    </div>
                </div>
                <div class="label">
                <label for="kelas">Kelas</label>
                    <div class="kotak">
                        <select name="kelas" id="kelas">
                        <option value=""></option>
                        <option value="9A">9A</option>
                        <option value="9B">9B</option>
                        <option value="9C">9C</option>
                        <option value="8A">8A</option>
                        <option value="8B">8B</option>
                        <option value="7A">7A</option>
                        <option value="7B">7B</option>
                        </select>
                    </div>
                </div>
                <div class="label">
                    <label for="pip">Penerima PIP/KIP</label>
                    <div class="kotak">
                        <select name="pip" id="pip">
                            <option value=""></option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="label">
                    <label for="tgortu">Tanggungan Orang Tua</label>
                    <div class="kotak">
                        <select name="tgortu" id="tgortu">
                            <option value=""></option>
                            <option value="1-2 0rang">1-2 0rang</option>
                            <option value="3-4 0rang">3-4 0rang</option>
                            <option value="4 Orang">>4 Orang</option>
                        </select>
                    </div>
                </div>
                <div class="label">
                    <label for="phortu">Penghasilan Orang Tua</label>
                    <div class="kotak">
                        <select name="phortu" id="phortu">
                            <option value=""></option>
                            <option value="&le;1.000.000">&le;1.000.000</option>
                            <option value=">1.000.000 s/d 2.500.000">>1.000.000 s/d 2.500.000</option>
                            <option value=">2.500.000 s/d 4.000.000">>2.500.000 s/d 4.000.000</option>
                            <option value=">4.000.000">>4.000.000</option>
                        </select>
                    </div>
                </div>
                <div class="label">
                    <label for="listrik">Daya Listrik</label>
                    <div class="kotak">
                        <select name="listrik" id="listrik">
                            <option value=""></option>
                            <option value="450 VA">450 VA</option>
                            <option value="900 VA">900 VA</option>
                            <option value="1300 VA">1300 VA</option>
                            <option value="&ge;2200 VA"><sup>&ge;</sup>2200 VA</option>
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

.label > label {
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
