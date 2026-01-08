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
    <title>Kalkulator CINTAH Super Pro</title>
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
        width: 400px;
        color: white;
        border: 4px solid #fff;
        margin-top: 10px;
    }

    .baris-hitung {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
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
        flex: 1.2;
        padding: 10px;
        border-radius: 10px;
        border: none;
        background: #ffecf0;
        font-weight: bold;
        cursor: pointer;
        font-size: 14px;
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
        margin-top: 15px;
        text-align: center;
    }

    .riwayat {
        background: rgba(255, 255, 255, 0.9);
        width: 400px;
        margin-top: 20px;
        padding: 15px;
        border-radius: 15px;
    }

    .item-riwayat {
        font-size: 12px;
        padding: 6px;
        border-bottom: 1px solid #eee;
        color: #333;
    }
    </style>
</head>

<body>

    <div class="kalkulator">
        <h2 style="text-align: center; margin: 0 0 10px 0;">💖 KALKULATOR CINTAHHHHHHHH 💖</h2>

        <form method="POST">
            <button type="submit" name="random" class="btn-random">🎲 Acak Angka & Takdir</button>

            <?php 
                $nums_val = [];
                for($i=1; $i<=5; $i++) {
                    if(isset($_POST['random'])) {
                        $nums_val[$i] = rand(1, 10); // Angka lebih kecil agar pangkat tidak meledak
                    } else {
                        $nums_val[$i] = $_POST["a$i"] ?? 0;
                    }
                }
            ?>

            <?php for($i=1; $i<=4; $i++): ?>
            <div class="baris-hitung">
                <input type="number" name="a<?= $i ?>" value="<?= $nums_val[$i] ?>" required>
                <select name="op<?= $i ?>">
                    <option value="+" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '+') ? 'selected' : '' ?>>+
                    </option>
                    <option value="-" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '-') ? 'selected' : '' ?>>-
                    </option>
                    <option value="x" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == 'x') ? 'selected' : '' ?>>x
                    </option>
                    <option value="/" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '/') ? 'selected' : '' ?>>/
                    </option>
                    <option value="%" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '%') ? 'selected' : '' ?>>Mod (%)
                    </option>
                    <option value="^" <?= (isset($_POST["op$i"]) && $_POST["op$i"] == '^') ? 'selected' : '' ?>>Pangkat
                        (^)</option>
                </select>
            </div>
            <?php endfor; ?>

            <div class="baris-hitung">
                <input type="number" name="a5" value="<?= $nums_val[5] ?>" required>
                <span style="font-weight:bold; margin-left:10px;">= ?</span>
            </div>

            <button type="submit" name="hitung" class="btn-hitung">HITUNG TAKDIR SUPER 🔥</button>
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            $ops = [$_POST['op1'] ?? '+', $_POST['op2'] ?? '+', $_POST['op3'] ?? '+', $_POST['op4'] ?? '+'];
            $nums = [$nums_val[1], $nums_val[2], $nums_val[3], $nums_val[4], $nums_val[5]];
            $res = $nums[0];
            $msg = "";

            for ($i = 0; $i < 4; $i++) {
                $next = $nums[$i+1];
                switch($ops[$i]) {
                    case '+': $res += $next; break;
                    case '-': $res -= $next; break;
                    case 'x': $res *= $next; break;
                    case '/': 
                        if($next != 0) $res /= $next; 
                        else { $msg = "Cinta Tak Terbagi (Div 0)"; }
                        break;
                    case '%':
                        if($next != 0) $res %= $next;
                        else { $msg = "Sisa Cinta Kosong (Mod 0)"; }
                        break;
                    case '^': $res = pow($res, $next); break;
                }
                if($msg != "") break;
            }

            $final = ($msg != "") ? $msg : round($res, 2);
            $persen = rand(1, 100);

            echo "<div class='hasil-container'>";
            echo "<b>Hasil Akhir: $final</b><br>";
            if($msg == "") echo "<b>Kecocokan Takdir: $persen% ❤️</b>";
            echo "</div>";

            if(!isset($_SESSION['r'])) $_SESSION['r'] = [];
            array_unshift($_SESSION['r'], "Hitung: $final ($persen%)");
        }
        ?>
    </div>

    <?php if(!empty($_SESSION['r'])): ?>
    <div class="riwayat">
        <h4 style="margin: 0; text-align: center;">📜 Memori Terakhir</h4>
        <?php foreach(array_slice($_SESSION['r'], 0, 3) as $row): ?>
        <div class="item-riwayat">✨ <?= $row ?></div>
        <?php endforeach; ?>
        <p style="text-align:center;"><a href="?reset=1" style="color:red; font-size:11px; text-decoration:none;">Hapus
                Memori</a></p>
    </div>
    <?php endif; ?>

</body>

</html>