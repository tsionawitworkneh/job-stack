<?php
session_start();
require_once '../config/db.php';

// Only Admin access
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    exit('Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['app_id'])) {
    $id = $_POST['app_id'];
    $status = $_POST['new_status'];

    try {
        $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);

        header("Location: ../admin/admin_dashboard.php?tab=job-applications&update=success");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../admin/admin_dashboard.php?tab=job-applications&update=error");
    exit();
}