<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';

if (auth_is_admin()) {
    header('Location: pages/dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedToken = (string) ($_POST['csrf_token'] ?? '');
    if (!hash_equals(auth_csrf_token(), $postedToken)) {
        $error = 'Your session expired. Please try again.';
    } elseif (!isset($conn) || !($conn instanceof mysqli) || $conn->connect_errno) {
        $error = 'The sign-in service is temporarily unavailable. Please try again later.';
    } else {
        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && $password !== ''
            && auth_attempt_login($conn, $email, $password)) {
            header('Location: pages/login_success.php');
            exit;
        }
        $error = 'The email or password is incorrect, or this account does not have admin access.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#c6d8f0">
  <title>Admin sign in | Laundry Shop</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/global.css">
  <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body class="auth-page">
  <main class="auth-shell container-fluid">
    <section class="auth-card" aria-labelledby="auth-title">
      <div class="auth-brand-mark"><img src="img/logo.jpg" alt="Laundry Shop logo"></div>
      <p class="auth-eyebrow">ADMINISTRATOR PORTAL</p>
      <h1 id="auth-title">Welcome back</h1>
      <p class="auth-subtitle">Sign in to manage your laundry shop.</p>

      <?php if ($error !== ''): ?>
        <div class="alert alert-danger auth-alert" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
      <?php endif; ?>

      <form method="post" action="index.php" class="auth-form" autocomplete="on">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(auth_csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <div class="auth-input-wrap">
            <i class="bi bi-envelope" aria-hidden="true"></i>
            <input class="form-control" id="email" name="email" type="email" placeholder="admin@example.com" autocomplete="username" required value="<?= htmlspecialchars((string) ($_POST['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
          </div>
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <div class="auth-input-wrap auth-password-wrap">
            <i class="bi bi-lock" aria-hidden="true"></i>
            <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" autocomplete="current-password" required>
            <button class="password-toggle" type="button" aria-label="Show password" aria-pressed="false" data-password-toggle><i class="bi bi-eye" aria-hidden="true"></i></button>
          </div>
        </div>
        <button class="btn auth-submit w-100" type="submit">Sign in <i class="bi bi-arrow-right-short" aria-hidden="true"></i></button>
      </form>
      <p class="auth-footer"><i class="bi bi-shield-lock" aria-hidden="true"></i> Secure access for authorized administrators</p>
    </section>
    <aside class="auth-side-note" aria-hidden="true"><span class="bubble bubble-one"></span><span class="bubble bubble-two"></span><span class="bubble bubble-three"></span><p>Clean &amp; fresh,<br><strong>every day.</strong></p></aside>
  </main>
  <script src="assets/js/auth.js" defer></script>
</body>
</html>
