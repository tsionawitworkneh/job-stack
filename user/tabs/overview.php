<?php

echo '<link rel="stylesheet" href="../assets/css/overview.css">';


$applied = getApplicationCount($pdo, $user_id);
$saved = getSavedCount($pdo, $user_id);
$pending = getApplicationCount($pdo, $user_id, 'Pending');
$approved = getApplicationCount($pdo, $user_id, 'Accepted');
?>


<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-data">
            <span class="label">Job Applied</span>
            <h2 class="number"><?php echo $applied; ?></h2>
        </div>
        <div class="icon-circle bg-blue"><i class="fa-solid fa-file-lines"></i></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-data">
            <span class="label">Saved Jobs</span>
            <h2 class="number"><?php echo $saved; ?></h2>
        </div>
        <div class="icon-circle bg-purple"><i class="fa-solid fa-bookmark"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-data">
            <span class="label">Pending</span>
            <h2 class="number"><?php echo $pending; ?></h2>
        </div>
        <div class="icon-circle bg-yellow"><i class="fa-solid fa-clock"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-data">
            <span class="label">Approved</span>
            <h2 class="number"><?php echo $approved; ?></h2>
        </div>
        <div class="icon-circle bg-green"><i class="fa-solid fa-circle-check"></i></div>
    </div>
</div>


<div class="section-title-row">
    <h2>Recent Applications</h2>
    <a href="?tab=applied-jobs" class="btn-view-all">View All</a>
</div>


<div class="table-wrapper">
    <table class="modern-table">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $recent = getRecentApplications($pdo, $user_id);
            if(empty($recent)): 
            ?>
                <tr><td colspan="4" style="text-align:center; padding: 60px; color:#9CA3AF;">No recent applications.</td></tr>
            <?php else: foreach($recent as $app): ?>
                <tr>
                    <td class="job-title"><?php echo htmlspecialchars($app['title']); ?></td>
                    <td class="company-name"><?php echo htmlspecialchars($app['company']); ?></td>
                    <td class="date-text"><?php echo date('M d, Y', strtotime($app['applied_at'])); ?></td>
                    <td>
                        <?php 
                        $status = $app['status'];
                        $class = ($status == 'Accepted') ? 'pill-approved' : (($status == 'Pending') ? 'pill-pending' : 'pill-review');
                        ?>
                        <span class="status-pill <?php echo $class; ?>"><?php echo $status; ?></span>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>