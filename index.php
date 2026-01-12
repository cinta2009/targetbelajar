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
    <title>Modern To-Do List XL</title>
    <style>
    /* Gaya Dasar & Background */
    body {
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
    }

    /* Container Utama - Dibuat Lebih Besar */
    .container {
        background: #fff;
        width: 95%;
        max-width: 600px;
        /* Ukuran diperbesar dari 400px */
        padding: 3rem;
        /* Padding diperbesar */
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    h2 {
        text-align: center;
        color: #4a00e0;
        margin-bottom: 2rem;
        font-size: 2rem;
        /* Judul lebih besar */
    }

    form {
        display: flex;
        gap: 15px;
        margin-bottom: 2.5rem;
    }

    input[type="text"] {
        flex: 1;
        padding: 15px 20px;
        /* Input lebih tinggi */
        border: 2px solid #eee;
        border-radius: 12px;
        outline: none;
        font-size: 1.1rem;
        transition: all 0.3s;
    }

    input[type="text"]:focus {
        border-color: #764ba2;
        box-shadow: 0 0 10px rgba(118, 75, 162, 0.2);
    }

    button {
        padding: 15px 25px;
        background-color: #764ba2;
        color: white;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1rem;
        transition: all 0.3s;
        white-space: nowrap;
    }

    button:hover {
        background-color: #4a00e0;
        transform: translateY(-2px);
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        background: #fdfdfd;
        margin-bottom: 15px;
        padding: 18px 25px;
        /* List item lebih besar */
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 15px;
        border-left: 8px solid #764ba2;
        /* Garis samping lebih tebal */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
    }

    li:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    li span {
        font-size: 1.1rem;
        font-weight: 500;
        color: #444;
    }

    .delete-btn {
        color: #ff4d4d;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.95rem;
        padding: 8px 15px;
        border-radius: 8px;
        background: #fff0f0;
        transition: all 0.2s;
    }

    .delete-btn:hover {
        background: #ff4d4d;
        color: white;
    }

    .empty-msg {
        text-align: center;
        color: #888;
        font-style: italic;
        margin-top: 2rem;
        font-size: 1.1rem;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>Daftar Tugasmu 📝</h2>

        <form method="POST" action="">
            <input type="text" name="tugas" placeholder="Apa yang ingin kamu kerjakan sekarang?" required>
            <button type="submit" name="tambah">Tambah Tugasmu sayanggg</button>
        </form>

        <ul>
            <?php foreach ($_SESSION['todos'] as $index => $item): ?>
            <li>
                <span><?php echo $item; ?></span>
                <a href="?hapus=<?php echo $index; ?>" class="delete-btn"
                    onclick="return confirm('Hapus tugas ini mauu?')">Hapus ga</a>
            </li>
            <?php endforeach; ?>
        </ul>

        <?php if (empty($_SESSION['todos'])): ?>
        <p class="empty-msg">Belum ada tugas. Semangat ya hari ini guysss! ✨</p>
        <?php endif; ?>
    </div>

</body>

</html>