<?php
// member.php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT username, saldo FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Area Member</title></head>
<body>
    <h2>Area Member</h2>
    <p>Hai, <?php echo htmlspecialchars($user['username']); ?>!</p>
    <p>Saldo kamu: <strong><?php echo htmlspecialchars($user['saldo']); ?></strong> credits</p>

    <p>Ini situs arsip — fitur terbatas. Jika penasaran, cek parameter tersembunyi di halaman utama.</p>

    <p><a href="index.php">Beranda</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
