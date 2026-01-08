<?php 
session_start(); 

$nama_file = basename($_SERVER['PHP_SELF']);

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
                $a1 = $_POST['a1'] ?? 0;
                $a2 = $_POST['a2'] ?? 0;
                $a3 = $_POST['a3'] ?? 0;
                $a4 = $_POST['a4'] ?? 0;
                $a5 = $_POST['a5'] ?? 0;
                
                if(isset($_POST['random'])){
                    $a1 = rand(1, 50); $a2 = rand(1, 50); $a3 = rand(1, 50); $a4 = rand(1, 50); $a5 = rand(1, 50);
                }
            ?>

            <?php for($i=1; $i<=4; $i++): ?>
            <div class="baris-hitung">
                <input type="number" name="a<?= $i ?>" value="<?= ${"a$i"} ?>" required>
                <select name="op<?= $i ?>">
                    <option value="+" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '+') ? 'selected' : '' ?>>+
                    </option>
                    <option value="-" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '-') ? 'selected' : '' ?>>-
                    </option>
                    <option value="x" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == 'x') ? 'selected' : '' ?>>x
                    </option>
                    <option value="/" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '/') ? 'selected' : '' ?>>/
                    </option>
                </select>
            </div>
            <?php endfor; ?>

            <div class="baris-hitung">
                <input type="number" name="a5" value="<?= $a5 ?>" required>
                <span style="font-weight:bold; margin-left:10px;">= ?</span>
            </div>

            <button type="submit" name="hitung" class="btn-hitung">JALANKAN TAKDIR 🔥</button>
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            $ops = [$_POST['op1'] ?? '+', $_POST['op2'] ?? '+', $_POST['op3'] ?? '+', $_POST['op4'] ?? '+'];
            $nums = [$a1, $a2, $a3, $a4, $a5];
            $res = $nums[0];
            $error = false;

            for ($i = 0; $i < 4; $i++) {
                if ($ops[$i] == '+') $res += $nums[$i+1];
                elseif ($ops[$i] == '-') $res -= $nums[$i+1];
                elseif ($ops[$i] == 'x') $res *= $nums[$i+1];
                elseif ($ops[$i] == '/') {
                    if ($nums[$i+1] != 0) $res /= $nums[$i+1];
                    else { $error = true; break; }
                }
            }

            $final = $error ? "Eror (Pembagi 0)" : round($res, 2);
            $persen = rand(1, 100);

            echo "<div class='hasil-container'>";
            echo "<b>Hasil Rumus: $final</b><br>";
            if(!$error) {
                echo "<hr style='border: 0.5px solid #eee'>";
                echo "<b>Kecocokan: $persen% ❤️</b><br>";
            }
            echo "</div>";

            if(!isset($_SESSION['r'])) $_SESSION['r'] = [];
            $riwayat_teks = "$a1 {$ops[0]} $a2 {$ops[1]} $a3 {$ops[2]} $a4 {$ops[3]} $a5 = $final";
            array_unshift($_SESSION['r'], $riwayat_teks);
        }
        ?>
    </div>

    <?php if(!empty($_SESSION['r'])): ?>
    <div class="riwayat">
        <h4 style="margin: 0 0 10px 0; text-align: center;">📜 Memori Terakhir</h4>
        <?php foreach(array_slice($_SESSION['r'], 0, 3) as $row): ?>
        <div class="item-riwayat">✨ <?= $row ?></div>
        <?php endforeach; ?>
        <p style="text-align:center;"><a href="?reset=1"
                style="color:red; font-size:11px; text-decoration:none;">Lupakan Semua</a></p>
    </div>
    <?php endif; ?>

</body>

</html>