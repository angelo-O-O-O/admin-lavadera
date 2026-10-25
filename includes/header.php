<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Admin panel';
}
$adminName = $_SESSION['user_name'] ?? 'Administrator';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#e8f0fb">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | Laundry Shop Admin</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/global.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-page">
<div class="admin-shell">
  <header class="admin-topbar">
    <div class="topbar-brand-group">
      <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-label="Expand sidebar" aria-expanded="false" aria-controls="admin-sidebar" title="Expand sidebar">
        <i class="bi bi-list" aria-hidden="true"></i>
      </button>
      <a class="topbar-brand" href="dashboard.php" aria-label="Laundry Shop admin home">
        <img src="../img/logo.jpg" alt="">
        <span>Laundry Shop <small>ADMIN PANEL</small></span>
      </a>
    </div>
    <div class="topbar-actions">
      <span class="admin-greeting"><i class="bi bi-person-circle" aria-hidden="true"></i> <?= htmlspecialchars((string) $adminName, ENT_QUOTES, 'UTF-8') ?></span>
      <button class="theme-toggle" type="button" data-theme-toggle aria-label="Switch to dark mode" aria-pressed="false" title="Switch to dark mode">
        <i class="bi bi-moon-stars-fill" aria-hidden="true"></i>
      </button>
      <form class="logout-form" method="post" action="logout.php">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(auth_csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
        <button class="logout-link" type="submit"><i class="bi bi-box-arrow-right" aria-hidden="true"></i><span>Sign out</span></button>
      </form>
    </div>
  </header>
  <div class="admin-body">
