<?php


session_start();
require_once '../config/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?error=unauthorized");
    exit();
}

$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_apply'])) {
    
    if (isset($_POST['job_id'])) {
        $job_id = $_POST['job_id'];

        try {
            
            $sql = "INSERT IGNORE INTO applications (user_id, job_id, status, applied_at) 
                    VALUES (?, ?, 'Pending', CURRENT_TIMESTAMP)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user_id, $job_id]);

            
            header("Location: ../user/dashboard.php?tab=applied-jobs&msg=applied_success");
            exit();

        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }
}


if (isset($_GET['save_id'])) {
    $job_id = $_GET['save_id'];

    try {
        
        $check_sql = "SELECT id FROM saved_jobs WHERE user_id = ? AND job_id = ?";
        $check_stmt = $pdo->prepare($check_sql);
        $check_stmt->execute([$user_id, $job_id]);
        $already_saved = $check_stmt->fetch();

        if ($already_saved) {
            
            $delete_sql = "DELETE FROM saved_jobs WHERE user_id = ? AND job_id = ?";
            $pdo->prepare($delete_sql)->execute([$user_id, $job_id]);
            $status_msg = "unsaved";
        } else {
            
            $insert_sql = "INSERT INTO saved_jobs (user_id, job_id) VALUES (?, ?)";
            $pdo->prepare($insert_sql)->execute([$user_id, $job_id]);
            $status_msg = "saved";
        }

        
        header("Location: ../user/dashboard.php?tab=find-jobs&status=" . $status_msg);
        exit();

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}


header("Location: ../user/dashboard.php");
exit();