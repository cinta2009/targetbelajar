<?php 
session_start(); 

// Otomatis mendeteksi nama file agar fitur reset lancar
$nama_file = basename($_SERVER['PHP_SELF']);

// Fitur Lupakan Kenangan (Reset)
if(isset($_GET['reset'])) { 
    session_destroy(); 
    header("Location: " . $nama_file); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kalkulator CINTAH Pro Max</title>
    <style>
    body {
        font-family: 'Comic Sans MS', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        /* Wallpaper Estetik Love */
        background-image: url('https://images.unsplash.com/photo-1518199266791-5375a83190b7?q=80&w=1470&auto=format&fit=crop');
        background-size: cover;
        background-attachment: fixed;
        margin: 0;
    }

    .kalkulator {
        background: rgba(223, 121, 121, 0.95);
        backdrop-filter: blur(8px);
        padding: 25px;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 380px;
        color: white;
        border: 4px solid #fff;
        margin-top: 20px;
    }

    .baris-hitung {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    input {
        flex: 2;
        padding: 10px;
        border-radius: 10px;
        border: none;
        font-size: 16px;
        outline: none;
    }

    select {
        flex: 1;
        padding: 10px;
        border-radius: 10px;
        border: none;
        background: #ffecf0;
        font-weight: bold;
        cursor: pointer;
        outline: none;
    }

    button {
        width: 100%;
        padding: 15px;
        margin-top: 10px;
        border-radius: 15px;
        border: none;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        transition: 0.3s;
    }

    .btn-hitung {
        background: #ff4d6d;
        color: white;
        border-bottom: 4px solid #c9184a;
    }

    .btn-hitung:active {
        transform: translateY(4px);
        border-bottom: none;
    }

    .btn-random {
        background: #ffb703;
        color: #333;
        margin-bottom: 15px;
    }

    .hasil-container {
        background: white;
        color: #df7979;
        padding: 15px;
        border-radius: 15px;
        margin-top: 20px;
        text-align: center;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .riwayat {
        background: rgba(255, 255, 255, 0.9);
        width: 380px;
        margin-top: 20px;
        padding: 15px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .item-riwayat {
        font-size: 13px;
        padding: 8px;
        border-bottom: 1px solid #eee;
        color: #333;
    }
    </style>
</head>

<body>

    <div class="kalkulator">
        <h2 style="text-align: center; margin-top: 0;">💖 RUMUS CINTAH 💖</h2>

        <form method="POST">
            <button type="submit" name="random" class="btn-random">🎲 Acak Angka & Takdir</button>

            <?php 
                // Mengambil angka atau memberikan nilai default agar tidak error
                $a1 = $_POST['a1'] ?? 0;
                $a2 = $_POST['a2'] ?? 0;
                $a3 = $_POST['a3'] ?? 0;
                $a4 = $_POST['a4'] ?? 0;
                $a5 = $_POST['a5'] ?? 0;
                
                // Jika tombol acak ditekan
                if(isset($_POST['random'])){
                    $a1 = rand(1, 50); $a2 = rand(1, 50); $a3 = rand(1, 50); $a4 = rand(1, 50); $a5 = rand(1, 50);
                }
            ?>

            <div class="baris-hitung">
                <input type="number" name="a1" value="<?= $a1 ?>" required>
                <select name="op1">
                    <option value="+" <?= (isset($_POST['op1']) && $_POST['op1'] == '+') ? 'selected' : '' ?>>+</option>
                    <option value="-" <?= (isset($_POST['op1']) && $_POST['op1'] == '-') ? 'selected' : '' ?>>-</option>
                    <option value="x" <?= (isset($_POST['op1']) && $_POST['op1'] == 'x') ? 'selected' : '' ?>>x</option>
                </select>
            </div>

            <div class="baris-hitung">
                <input type="number" name="a2" value="<?= $a2 ?>" required>
                <select name="op2">
                    <option value="+" <?= (isset($_POST['op2']) && $_POST['op2'] == '+') ? 'selected' : '' ?>>+</option>
                    <option value="-" <?= (isset($_POST['op2']) && $_POST['op2'] == '-') ? 'selected' : '' ?>>-</option>
                    <option value="x" <?= (isset($_POST['op2']) && $_POST['op2'] == 'x') ? 'selected' : '' ?>>x</option>
                </select>
            </div>

            <div class="baris-hitung">
                <input type="number" name="a3" value="<?= $a3 ?>" required>
                <select name="op3">
                    <option value="+" <?= (isset($_POST['op3']) && $_POST['op3'] == '+') ? 'selected' : '' ?>>+</option>
                    <option value="-" <?= (isset($_POST['op3']) && $_POST['op3'] == '-') ? 'selected' : '' ?>>-</option>
                    <option value="x" <?= (isset($_POST['op3']) && $_POST['op3'] == 'x') ? 'selected' : '' ?>>x</option>
                </select>
            </div>

            <div class="baris-hitung">
                <input type="number" name="a4" value="<?= $a4 ?>" required>
                <select name="op4">
                    <option value="+" <?= (isset($_POST['op4']) && $_POST['op4'] == '+') ? 'selected' : '' ?>>+</option>
                    <option value="-" <?= (isset($_POST['op4']) && $_POST['op4'] == '-') ? 'selected' : '' ?>>-</option>
                    <option value="x" <?= (isset($_POST['op4']) && $_POST['op4'] == 'x') ? 'selected' : '' ?>>x</option>
                </select>
            </div>

            <div class="baris-hitung">
                <input type="number" name="a5" value="<?= $a5 ?>" required>
                <span style="font-weight:bold; margin-left:10px;">= ?</span>
            </div>

            <button type="submit" name="hitung" class="btn-hitung">JALANKAN TAKDIR 🔥</button>
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            // Pengaman Undefined Key menggunakan ??
            $op1 = $_POST['op1'] ?? '+';
            $op2 = $_POST['op2'] ?? '+';
            $op3 = $_POST['op3'] ?? '+';
            $op4 = $_POST['op4'] ?? '+';

            // Proses Hitung Berantai
            if($op1 == '+') $step1 = $a1 + $a2; elseif($op1 == '-') $step1 = $a1 - $a2; else $step1 = $a1 * $a2;
            if($op2 == '+') $step2 = $step1 + $a3; elseif($op2 == '-') $step2 = $step1 - $a3; else $step2 = $step1 * $a3;
            if($op3 == '+') $step3 = $step2 + $a4; elseif($op3 == '-') $step3 = $step2 - $a4; else $step3 = $step2 * $a4;
            if($op4 == '+') $final = $step3 + $a5; elseif($op4 == '-') $final = $step3 - $a5; else $final = $step3 * $a5;

            $persen = rand(1, 100);
            $kalimat = ($persen > 70) ? "Wah, Berjodoh!" : (($persen > 40) ? "Lumayan Lah.." : "Coba Hitung Lagi..");

            echo "<div class='hasil-container'>";
            echo "<b>Hasil Rumus: $final</b><br>";
            echo "<hr style='border: 0.5px solid #eee'>";
            echo "<b>Kecocokan: $persen% ❤️</b><br>";
            echo "<i>\"$kalimat\"</i>";
            echo "</div>";

            // Simpan Riwayat
            if(!isset($_SESSION['r'])) $_SESSION['r'] = [];
            array_unshift($_SESSION['r'], "$a1 $op1 $a2 $op2 $a3 $op3 $a4 $op4 $a5 = $final ($persen%)");
        }
        ?>
    </div>

    <?php if(isset($_SESSION['r']) && !empty($_SESSION['r'])): ?>
    <div class="riwayat">
        <h4 style="margin: 0 0 10px 0; text-align: center;">📜 Memori Terakhir</h4>
        <?php foreach(array_slice($_SESSION['r'], 0, 3) as $row): ?>
        <div class="item-riwayat">✨ <?= $row ?></div>
        <?php endforeach; ?>
        <p style="text-align:center;"><a href="?reset=1"
                style="color:red; font-size:11px; text-decoration:none;">Lupakan Semua Kenangan</a></p>
    </div>
    <?php endif; ?>

</body>

</html>