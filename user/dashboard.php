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
    <title>User Dashboard | Job Stack</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    
    <aside class="sidebar">
        <div class="sidebar-header">
            <i class="fa-solid fa-briefcase"></i>
            <span>Job Stack</span>
        </div>
        
        <nav class="nav-menu">
            <a href="dashboard.php?tab=overview" class="nav-item <?php echo ($tab == 'overview') ? 'active' : ''; ?>"><i class="fa-solid fa-chart-line"></i> Overview</a>
            <a href="dashboard.php?tab=find-jobs" class="nav-item <?php echo ($tab == 'find-jobs') ? 'active' : ''; ?>"><i class="fa-solid fa-magnifying-glass"></i> Find Jobs</a>
            <a href="dashboard.php?tab=applied-jobs" class="nav-item <?php echo ($tab == 'applied-jobs') ? 'active' : ''; ?>"><i class="fa-solid fa-file-lines"></i> Applied Jobs</a>
            <a href="dashboard.php?tab=saved-jobs" class="nav-item <?php echo ($tab == 'saved-jobs') ? 'active' : ''; ?>"><i class="fa-solid fa-bookmark"></i> Saved Jobs</a>
            <a href="dashboard.php?tab=ai" class="nav-item <?php echo ($tab == 'ai') ? 'active' : ''; ?>"><i class="fa-solid fa-robot"></i> AI Insight</a>
            <a href="dashboard.php?tab=profile" class="nav-item <?php echo ($tab == 'profile') ? 'active' : ''; ?>"><i class="fa-solid fa-user"></i> Profile</a>
        </nav>

        <div class="logout-btn">
            <a href="../actions/logout.php" class="nav-item" style="color: #ef4444;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    
    <main class="main-content">
        <header class="top-bar">
            <h2>Welcome back, <?php echo explode(' ', $_SESSION['user_name'])[0]; ?>! 👋</h2>
            <div class="user-profile">
                <span><?php echo $_SESSION['user_name']; ?></span>
                <i class="fa-solid fa-circle-user fa-2xl" style="color: #cbd5e0;"></i>
            </div>
        </header>

        <div class="tab-content">
            <?php 
        
        $allowed_tabs = ['overview', 'find-jobs', 'applied-jobs', 'saved-jobs', 'ai', 'profile'];
        
        if (in_array($tab, $allowed_tabs)) {
            
            include "tabs/" . $tab . ".php";
        } else {
            include "tabs/overview.php";
        }
    ?>
        </div>

    </main>

</body>
</html>