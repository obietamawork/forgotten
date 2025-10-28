<?php
// proses_transfer.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['target']) || !isset($_POST['amount'])) {
    header("Location: admin.php?pstd=admin");
    exit;
}

$target = $_POST['target'];
$amount = (int)$_POST['amount'];

// Ambil user target
$stmt = $pdo->prepare("SELECT id, saldo FROM users WHERE username = ? LIMIT 1");
$stmt->execute([$target]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$u) {
    $_SESSION['msg'] = "Pengguna target tidak ditemukan.";
    header("Location: admin.php?pstd=admin");
    exit;
}

$newbal = $u['saldo'] - $amount;
$update = $pdo->prepare("UPDATE users SET saldo = ? WHERE id = ?");
$update->execute([$newbal, $u['id']]);

$_SESSION['msg'] = "Berhasil mengambil {$amount} dari {$target}. Saldo baru: {$newbal}";
header("Location: admin.php?pstd=admin");
