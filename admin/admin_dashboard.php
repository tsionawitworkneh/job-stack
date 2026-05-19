<?php 
require_once '../config/db.php';
require_once '../includes/auth_check.php';
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
            <a href="../actions/logout.php" class="nav-item" style="color: #ef4444;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
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
        // Sync the array names with your sidebar hrefs
        $allowed_tabs = ['dashboard', 'manage-users', 'manage-jobs', 'job-applications'];
        
        if (in_array($tab, $allowed_tabs)) {
            // This will look for tabs/manage-users.php, etc.
            include "tabs/" . $tab . ".php";
        } else {
            include "tabs/dashboard.php";
        }
    ?>
        </div>

    </main>

</body>
</html>