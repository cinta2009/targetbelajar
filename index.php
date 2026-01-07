<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Halaman Profil</h1>

    <?php
        // PHP berada di dalam elemen HTML
        $nama = "Budi Santoso";
        $status = "Aktif";
        
        echo "<p>Selamat datang, <b>$nama</b>!</p>";
    ?>

    <div style="color: <?php echo ($status == 'Aktif') ? 'green' : 'red'; ?>">
        Status akun Anda: <?php echo $status; ?>
    </div>

</body>

</html>