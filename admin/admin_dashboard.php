<?php 
require_once '../config/db.php';
require_once '../includes/admin_check.php';
require_once '../includes/functions.php';


$tab = isset($_GET['tab']) ? $_GET['tab'] : 'overview';
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Job Stack</title>
    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" href="styles/confirm-modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    
    <aside class="sidebar">
        <div class="sidebar-header">
            <i class="fa-solid fa-briefcase"></i>
            <span>Job Stack</span>
        </div>
        
        <nav class="nav-menu">
            <a href="admin_dashboard.php?tab=dashboard" class="nav-item <?php echo ($tab == 'dashboard') ? 'active' : ''; ?>"><i class="fa-solid fa-chart-column"></i> Dashboard</a>
            <a href="admin_dashboard.php?tab=manage-users" class="nav-item <?php echo ($tab == 'manage-users') ? 'active' : ''; ?>"><i class="fa-solid fa-user-check"></i> Manage Users</a>
            <a href="admin_dashboard.php?tab=manage-jobs" class="nav-item <?php echo ($tab == 'manage-jobs') ? 'active' : ''; ?>"><i class="fa-solid fa-briefcase"></i> Manage Jobs</a>
            <a href="admin_dashboard.php?tab=job-applications" class="nav-item <?php echo ($tab == 'job-applications') ? 'active' : ''; ?>"><i class="fa-solid fa-file-lines"></i> Job Application</a>
        </nav>

        <div class="logout-btn">
            <a href="../actions/admin_logout.php" class="nav-item" style="color: #ef4444;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    
    <main class="main-content">
        <header class="top-bar">
            <h2>Welcome back, <?php echo explode(' ', $_SESSION['user_name'])[1]; ?>! 👋</h2>
            <div class="user-profile">
                <span><?php echo $_SESSION['user_name']; ?></span>
                <i class="fa-solid fa-circle-user fa-2xl" style="color: #cbd5e0;"></i>
            </div>
        </header>

        <div class="tab-content">
            <?php 
        
        $allowed_tabs = ['dashboard', 'manage-users', 'manage-jobs', 'job-applications'];
        
        if (in_array($tab, $allowed_tabs)) {
            
            include "tabs/" . $tab . ".php";
        } else {
            include "tabs/dashboard.php";
        }
    ?>
        </div>

    </main>

    

<div id="confirmModal" class="confirm-overlay">
    <div class="confirm-modal-content">
        <div class="warning-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3>Are you sure?</h3>
        <p id="confirmMessage">This action cannot be undone. All related data will be permanently removed.</p>
        
        <div class="confirm-actions">
            <button class="btn-confirm btn-no" onclick="closeConfirmModal()">Cancel</button>
            <a id="confirmDeleteBtn" href="#" class="btn-confirm btn-yes" style="text-decoration: none; text-align: center;">Delete Now</a>
        </div>
    </div>
</div>

<script>
let modalOverlay = document.getElementById('confirmModal');
let deleteLink = document.getElementById('confirmDeleteBtn');
let confirmMsg = document.getElementById('confirmMessage');

function openConfirmModal(url, type) {
    if(type === 'user') {
        confirmMsg.innerText = "Are you sure you want to remove this user? This will also delete their profile and applications.";
    } else {
        confirmMsg.innerText = "Are you sure you want to delete this job posting? This action is permanent.";
    }
    
    deleteLink.href = url;
    modalOverlay.style.display = 'flex';
}

function closeConfirmModal() {
    modalOverlay.style.display = 'none';
}


window.addEventListener('click', (e) => {
    if (e.target == modalOverlay) closeConfirmModal();
});
</script>

</body>
</html>