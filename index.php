<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kalkulator PHP Sederhana</title>
    <style>
    body {
        font-family: sans-serif;
        display: flex;
        justify-content: center;
        padding-top: 50px;
        background: #165ac0ff;
    }

    .kalkulator {
        background: #c51313ff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
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
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }

    .hasil {
        background: #e9ecef;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        font-size: 20px;
        color: #333;
    }
    </style>
</head>

<body>

    <div class="kalkulator">
        <h2 style="text-align: center;">Kalkulator</h2>

        <form method="POST">
            <input type="number" name="angka1" placeholder="Masukkan angka pertama" required
                value="<?= $_POST['angka1'] ?? '' ?>">

            <select name="operasi">
                <option value="tambah">+</option>
                <option value="kurang">-</option>
                <option value="kali">x</option>
                <option value="bagi">/</option>
            </select>

            <input type="number" name="angka2" placeholder="Masukkan angka kedua" required
                value="<?= $_POST['angka2'] ?? '' ?>">

            <button type="submit" name="hitung">Hitung</button>
        </form>

        <?php
    // Logika PHP berada di dalam sini
    if (isset($_POST['hitung'])) {
        $a1 = $_POST['angka1'];
        $a2 = $_POST['angka2'];
        $op = $_POST['operasi'];
        $hasil = 0;

        if ($op == 'tambah') {
            $hasil = $a1 + $a2;
        } elseif ($op == 'kurang') {
            $hasil = $a1 - $a2;
        } elseif ($op == 'kali') {
            $hasil = $a1 * $a2;
        } elseif ($op == 'bagi') {
            if ($a2 != 0) {
                $hasil = $a1 / $a2;
            } else {
                $hasil = "Error (Pembagi 0)";
            }
        }

        echo "<div class='hasil'>Hasil: $hasil</div>";
    }
    ?>
    </div>

</body>

</html>