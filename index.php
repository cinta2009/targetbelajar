<?php session_start(); // Tetap butuh ini di paling atas untuk fitur riwayat ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kalkulator CINTAH PHP</title>
    <style>
    body {
        font-family: sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 50px;
        background: #81aae7ff;
    }

    .kalkulator {
        background: #df7979ff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        margin-bottom: 20px;
        color: white;
    }

    .riwayat-box {
        background: white;
        padding: 15px;
        border-radius: 10px;
        width: 300px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    input,
    select,
    button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        background-color: #ff00408a;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }

    button:hover {
        background-color: #c40033;
    }

    .hasil {
        background: #fff;
        padding: 15px;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        font-size: 22px;
        color: #df7979ff;
        margin-top: 10px;
        border: 2px dashed #df7979ff;
    }

    .item-riwayat {
        border-bottom: 1px solid #eee;
        padding: 8px 0;
        font-size: 14px;
        color: #333;
    }
    </style>
</head>

<body>

    <div class="kalkulator">
        <h2 style="text-align: center;">Kalkulator CINTAH</h2>

        <form method="POST">
            <input type="number" name="angka1" placeholder="Angka Pertama" required
                value="<?php echo isset($_POST['angka1']) ? $_POST['angka1'] : ''; ?>">

            <select name="operasi">
                <option value="tambah"
                    <?php if(isset($_POST['operasi']) && $_POST['operasi'] == 'tambah') echo 'selected'; ?>>Tambah (+)
                </option>
                <option value="kurang"
                    <?php if(isset($_POST['operasi']) && $_POST['operasi'] == 'kurang') echo 'selected'; ?>>Kurang (-)
                </option>
                <option value="kali"
                    <?php if(isset($_POST['operasi']) && $_POST['operasi'] == 'kali') echo 'selected'; ?>>Kali (x)
                </option>
                <option value="bagi"
                    <?php if(isset($_POST['operasi']) && $_POST['operasi'] == 'bagi') echo 'selected'; ?>>Bagi (/)
                </option>
            </select>

            <input type="number" name="angka2" placeholder="Angka Kedua" required
                value="<?php echo isset($_POST['angka2']) ? $_POST['angka2'] : ''; ?>">

            <button type="submit" name="hitung">HITUNG CINTAH!</button>
        </form>

        <?php
        // PHP LOGIKA DI DALAM KOTAK KALKULATOR
        if (isset($_POST['hitung'])) {
            $a1 = $_POST['angka1'];
            $a2 = $_POST['angka2'];
            $op = $_POST['operasi'];
            $hasil = 0;
            $s = "";

            if ($op == 'tambah') { $hasil = $a1 + $a2; $s = "+"; }
            elseif ($op == 'kurang') { $hasil = $a1 - $a2; $s = "-"; }
            elseif ($op == 'kali') { $hasil = $a1 * $a2; $s = "x"; }
            elseif ($op == 'bagi') {
                $hasil = ($a2 != 0) ? $a1 / $a2 : "Cinta Tak Terhingga (Error)";
                $s = "/";
            }

            // Simpan Riwayat
            if (is_numeric($hasil)) {
                if(!isset($_SESSION['r'])) $_SESSION['r'] = [];
                array_unshift($_SESSION['r'], "$a1 $s $a2 = $hasil");
            }

            // Cetak hasil langsung di dalam div
            echo "<div class='hasil'>Hasil: $hasil</div>";
        }
        ?>
    </div>

    <div class="riwayat-box">
        <h3 style="margin:0 0 10px 0; text-align:center;">Memori Cintah</h3>

        <?php if (!isset($_SESSION['r']) || empty($_SESSION['r'])): ?>
        <p style="text-align:center; color:#999;">Belum ada kenangan...</p>
        <?php else: ?>
        <?php foreach (array_slice($_SESSION['r'], 0, 5) as $baris): ?>
        <div class="item-riwayat">❤️ <?php echo $baris; ?></div>
        <?php endforeach; ?>
        <p style="text-align:center;"><a href="?reset=1" style="color:red; font-size:12px;">Hapus Kenangan</a></p>
        <?php endif; ?>

        <?php 
        // Logika Reset
        if(isset($_GET['reset'])) {
            unset($_SESSION['r']);
            echo "<script>window.location='index.php';</script>";
        }
        ?>
    </div>

</body>

</html>