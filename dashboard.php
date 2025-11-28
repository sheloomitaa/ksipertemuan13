<?php
require 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// ambil data user terbaru (termasuk last_login)
$stmt = $pdo->prepare("SELECT username,email,role,last_login,created_at FROM users WHERE email = ?");
$stmt->execute([$_SESSION['email']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Dashboard - Sistem</title>
<style>
:root{--cream:#f5e9da;--light:#fffaf2;--dark:#5a3e2b;--mid:#8b5e3c}
*{box-sizing:border-box;font-family:Arial, Helvetica, sans-serif}
body{background:var(--cream);margin:0;color:var(--dark)}
.header{background:var(--dark);color:var(--cream);padding:18px;text-align:center}
.container{max-width:900px;margin:30px auto;background:var(--light);padding:24px;border-radius:10px;box-shadow:0 8px 20px rgba(0,0,0,0.06)}
h2{margin-top:0}
.info{display:flex;gap:18px;flex-wrap:wrap}
.card{flex:1;min-width:220px;background:#fff;padding:14px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.04)}
a.btn{display:inline-block;padding:8px 12px;background:var(--mid);color:#fff;border-radius:8px;text-decoration:none}
a.btn:hover{background:#a67b5b}
</style>
</head>
<body>
<div class="header">
    <h1>Dashboard Pengguna</h1>
    <p>Halo, <?= htmlspecialchars($_SESSION['username']); ?> — <small><?= htmlspecialchars($_SESSION['role']); ?></small></p>
</div>

<div class="container">
    <h2>Informasi Akun</h2>
    <div class="info">
        <div class="card">
            <strong>Username</strong>
            <div><?= htmlspecialchars($user['username'] ?? $_SESSION['username']); ?></div>
        </div>
        <div class="card">
            <strong>Email</strong>
            <div><?= htmlspecialchars($user['email'] ?? $_SESSION['email']); ?></div>
        </div>
        <div class="card">
            <strong>Terakhir Login</strong>
            <div><?= (!empty($user['last_login']) ? date('d M Y, H:i:s', strtotime($user['last_login'])) : 'Belum Pernah Login'); ?></div>
        </div>
        <div class="card">
            <strong>Terdaftar Sejak</strong>
            <div><?= (!empty($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : '-'); ?></div>
        </div>
    </div>

    <div style="margin-top:20px;">
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a class="btn" href="admin.php">Buka Admin Panel</a>
        <?php endif; ?>
        <a class="btn" href="profil.php">Lihat Profil</a>
        <a class="btn" href="logout.php">Logout</a>
    </div>
</div>
</body>
</html>
