<?php
require_once __DIR__ . '/../includes/auth.php';
auth_require_admin();
$pageTitle = 'Services';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
    <main class="admin-main">
      <div class="page-heading">
        <div><p class="page-eyebrow">WORKSPACE</p><h1>Services</h1><p class="page-subtitle">Manage the services offered by your laundry shop.</p></div>
        <div class="today-chip"><i class="bi bi-calendar3" aria-hidden="true"></i><?= date('l, F j, Y') ?></div>
      </div>
      <section class="dashboard-welcome section-placeholder">
        <div class="welcome-copy">
          <span class="welcome-icon"><i class="bi bi-basket2" aria-hidden="true"></i></span>
          <p class="page-eyebrow">SERVICES</p>
          <h2>Your services will appear here.</h2>
          <p>This page is ready for your service management tools.</p>
        </div>
        <div class="welcome-art" aria-hidden="true"><i class="bi bi-droplet-half placeholder-art-icon"></i></div>
      </section>
    </main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
