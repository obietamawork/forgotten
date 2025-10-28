<?php
// config.php
// Konfigurasi koneksi database.
// Ubah sesuai kredensial hostingmu bila perlu.

$db_host = 'localhost';
$db_name = 'forgotten';
$db_user = 'root';
$db_pass = '';

try {
    // Membuat objek PDO untuk akses database
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    // Jika gagal koneksi, tampilkan pesan dan hentikan eksekusi
    die("Koneksi DB gagal: " . $e->getMessage());
}
