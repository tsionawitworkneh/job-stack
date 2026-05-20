<?php
session_start();
require_once '../config/db.php';


if ($_SESSION['user_role'] !== 'admin') {
    exit('Unauthorized');
}

if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    
    try {
        
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role = 'user'");
        $stmt->execute([$user_id]);
        
        header("Location: ../admin/admin_dashboard.php?tab=manage-users&status=deleted");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}