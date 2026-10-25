<?php
require_once __DIR__ . '/../includes/auth.php';
auth_require_admin();
$pageTitle = 'Dashboard';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
    <main class="admin-main">
      <div class="page-heading">
        <div>
          <p class="page-eyebrow">OVERVIEW</p>
          <h1>Dashboard</h1>
          <p class="page-subtitle">Welcome back, <?= htmlspecialchars((string) ($_SESSION['user_name'] ?? 'Administrator'), ENT_QUOTES, 'UTF-8') ?>.</p>
        </div>
        <div class="today-chip"><i class="bi bi-calendar3" aria-hidden="true"></i><?= date('l, F j, Y') ?></div>
      </div>
      <section class="dashboard-welcome" aria-label="Dashboard welcome">
        <div class="welcome-copy">
          <span class="welcome-icon"><i class="bi bi-stars" aria-hidden="true"></i></span>
          <p class="page-eyebrow">YOUR WORKSPACE</p>
          <h2>Your laundry shop,<br>all in one place.</h2>
          <p>Use the menu to manage appointments, services, machines, and devices.</p>
        </div>
        <div class="welcome-art" aria-hidden="true">
          <span class="art-orbit orbit-one"></span><span class="art-orbit orbit-two"></span>
          <i class="bi bi-droplet-fill drop drop-one"></i><i class="bi bi-droplet-fill drop drop-two"></i>
          <i class="bi bi-basket3-fill laundry-basket"></i>
          <span class="art-sparkle sparkle-one">✦</span><span class="art-sparkle sparkle-two">✧</span>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
