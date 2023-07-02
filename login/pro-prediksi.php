<?php

include "../koneksi.php";


// Ambil data dari form
$noinduk = $_POST['noinduk'];
$nama = $_POST['nama'];
$pip = $_POST['pip'];
$tgortu = $_POST['tgortu'];
$phortu = $_POST['phortu'];
$listrik = $_POST['listrik'];

// Query untuk mengambil data training dari tabel datatraining
$query = "SELECT pembayaran FROM datatraining WHERE pip='$pip' AND tgortu='$tgortu' AND phortu='$phortu' AND listrik='$listrik'";
function entropy($arr) {
  $count = count($arr);
  $result = 0;

  if ($count <= 1) {
    return 0;
  }

  foreach (array_count_values($arr) as $value) {
    $probability = $value / $count;
    $result -= $probability * log($probability, 2);
  }

  return $result;
}

function gain($data, $split_attribute, $class_attribute) {
  $counts = array_count_values(array_column($data, $split_attribute));
  $total = count($data);
  $result = entropy(array_column($data, $class_attribute));

  foreach ($counts as $value => $count) {
    $probability = $count / $total;
    $subset = array_filter($data, function ($row) use ($split_attribute, $value) {
      return $row[$split_attribute] == $value;
    });
    $result -= $probability * entropy(array_column($subset, $class_attribute));
  }

  return $result;
}

function build_decision_tree($data, $attributes) {
  $classes = array_unique($data['class']);
  $default = max(array_count_values($data['class']));
  $node = array();

  // Jika semua data memiliki label yang sama, jangan membuat node baru
  if (count($classes) === 1) {
    $node['label'] = $classes[0];
    return $node;
  }

  // Jika tidak ada lagi atribut yang bisa dipilih, gunakan label mayoritas
  if (empty($attributes)) {
    $node['label'] = array_search($default, array_count_values($data['class']));
    return $node;
  }

  // Pilih atribut terbaik untuk dijadikan sebagai node saat ini
  $best = '';
  $best_gain = 0;
  foreach ($attributes as $attribute) {
    $values = array_unique($data[$attribute]);
    $gain = gain($data, $attribute, 'class');
    if ($gain > $best_gain) {
      $best = $attribute;
      $best_gain = $gain;
    }
  }

  // Buat node baru dengan atribut terbaik sebagai label
  $node['label'] = $best;
  $node['branches'] = array();

  // Rekursif untuk setiap nilai dari atribut terbaik
  $values = array_unique($data[$best]);
  foreach ($values as $value) {
    $new_attributes = array_diff($attributes, [$best]);
    $new_data = array();
    foreach ($data['class'] as $key => $class) {
      if ($data[$best][$key] === $value) {
        $new_data['class'][] = $class;
        foreach ($attributes as $attribute) {
          $new_data[$attribute][] = $data[$attribute][$key];
        }
      }
    }
    $node['branches'][$value] = build_decision_tree($new_data, $new_attributes);
  }

  return $node;
}




// Query untuk mengambil semua data dari tabel datatraining
$query = "SELECT * FROM datatraining";

// Jalankan query dan simpan hasilnya ke dalam variabel
$result = mysqli_query($koneksi, $query);

// Simpan semua data ke dalam array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Hitung entropy dan gain untuk semua atribut
$entropy_pembyrn = entropy(array_column($data, 'pembayaran'));
$gain_pip = gain($data, 'pip', 'pembayaran');
$gain_tgortu = gain($data, 'tgortu', 'pembayaran');
$gain_phortu = gain($data, 'phortu', 'pembayaran');
$gain_listrik = gain($data, 'listrik', 'pembayaran');



// Query untuk mengambil data training dari tabel datatraining
$query = "SELECT * FROM datatraining WHERE pembayaran IN ('Tidak Lancar', 'Lancar')";

// Jalankan query dan simpan hasilnya ke dalam variabel
$result = mysqli_query($koneksi, $query);

// Simpan semua data ke dalam array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Hitung entropy dan gain untuk setiap atribut
$entropy_pembyrn = entropy(array_column($data, 'pembayaran'));
$gain_pip = gain($data, 'pip', 'pembayaran');
$gain_tgortu = gain($data, 'tgortu', 'pembayaran');
$gain_phortu = gain($data, 'phortu', 'pembayaran');
$gain_listrik = gain($data, 'listrik', 'pembayaran');

// Tampilkan hasil perhitungan entropy dan gain
echo "Entropy Pembayaran: " . $entropy_pembyrn . "<br>";
echo "Gain PIP: " . $gain_pip . "<br>";
echo "Gain Tg. Ortu: " . $gain_tgortu . "<br>";
echo "Gain Ph. Ortu: " . $gain_phortu . "<br>";
echo "Gain Listrik: " . $gain_listrik . "<br>";


// Klasifikasikan data menjadi 2 kelas: Tidak Lancar dan Lancar
$tidak_lancar = array_filter($data, function($item) {
  return $item['pembayaran'] == 'Tidak Lancar';
  });
  
  $lancar = array_filter($data, function($item) {
  return $item['pembayaran'] == 'Lancar';
  });
  
  // Tampilkan jumlah data dalam setiap kelas
  echo "Jumlah Data Tidak Lancar: " . count($tidak_lancar) . "<br>";
  echo "Jumlah Data Lancar: " . count($lancar) . "<br>";





  


// Simpan hasil klasifikasi ke dalam tabel hasil
$query = "INSERT INTO hasil (noinduk, nama, pembayaran) VALUES ('$noinduk', '$nama', '$hasil')";
mysqli_query($koneksi, $query);

// Tutup koneksi ke database
mysqli_close($koneksi);

// Redirect ke halaman hasil prediksi
