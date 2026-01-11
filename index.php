<?php
session_start();

if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Logika Menambah Tugas
if (isset($_POST['tambah']) && !empty(trim($_POST['tugas']))) {
    $_SESSION['todos'][] = htmlspecialchars($_POST['tugas']);
}

// Logika Menghapus Tugas
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if (isset($_SESSION['todos'][$id])) {
        unset($_SESSION['todos'][$id]);
        $_SESSION['todos'] = array_values($_SESSION['todos']);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern To-Do List</title>
    <style>
    /* Gaya Dasar & Background */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        height: 100 vh;
        margin: 5;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
    }

    /* Container Utama */
    .container {
        background: #fff;
        width: 90%;
        max-width: 400px;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    h2 {
        text-align: center;
        color: #4a00e0;
        margin-bottom: 1.5rem;
    }

    /* Form Input */
    form {
        display: flex;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    input[type="text"] {
        flex: 1;
        padding: 10px;
        border: 2px solid #ddd;
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus {
        border-color: #764ba2;
    }

    button {
        padding: 10px 15px;
        background-color: #764ba2;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s;
    }

    button:hover {
        background-color: #4a00e0;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        background: #f9f9f9;
        margin-bottom: 10px;
        padding: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 8px;
        border-left: 5px solid #764ba2;
        transition: transform 0.2s;
    }

    li:hover {
        transform: scale(1.02);
    }

    .delete-btn {
        color: #ff4d4d;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.9rem;
        padding: 5px 8px;
        border-radius: 5px;
    }

    .delete-btn:hover {
        background: #fff0f0;
    }

    .empty-msg {
        text-align: center;
        color: #888;
        font-style: italic;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>Daftar Tugas 📝</h2>

        <form method="POST" action="">
            <input type="text" name="tugas" placeholder="Tambah tugas baru..." required>
            <button type="submit" name="tambah">Tambah yaaa</button>
        </form>

        <ul>
            <?php foreach ($_SESSION['todos'] as $index => $item): ?>
            <li>
                <span><?php echo $item; ?></span>
                <a href="?hapus=<?php echo $index; ?>" class="delete-btn"
                    onclick="return confirm('Hapus tugas ini mau?')">Hapus</a>
            </li>
            <?php endforeach; ?>
        </ul>

        <?php if (empty($_SESSION['todos'])): ?>
        <p class="empty-msg">Belum ada tugas, Semangat yaaaaa guyssssss!</p>
        <?php endif; ?>
    </div>

</body>

</html>