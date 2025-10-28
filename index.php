<?php
// index.php
// Halaman utama: form pencarian sederhana dan hint pstd.

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>The Forgotten Parameter - Arsip Bank</title>
</head>
<body>
    <h1>Arsip Bank (situs kuno)</h1>
    <p>Ini salinan situs lama. Ada form pencarian sederhana di bawah — terlihat seperti fitur jadul.</p>

    <form method="get" action="index.php">
        <label for="q">Pencarian:</label>
        <input type="text" id="q" name="q" placeholder="cari nasabah..." />
        <input type="submit" value="Cari" />
    </form>

    <?php
    // Tampilkan hasil pencarian (sangat sederhana)
    if (isset($_GET['q']) && $_GET['q'] !== '') {
        echo "<p>Menampilkan hasil arsip untuk: <strong>" . htmlspecialchars($_GET['q']) . "</strong></p>";
        echo "<ul><li>Hasil terbatas — data diarsipkan.</li></ul>";
    }

    // Simulasikan "forgotten parameter" — kalau ada pstd, redirect ke admin
    if (isset($_GET['pstd'])) {
        // Redirect ke admin.php dengan pstd yang sama
        header('Location: admin.php?pstd=' . urlencode($_GET['pstd']));
        exit;
    }
    ?>

    <hr />
    <p><a href="login.php">Login Member</a></p>
    <p><em>Hint soal: coba parameter GET <code>pstd</code> — mungkin ada halaman tersembunyi.</em></p>
</body>
</html>
