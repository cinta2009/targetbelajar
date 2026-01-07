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
        $nama = "Budi Santoso";
        $status = "Aktif";
        $nama2 = "cintah";
        $status2 = "Aktif";
        
        echo "<p>Selamat datang, <b>$nama, $nama2</b>!</p>";
    ?>

    <div style="color: <?php echo ($status == 'Aktif'),($status2 == 'Aktif') ? 'green' : 'red'; ?>">
        Status akun Anda: <?php echo $status; ?> <?php echo $status2; ?>
    </div>

</body>

</html>