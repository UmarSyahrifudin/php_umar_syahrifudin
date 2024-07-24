<?php
session_start();

// Inisialisasi variabel session
if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}

// Proses input dan increment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_SESSION['step']) {
        case 1:
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['step']++;
            break;
        case 2:
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['step']++;
            break;
        case 3:
            $_SESSION['hobby'] = $_POST['hobby'];
            $_SESSION['step']++;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Biodata</title>
</head>
<body>
    <?php if ($_SESSION['step'] == 1): ?>
        <form method="post" action="soal2.php">
            <label for="name">Nama Anda:</label>
            <input type="text" id="name" name="name" required><br><br>
            <input type="submit" value="Submit">
        </form>
    <?php elseif ($_SESSION['step'] == 2): ?>
        <form method="post" action="soal2.php">
            <label for="age">Umur Anda:</label>
            <input type="number" id="age" name="age" required><br><br>
            <input type="submit" value="Submit">
        </form>
    <?php elseif ($_SESSION['step'] == 3): ?>
        <form method="post" action="soal2.php">
            <label for="hobby">Hobi Anda:</label>
            <input type="text" id="hobby" name="hobby" required><br><br>
            <input type="submit" value="Submit">
        </form>
    <?php else: ?>
        <h3>Hasil Input:</h3>
        <p>Nama: <?php echo htmlspecialchars($_SESSION['name']); ?></p>
        <p>Umur: <?php echo htmlspecialchars($_SESSION['age']); ?></p>
        <p>Hobi: <?php echo htmlspecialchars($_SESSION['hobby']); ?></p>
        <?php session_destroy(); // Reset session setelah menampilkan hasil ?>
    <?php endif; ?>
</body>
</html>
