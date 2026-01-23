<?php
// Ganti dengan API Key milikmu sendiri dari openweathermap.org jika ingin mencoba langsung
$apiKey = "YOUR_API_KEY_HERE";
$kota = isset($_POST['kota']) ? $_POST['kota'] : 'Jakarta';
$units = "metric"; // Agar suhu dalam Celcius

// URL API
$url = "https://api.openweathermap.org/data/2.5/weather?q={$kota}&units={$units}&appid={$apiKey}";

// Mengambil data dari API menggunakan file_get_contents
// Catatan: Pastikan 'allow_url_fopen' aktif di php.ini
$response = @file_get_contents($url);

$data = null;
if ($response) {
    $data = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cek Cuaca PHP</title>
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #e0f2f1;
        text-align: center;
        padding-top: 50px;
    }

    .card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    input {
        padding: 10px;
        border: 1px solid #f89696;
        border-radius: 5px;
    }

    button {
        padding: 10px 20px;
        background: #00796b;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .info {
        margin-top: 20px;
    }

    .temp {
        font-size: 40px;
        font-weight: bold;
        color: #333;
    }
    </style>
</head>

<body>

    <div class="card">
        <h2>Cek Cuaca Real-Time</h2>
        <form method="POST">
            <input type="text" name="kota" placeholder="Masukkan nama kota..." required>
            <button type="submit">Cari</button>
        </form>

        <div class="info">
            <?php if ($data && $data['cod'] == 200): ?>
            <h3><?php echo $data['name']; ?>, <?php echo $data['sys']['country']; ?></h3>
            <div class="temp"><?php echo round($data['main']['temp']); ?>°C</div>
            <p>Kondisi: <?php echo ucfirst($data['weather'][0]['description']); ?></p>
            <p>Kelembapan: <?php echo $data['main']['humidity']; ?>%</p>
            <?php else: ?>
            <p style="color: red;">Kota tidak ditemukan atau API Key belum diisi.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>