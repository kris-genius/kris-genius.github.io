<?php
// Koneksi ke database
include('../koneksi.php');

// Fungsi untuk menghitung entropi
function entropy($data)
{
    $total = count($data);
    $counts = array_count_values($data);
    $entropy = 0;

    foreach ($counts as $count) {
        $probability = $count / $total;
        $entropy -= $probability * log($probability, 2);
    }

    return $entropy;
}

// Fungsi untuk menghitung informasi gain
function informationGain($data, $attribute, $label)
{
    $total = count($data);
    $attributeValues = array_unique(array_column($data, $attribute));
    $entropyS = entropy(array_column($data, $label));
    $informationGain = $entropyS;

    foreach ($attributeValues as $value) {
        $subset = array_filter($data, function ($row) use ($attribute, $value) {
            return $row[$attribute] == $value;
        });

        $subsetCount = count($subset);
        $subsetEntropy = entropy(array_column($subset, $label));
        $informationGain -= ($subsetCount / $total) * $subsetEntropy;
    }

    return $informationGain;
}

// Fungsi untuk membangun pohon keputusan
function buildDecisionTree($data, $attributes, $label)
{
    $values = array_column($data, $label);

    // Basis: jika semua data memiliki label yang sama
    if (count(array_unique($values)) == 1) {
        return $values[0];
    }

    // Basis: jika tidak ada atribut yang tersisa
    if (count($attributes) == 0) {
        $counts = array_count_values($values);
        $mostCommonLabel = array_search(max($counts), $counts);
        return $mostCommonLabel;
    }

    // Pilih atribut dengan informasi gain tertinggi
    $informationGains = array_map(function ($attribute) use ($data, $label) {
        return informationGain($data, $attribute, $label);
    }, $attributes);

    $bestAttributeIndex = array_search(max($informationGains), $informationGains);
    $bestAttribute = $attributes[$bestAttributeIndex];

    // Membangun pohon keputusan rekursif
    $tree = array();
    $tree[$bestAttribute] = array();
    $attributeValues = array_unique(array_column($data, $bestAttribute));

    foreach ($attributeValues as $value) {
        $subset = array_filter($data, function ($row) use ($bestAttribute, $value) {
            return $row[$bestAttribute] == $value;
        });

        $subsetAttributes = array_diff($attributes, array($bestAttribute));
        $tree[$bestAttribute][$value] = buildDecisionTree($subset, $subsetAttributes, $label);
    }

    return $tree;
}

// Fungsi untuk melakukan prediksi dengan pohon keputusan
function predict($instance, $tree)
{
    $attribute = array_keys($tree)[0];
    $value = $instance[$attribute];

    if (is_array($tree[$attribute])) {
        if (is_array($tree[$attribute][$value])) {
            return predict($instance, $tree[$attribute][$value]);
        } else {
            return $tree[$attribute][$value];
        }
    } else {
        return $tree[$attribute];
    }
}

// Ambil data latih dari tabel "datatraining"
$sql = "SELECT * FROM datatraining";
$result = mysqli_query($koneksi, $sql);
$dataTraining = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dataTraining[] = $row;
}

// Definisikan atribut kriteria dan label target
$attributes = array("pip", "tgortu", "phortu", "listrik");
$label = "pembayaran";

// Bangun pohon keputusan menggunakan data latih
$decisionTree = buildDecisionTree($dataTraining, $attributes, $label);

// Ambil data baru dari form input
$noinduk = $_POST['noinduk'];
$nama = $_POST['nama'];
$pip = $_POST['pip'];
$tgortu = $_POST['tgortu'];
$phortu = $_POST['phortu'];
$listrik = $_POST['listrik'];

// Buat instance data baru
$newInstance = array(
    "noinduk" => $noinduk,
    "nama" => $nama,
    "pip" => $pip,
    "tgortu" => $tgortu,
    "phortu" => $phortu,
    "listrik" => $listrik
);

// Lakukan prediksi dengan pohon keputusan
$prediction = predict($newInstance, $decisionTree);

// Simpan hasil prediksi klasifikasi ke tabel "datahasil"
$sql = "INSERT INTO datahasil (noinduk, nama, pip, tgortu, phortu, listrik) VALUES ('$noinduk', '$nama', '$pip', '$tgortu', '$phortu', '$listrik')";
mysqli_query($koneksi, $sql);
$sql2 = "INSERT INTO hasil (noinduk, nama, pembayaran) VALUES ('$noinduk', '$nama', '$prediction')";
mysqli_query($koneksi, $sql2);

// Tampilkan hasil prediksi
echo "Hasil prediksi klasifikasi: $prediction";
echo "<META HTTP-EQUIV='Refresh' Content='1; URL=../login/?p=hasilprediksi'>";
exit();
?>
