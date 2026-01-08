<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kalkulator CINTAH Pro</title>
    <style>
    body {
        font-family: 'Comic Sans MS', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background: #81aae7;
    }

    .kalkulator {
        background: #df7979;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        width: 320px;
        color: white;
        border: 4px solid #fff;
    }

    .riwayat-box {
        background: white;
        padding: 15px;
        border-radius: 15px;
        width: 320px;
        margin-top: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    input,
    select,
    button {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: none;
        border-radius: 10px;
        box-sizing: border-box;
        font-size: 16px;
    }

    /* Tombol Pink Cintah */
    button[name="hitung"] {
        background-color: #ff4d6d;
        color: white;
        cursor: pointer;
        font-weight: bold;
        border-bottom: 4px solid #c9184a;
    }

    button[name="hitung"]:active {
        border-bottom: none;
        transform: translateY(4px);
    }

    /* Tombol Keberuntungan */
    button[name="random"] {
        background-color: #ffb703;
        color: #333;
        cursor: pointer;
        font-size: 14px;
        margin-top: 0;
    }

    .hasil-container {
        background: white;
        color: #df7979;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
        text-align: center;
    }

    .persen-cinta {
        font-size: 40px;
        margin: 10px 0;
        color: #ff4d6d;
    }

    .item-riwayat {
        border-bottom: 1px dashed #ccc;
        padding: 8px 0;
        color: #555;
        font-size: 14px;
    }
    </style>
</head>

<body>

    <div class="kalkulator">
        <h2 style="text-align: center; margin-bottom: 0;">💖 KALKULATOR CINTAH 💖</h2>
        <p style="text-align: center; font-size: 12px; margin-top: 5px;">Hitung angka, temukan cintamu!</p>

        <form method="POST">
            <button type="submit" name="random">🎲 Klik untuk Angka Keberuntungan</button>

            <?php 
                // Logika Angka Keberuntungan
                $val1 = isset($_POST['angka1']) ? $_POST['angka1'] : '';
                $val2 = isset($_POST['angka2']) ? $_POST['angka2'] : '';
                if(isset($_POST['random'])){
                    $val1 = rand(1, 100);
                    $val2 = rand(1, 100);
                }
            ?>

            <input type="number" name="angka1" placeholder="Angka Pertama" required value="<?= $val1 ?>">

            <select name="operasi">
                <option value="tambah"
                    <?= (isset($_POST['operasi']) && $_POST['operasi'] == 'tambah') ? 'selected' : '' ?>>Tambah (+)
                </option>
                <option value="kurang"
                    <?= (isset($_POST['operasi']) && $_POST['operasi'] == 'kurang') ? 'selected' : '' ?>>Kurang (-)
                </option>
                <option value="kali" <?= (isset($_POST['operasi']) && $_POST['operasi'] == 'kali') ? 'selected' : '' ?>>
                    Kali (x)</option>
                <option value="bagi" <?= (isset($_POST['operasi']) && $_POST['operasi'] == 'bagi') ? 'selected' : '' ?>>
                    Bagi (/)</option>
            </select>

            <input type="number" name="angka2" placeholder="Angka Kedua" required value="<?= $val2 ?>">

            <button type="submit" name="hitung">HITUNG SEKARANG! 🔥</button>
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            $a1 = $_POST['angka1'];
            $a2 = $_POST['angka2'];
            $op = $_POST['operasi'];
            
            // Perhitungan Matematika
            switch($op) {
                case 'tambah': $hasil = $a1 + $a2; $s = "+"; break;
                case 'kurang': $hasil = $a1 - $a2; $s = "-"; break;
                case 'kali':   $hasil = $a1 * $a2; $s = "x"; break;
                case 'bagi':   $hasil = ($a2 != 0) ? $a1 / $a2 : "Gagal Move On"; $s = "/"; break;
            }

            // Fitur Tambahan: Ramalan Cinta Acak
            $persen = rand(1, 100);
            
            // Simpan ke Riwayat
            if(is_numeric($hasil)) {
                if(!isset($_SESSION['r'])) $_SESSION['r'] = [];
                array_unshift($_SESSION['r'], "$a1 $s $a2 = $hasil (Cinta: $persen%)");
            }

            echo "<div class='hasil-container'>";
            echo "<b>Hasil Hitung:</b><br><span style='font-size: 24px;'>$hasil</span><br>";
            echo "<hr style='border: 1px dashed #df7979'>";
            echo "<b>Kadar Cintah Kamu:</b>";
            echo "<div class='persen-cinta'>$persen% ❤️</div>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="riwayat-box">
        <h3 style="margin:0; text-align:center;">📜 Memori Terakhir</h3>
        <hr>
        <?php if (!isset($_SESSION['r']) || empty($_SESSION['r'])): ?>
        <p style="text-align:center; color:#999;">Belum ada memori terukir...</p>
        <?php else: ?>
        <?php foreach (array_slice($_SESSION['r'], 0, 3) as $r): ?>
        <div class="item-riwayat">✨ <?= $r ?></div>
        <?php endforeach; ?>
        <p style="text-align:center;"><a href="?reset=1"
                style="color:red; text-decoration:none; font-size:12px;">Lupakan Semua</a></p>
        <?php endif; ?>
    </div>

</body>

</html>

<?php 
// Reset Riwayat
if(isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
}
?>