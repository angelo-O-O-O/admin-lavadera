<?php
require_once __DIR__ . '/../includes/auth.php';

$token = (string) ($_POST['csrf_token'] ?? '');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['auth_csrf_token'])
    && hash_equals($_SESSION['auth_csrf_token'], $token)) {
    auth_logout();
}

header('Location: ../index.php');
exit;
