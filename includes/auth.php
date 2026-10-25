<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../config/dbcon.php';

function auth_is_admin(): bool
{
    return isset($_SESSION['user_id'], $_SESSION['user_role'])
        && $_SESSION['user_role'] === 'admin';
}

function auth_require_admin(): void
{
    if (!auth_is_admin()) {
        $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
        $basePath = dirname(dirname($scriptName));
        if ($basePath === '/' || $basePath === '.') {
            $basePath = '';
        }
        header('Location: ' . $basePath . '/index.php');
        exit;
    }
}

function auth_csrf_token(): string
{
    if (empty($_SESSION['auth_csrf_token'])) {
        $_SESSION['auth_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['auth_csrf_token'];
}

function auth_attempt_login(mysqli $conn, string $email, string $password): bool
{
    $statement = $conn->prepare(
        "SELECT user_id, full_name, email, password_hash, role, is_active
         FROM users
         WHERE email = ? AND login_type = 'local'
         LIMIT 1"
    );
    if (!$statement) {
        return false;
    }
    $statement->bind_param('s', $email);
    $statement->execute();
    $statement->bind_result($userId, $fullName, $userEmail, $passwordHash, $role, $isActive);
    $found = $statement->fetch();
    $statement->close();

    if (!$found || (int) $isActive !== 1 || $role !== 'admin'
        || empty($passwordHash) || !password_verify($password, $passwordHash)) {
        return false;
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = (int) $userId;
    $_SESSION['user_name'] = $fullName;
    $_SESSION['user_email'] = $userEmail;
    $_SESSION['user_role'] = $role;
    unset($_SESSION['auth_csrf_token']);
    return true;
}

function auth_logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}
