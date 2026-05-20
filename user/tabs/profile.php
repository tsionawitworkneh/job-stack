<?php
echo '<link rel="stylesheet" href="../assets/css/profile.css">';
$user = getFullUserProfile($pdo, $user_id);
?>

<div class="profile-container">
    
    
    <div class="profile-card">
        <h3 class="section-title"><i class="fa-solid fa-user-gear"></i> Personal Information</h3>
        
        <form action="../actions/profile_action.php" method="POST">
            <div class="form-grid">
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                </div>
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>
            <button type="submit" name="update_info" class="btn-save-profile">Update Details</button>
        </form>
    </div>

    
    <div class="profile-card">
        <h3 class="section-title"><i class="fa-solid fa-file-pdf"></i> Resume / CV</h3>
        
        <?php if($user['cv_file']): ?>
            <div class="current-cv-box">
                <div class="cv-info">
                    <i class="fa-solid fa-file-circle-check fa-lg"></i>
                    <span><?php echo $user['cv_file']; ?></span>
                </div>
                <a href="../uploads/cvs/<?php echo $user['cv_file']; ?>" target="_blank" style="color:#2563eb; font-size:13px; font-weight:600; text-decoration:none;">View File</a>
            </div>
        <?php endif; ?>

        <form action="../actions/upload_cv_action.php" method="POST" enctype="multipart/form-data">
            <div class="upload-zone" onclick="document.getElementById('cv_input').click()">
                <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                <p style="margin:0; font-weight:600; color:#1e293b;">Click to upload or drag and drop</p>
                <p style="margin:5px 0 0; font-size:12px; color:#64748b;">PDF or DOCX (Max 5MB)</p>
                <input type="file" name="cv_file" id="cv_input" hidden required onchange="this.form.submit()">
            </div>
        </form>
    </div>

</div>