<?php
session_start();
require_once '../config/db.php';

// 1. HANDLE DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM jobs WHERE id = ?")->execute([$id]);
    header("Location: ../admin/admin_dashboard.php?tab=manage-jobs");
    exit();
}

// 2. HANDLE ADD & EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title    = $_POST['title'];
    $company  = $_POST['company'];
    $location = $_POST['location'];
    $type     = $_POST['type'];
    $salary   = $_POST['salary'];
    $desc     = $_POST['description'];
    $reqs     = $_POST['requirements'];

    if (isset($_POST['add_job'])) {
    
        $sql = "INSERT INTO jobs (title, company, location, type, description, requirements, salary) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $company, $location, $type, $desc, $reqs, $salary]);
    } 
    
    elseif (isset($_POST['edit_job'])) {
        
        $job_id = $_POST['job_id'];
        $sql = "UPDATE jobs SET title=?, company=?, location=?, type=?, description=?, requirements=?, salary=? 
                WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $company, $location, $type, $desc, $reqs, $salary, $job_id]);
    }

    header("Location: ../admin/admin_dashboard.php?tab=manage-jobs&status=success");
    exit();
}