<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['user_name'] = $admin['fullname'];
        $_SESSION['user_role'] = $admin['role'];

        header("Location: ../admin/admin_dashboard.php");
        exit();
    } else {
        header("Location: ../admin/admin_login.php?error=access_denied");
        exit();
    }
}