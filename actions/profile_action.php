<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_profile'])) {
    $user_id = $_SESSION['user_id'];
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $bio = trim($_POST['bio']);
    $skills = trim($_POST['skills']);

    try {
        $pdo->beginTransaction();

        
        $stmt1 = $pdo->prepare("UPDATE users SET fullname = ?, email = ? WHERE id = ?");
        $stmt1->execute([$fullname, $email, $user_id]);
        $_SESSION['user_name'] = $fullname;

        
        $cv_name = null;
        $file_uploaded = false;
        if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
            $ext = pathinfo($_FILES['cv_file']['name'], PATHINFO_EXTENSION);
            $cv_name = "cv_" . $user_id . "_" . time() . "." . $ext;
            $upload_path = "../uploads/cvs/" . $cv_name;
            
            if (move_uploaded_file($_FILES['cv_file']['tmp_name'], $upload_path)) {
                $file_uploaded = true;
            }
        }

        
        $check = $pdo->prepare("SELECT id FROM user_profiles WHERE user_id = ?");
        $check->execute([$user_id]);

        if ($check->fetch()) {
            $query = "UPDATE user_profiles SET bio = ?, skills = ?" . ($cv_name ? ", cv_file = ?" : "") . " WHERE user_id = ?";
            $params = [$bio, $skills];
            if($cv_name) $params[] = $cv_name;
            $params[] = $user_id;
            $pdo->prepare($query)->execute($params);
        } else {
            $query = "INSERT INTO user_profiles (user_id, bio, skills, cv_file) VALUES (?, ?, ?, ?)";
            $pdo->prepare($query)->execute([$user_id, $bio, $skills, $cv_name]);
        }

        $pdo->commit();

        
        if ($file_uploaded) {
            
            $python_exe = realpath("../python/venv/Scripts/python.exe");
            $script_path = realpath("../python/parser.py");
            $pdf_path = realpath("../uploads/cvs/" . $cv_name);

            
            $command = "\"$python_exe\" \"$script_path\" $user_id \"$pdf_path\" 2>&1";
            shell_exec($command);
        }
        
        header("Location: ../user/dashboard.php?tab=profile&msg=success");
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        die("System Error: " . $e->getMessage());
    }
}