<?php
$activePage = basename((string) ($_SERVER['PHP_SELF'] ?? ''));
$sidebarLinks = [
    ['file' => 'dashboard.php', 'label' => 'Dashboard', 'icon' => 'bi-grid-1x2'],
    ['file' => 'appointments.php', 'label' => 'Appointments', 'icon' => 'bi-calendar-check'],
    ['file' => 'services.php', 'label' => 'Services', 'icon' => 'bi-basket2'],
    ['file' => 'machine_availability.php', 'label' => 'Machine Availability', 'icon' => 'bi-moisture'],
    ['file' => 'devices.php', 'label' => 'Devices', 'icon' => 'bi-cpu'],
];
?>
<aside class="admin-sidebar" id="admin-sidebar" aria-label="Admin navigation">
  <p class="sidebar-label">WORKSPACE</p>
  <nav class="sidebar-nav">
    <?php foreach ($sidebarLinks as $link): ?>
      <a class="sidebar-link<?= $activePage === $link['file'] ? ' is-active' : '' ?>" href="<?= htmlspecialchars($link['file'], ENT_QUOTES, 'UTF-8') ?>" title="<?= htmlspecialchars($link['label'], ENT_QUOTES, 'UTF-8') ?>"<?= $activePage === $link['file'] ? ' aria-current="page"' : '' ?>>
        <i class="bi <?= htmlspecialchars($link['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
        <span><?= htmlspecialchars($link['label'], ENT_QUOTES, 'UTF-8') ?></span>
        <?php if ($activePage === $link['file']): ?><i class="bi bi-chevron-right active-chevron" aria-hidden="true"></i><?php endif; ?>
      </a>
    <?php endforeach; ?>
  </nav>
  <div class="sidebar-note"><i class="bi bi-droplet-half" aria-hidden="true"></i><span>Keep things<br><strong>clean &amp; fresh.</strong></span></div>
</aside>
