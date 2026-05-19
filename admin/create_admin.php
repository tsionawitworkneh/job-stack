<?php
require_once '../config/db.php';

$email = 'admin@gmail.com';
$password = 'admin1234';
$fullname = 'System Admin';
$role = 'admin';


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    

    
    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$fullname, $email, $hashed_password, $role]);

    echo "<h1>Admin Created Successfully!</h1>";
    echo "<p>Email: <b>$email</b></p>";
    echo "<p>Password: <b>$password</b></p>";
    echo "<br><a href='admin/admin_login.php'>Go to Admin Login</a>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>