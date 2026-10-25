<?php
require_once __DIR__ . '/../includes/auth.php';
auth_require_admin();
$adminName = (string) ($_SESSION['user_name'] ?? 'Administrator');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="3;url=dashboard.php">
  <meta name="theme-color" content="#c6d8f0">
  <title>Signed in | Laundry Shop Admin</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/global.css">
  <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body class="auth-page">
  <main class="auth-shell container-fluid">
    <section class="auth-card auth-success-card" data-login-success data-dashboard-url="dashboard.php" role="status" aria-live="polite">
      <div class="success-check"><i class="bi bi-check-lg" aria-hidden="true"></i></div>
      <p class="auth-eyebrow">ADMINISTRATOR PORTAL</p>
      <h1>You're signed in</h1>
      <p class="auth-subtitle">Welcome, <?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8') ?>. Opening your dashboard now.</p>
      <div class="success-progress" aria-hidden="true"></div>
      <a class="success-fallback" href="dashboard.php">Continue to dashboard</a>
    </section>
  </main>
  <script src="../assets/js/auth.js" defer></script>
</body>
</html>
