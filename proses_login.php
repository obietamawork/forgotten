<?php
// proses_login.php (versi redirect admin)
// Setelah login, kalau username == 'admin' redirect ke admin.php?pstd=admin
session_start();
require 'config.php';

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

// Autentikasi sederhana 
$stmt = $pdo->prepare("SELECT id, username FROM users WHERE username = ? AND password = ? LIMIT 1");
$stmt->execute([$username, $password]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    // Jika user adalah admin, langsung redirect ke admin dengan pstd
    if ($user['username'] === 'admin') {
        header("Location: admin.php?pstd=admin");
        exit;
    }

    header("Location: member.php");
    exit;
} else {
    echo "<p>Login gagal. <a href='login.php'>Coba lagi</a>.</p>";
}
