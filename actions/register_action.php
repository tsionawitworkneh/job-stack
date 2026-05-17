<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = 'user'; 

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fullname, $email, $hashed_password, $role]);

        
        header("Location: ../login.php?registration=success");
        exit();

    } catch (PDOException $e) {
        
        if ($e->getCode() == 23000) {
            header("Location: ../register.php?error=email_taken");
        } else {
            die("Database error: " . $e->getMessage());
        }
    }
}