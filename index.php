<?php
session_start();

// Inisialisasi daftar tugas jika belum ada
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Logika Menambah Tugas
if (isset($_POST['tambah']) && !empty($_POST['tugas'])) {
    $_SESSION['todos'][] = $_POST['tugas'];
}

// Logika Menghapus Tugas
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    unset($_SESSION['todos'][$id]);
    // Reset index array agar tetap rapi
    $_SESSION['todos'] = array_values($_SESSION['todos']);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>To-Do List</title>
</head>

<body>
    <h2>Daftar Tugas</h2>

    <form method="POST" action="">
        <input type="text" name="tugas" placeholder="Ketik tugas baru anda..." required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <ul>
        <?php foreach ($_SESSION['todos'] as $index => $item): ?>
        <li>
            <?php echo htmlspecialchars($item); ?>
            <a href="?hapus=<?php echo $index; ?>" style="color: red;">[Hapus]</a>
        </li>
        <?php endforeach; ?>
    </ul>

    <?php if (empty($_SESSION['todos'])): ?>
    <p>Belum ada tugas. Semangat yaaaa guyss!</p>
    <?php endif; ?>
</body>

</html>