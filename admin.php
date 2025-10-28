<?php
// admin.php
// Halaman admin yang hanya boleh diakses jika parameter GET pstd=admin
session_start();
require 'config.php';

// Periksa parameter tersembunyi
if (!isset($_GET['pstd']) || $_GET['pstd'] !== 'admin') {
    header("HTTP/1.0 403 Forbidden");
    echo "<h1>403 Forbidden</h1><p>Halaman tidak ditemukan.</p>";
    exit;
}

// Flag simulasi
$flag = "CTF{forgotten_parameter_pstd}";

$msg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['target']) && isset($_POST['amount'])) {
    $target = $_POST['target'];
    $amount = (int)$_POST['amount'];

    // Ambil user target
    $stmt = $pdo->prepare("SELECT id, saldo FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$target]);
    $u = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$u) {
        $msg = "Pengguna target tidak ditemukan.";
    } else {
        // Kurangi saldo tanpa validasi tambahan (sengaja untuk simulasi exploit)
        $newbal = $u['saldo'] - $amount;
        $update = $pdo->prepare("UPDATE users SET saldo = ? WHERE id = ?");
        $update->execute([$newbal, $u['id']]);
        $msg = "Berhasil mengambil {$amount} dari {$target}. Saldo baru: {$newbal}";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Panel Admin</title></head>
<body>
    <h1>Panel Admin Bank (Arsip)</h1>
    <p><strong>Flag:</strong> <?php echo htmlspecialchars($flag); ?></p>

    <h3>Force-transfer (override admin)</h3>
    <form method="post" action="admin.php?pstd=admin">
        <label>Target username: <input name="target" required></label><br>
        <label>Jumlah yang diambil (Rupiah): <input name="amount" type="number" value="100" required></label><br>
        <input type="submit" value="Eksekusi">
    </form>

    <?php if ($msg) echo "<p><em>" . htmlspecialchars($msg) . "</em></p>"; ?>

    <h3>Daftar pengguna & saldo</h3>
    <ul>
    <?php
    $stmt = $pdo->query("SELECT username, saldo FROM users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . htmlspecialchars($row['username']) . " - " . htmlspecialchars($row['saldo']) . "</li>";
    }
    ?>
    </ul>

    <p><a href="index.php">Beranda</a></p>
</body>
</html>
