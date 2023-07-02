<div class="kepala">
    <div class="bapak">
        <div class="kau">
            <span><a href="">Home</a> / Pohon Keputusan</span>
        </div>
    </div>

    <div class="pecah">
        <div class="pala">
            <div class="otak">
                <h3>Pohon Keputusan :</h3>
            </div>
            <div class="ku">
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

                // Fungsi rekursif untuk menampilkan pohon keputusan
                function displayDecisionTree($tree, $level = 0)
                {
                    echo '<ul class="decision-tree">';
                    foreach ($tree as $attribute => $values) {
                        echo '<li>';
                        echo '<span class="attribute">------ ' . $attribute . '</span>';

                        if (is_array($values)) {
                            echo '<ul>';
                            displayDecisionTree($values, $level + 1);
                            echo '</ul>';
                        } else {
                            echo '<span class="decision"> =  ' . $values . '</span>';
                        }

                        echo '</li>';
                    }
                    echo '</ul>';
                }

                // Panggil fungsi untuk menampilkan pohon keputusan
                echo '<div class="decision-tree-container">';
                displayDecisionTree($decisionTree);
                echo '</div>';

                ?>
            </div>
        </div>
    </div>
</div>

<style>
    .kepala {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .pecah {
        display: flex;
        flex-direction: column;
        background: #f2f2f2;
        height: 100%;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .pala {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        margin-bottom: 10px;
        padding: 20px;
    }

    .otak {
        border-bottom: 1px solid #aaaaaa;
        margin-bottom: 5px;
    }

    .ku {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        margin-bottom: 10px;
        padding: 20px;
    }


    h3 {
        margin-bottom: 5px;
    }
</style>

<style>
    .kau {
        padding-bottom: 20px;
        text-align: right;
    }

    .kau a {
        text-decoration: none;
        color: #00c4b3;
    }

    .kau span {
        text-decoration: none;
        color: #888888;
    }

    ul {
        margin-left: 30px;
    }
</style>



<style>
    .decision-tree {
        list-style-type: none;
        padding-left: 2px;
    }

    .decision-tree li {
        margin-bottom: 10px;
    }

    .decision-tree .attribute {
        font-weight: bold;
    }

    .decision-tree .decision {
        color: #337ab7;
        font-weight: bold;
    }

    .decision-tree-container {
        border: 1px solid #ccc;
        padding: 10px;
        display: flex;
    }
</style>