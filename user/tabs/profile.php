<?php
echo '<link rel="stylesheet" href="../assets/css/profile.css">';
$user = getFullUserProfile($pdo, $user_id);
?>

<div class="profile-wrapper">
    <form action="../actions/profile_action.php" method="POST" enctype="multipart/form-data">
        
        
        <div class="profile-card">
            <h3 class="section-title"><i class="fa-solid fa-circle-user"></i> Account Settings</h3>
            <div class="profile-grid">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>
        </div>

    
        <div class="profile-card">
            <h3 class="section-title"><i class="fa-solid fa-briefcase"></i> Professional Details</h3>
            
            <div class="form-group">
                <label>Short Bio</label>
                <textarea name="bio" rows="4" placeholder="Briefly describe your professional background..."><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label>Skills (Comma separated)</label>
                <input type="text" name="skills" value="<?php echo htmlspecialchars($user['skills'] ?? ''); ?>" placeholder="e.g. PHP, JavaScript, UI Design">
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label>Resume / CV</label>
                
                
                <div class="upload-container" onclick="document.getElementById('cv_input').click()">
                    <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <h4 style="margin:0; color:#1e293b;">Click to upload your CV</h4>
                    <p style="color:#64748b; font-size:13px; margin:5px 0 15px;">PDF or DOCX (Max 5MB)</p>
                    
                    <input type="file" name="cv_file" id="cv_input" hidden accept=".pdf,.docx">
                    
                    <div id="file-chosen" style="font-size:13px; color:#2563eb; font-weight:600;">
                        <?php if($user['cv_file']): ?>
                            <span class="cv-exists-badge">
                                <i class="fa-solid fa-check-circle"></i> Current: <?php echo $user['cv_file']; ?>
                            </span>
                        <?php else: ?>
                            No file selected
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <button type="submit" name="save_profile" class="btn-save-profile">
                Save All Profile Changes
            </button>
        </div>
    </form>
</div>

<script>

document.getElementById('cv_input').onchange = function() {
    document.getElementById('file-chosen').innerHTML = 
        '<span style="color:#16a34a"><i class="fa-solid fa-file-circle-check"></i> ' + this.files[0].name + ' ready to save</span>';
};
</script>