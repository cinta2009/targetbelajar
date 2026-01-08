<?php 
session_start(); 
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
    }

    .kalkulator {
        background: rgba(223, 121, 121, 0.9);
        backdrop-filter: blur(5px);
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        width: 350px;
        color: white;
        border: 4px solid #fff;
    }

    .riwayat-box {
        background: rgba(255, 255, 255, 0.9);
        padding: 15px;
        border-radius: 15px;
        width: 350px;
        margin-top: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    input,
    select,
    button {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: none;
        border-radius: 10px;
        box-sizing: border-box;
        font-size: 14px;
    }

    button[name="hitung"] {
        background-color: #ff4d6d;
        color: white;
        cursor: pointer;
        font-weight: bold;
        font-size: 18px;
        margin-top: 15px;
        border-bottom: 4px solid #c9184a;
    }

    button[name="random"] {
        background-color: #ffb703;
        color: #333;
        cursor: pointer;
        font-weight: bold;
    }

    .hasil-container {
        background: white;
        color: #df7979;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
        text-align: center;
    }

    .label-input {
        font-size: 12px;
        font-weight: bold;
        margin-left: 5px;
    }
    </style>
</head>

<body>

    <div class="kalkulator">
        <h2 style="text-align: center; margin-bottom: 5px;">💖 CINTAH PRO MAX 💖</h2>

        <form method="POST">
            <button type="submit" name="random">🎲 Acak Semua Angka</button>

            <?php 
                $a1 = $_POST['a1'] ?? '';
                $a2 = $_POST['a2'] ?? '';
                $a3 = $_POST['a3'] ?? '';
                $a4 = $_POST['a4'] ?? '';

                if(isset($_POST['random'])){
                    $a1 = rand(1, 100); $a2 = rand(1, 100);
                    $a3 = rand(1, 100); $a4 = rand(1, 100);
                }
            ?>

            <span class="label-input">Angka 1</span>
            <input type="number" name="a1" required value="<?= $a1 ?>">

            <select name="op">
                <option value="tambah" <?= (isset($_POST['op']) && $_POST['op'] == 'tambah') ? 'selected' : '' ?>>Tambah
                    (+)</option>
                <option value="kurang" <?= (isset($_POST['op']) && $_POST['op'] == 'kurang') ? 'selected' : '' ?>>Kurang
                    (-)</option>
                <option value="kali" <?= (isset($_POST['op']) && $_POST['op'] == 'kali') ? 'selected' : '' ?>>Kali (x)
                </option>
            </select>

            <span class="label-input">Angka 2</span>
            <input type="number" name="a2" required value="<?= $a2 ?>">

            <span class="label-input">Angka 3</span>
            <input type="number" name="a3" required value="<?= $a3 ?>">

            <span class="label-input">Angka 4</span>
            <input type="number" name="a4" required value="<?= $a4 ?>">

            <button type="submit" name="hitung">HITUNG SEMUA! 🔥</button>
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            $op = $_POST['op'];
            $res = 0;
            $s = ($op == 'tambah') ? "+" : (($op == 'kali') ? "x" : "-");

            if ($op == 'tambah') {
                $res = $a1 + $a2 + $a3 + $a4;
            } elseif ($op == 'kurang') {
                $res = $a1 - $a2 - $a3 - $a4;
            } elseif ($op == 'kali') {
                $res = $a1 * $a2 * $a3 * $a4;
            }

            $persen = rand(1, 100);
            
            if(!isset($_SESSION['r'])) $_SESSION['r'] = [];
            array_unshift($_SESSION['r'], "Hitung: $a1 $s $a2 $s $a3 $s $a4 = $res");

            echo "<div class='hasil-container'>";
            echo "<b>Total Hitung:</b><br><span style='font-size: 24px;'>$res</span><br>";
            echo "<b>Kecocokan: $persen% ❤️</b>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="riwayat-box">
        <h3 style="margin:0; text-align:center;">📜 Memori Angka</h3>
        <?php if (isset($_SESSION['r'])): ?>
        <?php foreach (array_slice($_SESSION['r'], 0, 3) as $r): ?>
        <div style="font-size: 12px; border-bottom: 1px solid #eee; padding: 5px;"><?= $r ?></div>
        <?php endforeach; ?>
        <p style="text-align:center;"><a href="?reset=1" style="color:red; text-decoration:none; font-size:10px;">Hapus
                Kenangan</a></p>
        <?php endif; ?>
    </div>

</body>

</html>

<?php 
if(isset($_GET['reset'])) { session_destroy(); header("Location: index.php"); }
?>