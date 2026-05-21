<?php

session_start();
require_once '../config/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_apply'])) {
    $job_id = $_POST['job_id'];

    try {
        
        $check = $pdo->prepare("SELECT id FROM applications WHERE user_id = ? AND job_id = ?");
        $check->execute([$user_id, $job_id]);

        if (!$check->fetch()) {
            
            $sql = "INSERT INTO applications (user_id, job_id, status) VALUES (?, ?, 'Pending')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user_id, $job_id]);
            $msg = "success";
        } else {
            $msg = "already_applied";
        }

        
        header("Location: ../user/dashboard.php?tab=applied-jobs&msg=" . $msg);
        exit();

    } catch (PDOException $e) {
        // If there's an error, this will show it instead of just redirecting
        die("Critical Database Error: " . $e->getMessage());
    }
}


if (isset($_GET['save_id'])) {
    $job_id = $_GET['save_id'];

    try {
        $check = $pdo->prepare("SELECT id FROM saved_jobs WHERE user_id = ? AND job_id = ?");
        $check->execute([$user_id, $job_id]);

        if ($check->fetch()) {
            
            $pdo->prepare("DELETE FROM saved_jobs WHERE user_id = ? AND job_id = ?")->execute([$user_id, $job_id]);
        } else {
            
            $pdo->prepare("INSERT INTO saved_jobs (user_id, job_id) VALUES (?, ?)")->execute([$user_id, $job_id]);
        }

        header("Location: ../user/dashboard.php?tab=find-jobs");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}


header("Location: ../user/dashboard.php");
exit();