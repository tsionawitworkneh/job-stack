<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: /job-stack/login.php?error=not_logged_in");
    exit();
}


if ($_SESSION['user_role'] !== 'user') {
    header("Location: /job-stack/admin/admin_dashboard.php");
    exit();
}