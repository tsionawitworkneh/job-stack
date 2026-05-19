<?php
// These variables ($pdo, $user_id) are inherited from dashboard.php
$total_applied = getApplicationCount($pdo, $user_id);
$total_saved   = getSavedCount($pdo, $user_id);
$total_pending = getApplicationCount($pdo, $user_id, 'Pending');
$total_accepted = getApplicationCount($pdo, $user_id, 'Accepted');

$recent_apps = getRecentApplications($pdo, $user_id);
?>

<!-- 1. Link to the CSS (Make sure the file is in assets/css/tabs/overview.css) -->
<link rel="stylesheet" href="../assets/css/overview.css">
<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-info">
            <small>Jobs Applied</small>
            <h2><?php echo $total_applied; ?></h2>
        </div>
        <i class="fa-solid fa-briefcase"></i>
    </div>

    <div class="stat-card purple">
        <div class="stat-info">
            <small>Saved Jobs</small>
            <h2><?php echo $total_saved; ?></h2>
        </div>
        <i class="fa-solid fa-bookmark"></i>
    </div>

    <div class="stat-card orange">
        <div class="stat-info">
            <small>Pending</small>
            <h2><?php echo $total_pending; ?></h2>
        </div>
        <i class="fa-solid fa-clock"></i>
    </div>

    <div class="stat-card green">
        <div class="stat-info">
            <small>Approved</small>
            <h2><?php echo $total_accepted; ?></h2>
        </div>
        <i class="fa-solid fa-circle-check"></i>
    </div>
</div>

<div class="overview-row">
    <div class="content-card table-card">
        <h3>Recent Applications</h3>
        <table>
            <thead>
                <tr>
                    <th>Job Role</th>
                    <th>Company</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recent_apps)): ?>
                    <tr><td colspan="4" class="empty-msg" style="text-align:center; padding: 20px;">No applications yet.</td></tr>
                <?php else: ?>
                    <?php foreach($recent_apps as $app): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($app['title']); ?></strong></td>
                        <td><?php echo htmlspecialchars($app['company']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($app['applied_at'])); ?></td>
                        <td><span class="badge <?php echo getStatusClass($app['status']); ?>"><?php echo $app['status']; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="content-card viz-card">
        <h3>Profile Strength</h3>
        <div class="progress-container">
            <svg class="circular-progress" viewBox="0 0 100 100">
                <circle class="bg" cx="50" cy="50" r="45"></circle>
                <circle class="fg" cx="50" cy="50" r="45" style="stroke-dasharray: 210, 283;"></circle>
            </svg>
            <div class="progress-text">
                <span class="percent">75%</span>
                <small>Ready</small>
            </div>
        </div>
        <p style="color: #64748b; font-size: 14px; text-align: center;">Complete your profile to increase visibility.</p>
        <a href="?tab=profile" class="btn-outline">Complete Profile</a>
    </div>
</div>