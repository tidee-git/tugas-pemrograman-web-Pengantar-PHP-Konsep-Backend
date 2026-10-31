<?php
$matkul = [
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 88],
    ["nama" => "Basis Data", "sks" => 3, "nilai" => 76],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 67],
    ["nama" => "Sistem Operasi", "sks" => 2, "nilai" => 58],
    ["nama" => "Matematika Diskrit", "sks" => 2, "nilai" => 42]
];

function hitungBobot($nilai) {
    if ($nilai >= 85) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 75) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 65) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$totalSks = 0;
$totalMutu = 0;

foreach ($matkul as $kuliah) {
    $hasil = hitungBobot($kuliah["nilai"]);
    $totalSks += $kuliah["sks"];
    $totalMutu += $kuliah["sks"] * $hasil["bobot"];
}

$ips = $totalMutu / $totalSks;
$batasSks = $ips >= 3.00 ? 24 : 20;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Nilai Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: white;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 25px;
            background: white;
            border: 2px solid black;
        }

        h1 {
            text-align: center;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
            color: black;
            background: white;
        }

        th {
            color: white;
            background: black;
        }

        .mengulang td {
            color: #b91c1c;
            background: #fee2e2;
            font-weight: bold;
        }

        .ringkasan {
            margin-top: 25px;
            padding: 15px;
            color: black;
            background: white;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rekap Nilai Mahasiswa</h1>

        <table>
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai Angka</th>
                <th>Nilai Huruf</th>
                <th>Bobot</th>
                <th>Status</th>
            </tr>

            <?php foreach ($matkul as $kuliah): ?>
                <?php
                $hasil = hitungBobot($kuliah["nilai"]);
                $status = $hasil["bobot"] >= 2.0 ? "LULUS" : "MENGULANG";
                $warna = $status == "MENGULANG" ? "mengulang" : "";
                ?>

                <tr class="<?php echo $warna; ?>">
                    <td><?php echo $kuliah["nama"]; ?></td>
                    <td><?php echo $kuliah["sks"]; ?></td>
                    <td><?php echo $kuliah["nilai"]; ?></td>
                    <td><?php echo $hasil["huruf"]; ?></td>
                    <td><?php echo $hasil["bobot"]; ?></td>
                    <td><?php echo $status; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="ringkasan">
            <h2>Ringkasan IPS</h2>
            <p>Total SKS: <?php echo $totalSks; ?> SKS</p>
            <p>IPS: <?php echo number_format($ips, 2); ?></p>
            <p>Batas maksimal SKS semester depan: <?php echo $batasSks; ?> SKS</p>
        </div>
    </div>
</body>
</html>