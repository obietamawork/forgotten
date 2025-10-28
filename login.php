<?php
// login.php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Login Member</title></head>
<body>
    <h2>Login Member</h2>
    <form method="post" action="proses_login.php">
        <label>Username: <input name="username" required></label><br>
        <label>Password: <input name="password" type="password" required></label><br>
        <input type="submit" value="Masuk">
    </form>
    <p><a href="index.php">Kembali</a></p>
</body>
</html>
