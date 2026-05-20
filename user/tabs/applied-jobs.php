<?php

echo '<link rel="stylesheet" href="../assets/css/applied-jobs.css">';
echo '<link rel="stylesheet" href="../assets/css/find-jobs.css">'; 


$applications = getUserApplications($pdo, $user_id);
?>

<div class="applied-jobs-container">
    <div class="table-card">
        <div class="table-header-flex">
            <h2>My Application History</h2>
            <span class="total-count-text">Total: <?php echo count($applications); ?></span>
        </div>

        <table class="applied-table">
            <thead>
                <tr>
                    <th>Job Position</th>
                    <th>Company</th>
                    <th>Date Applied</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($applications)): ?>
                    <tr>
                        <td colspan="5" class="empty-table-row">
                            <i class="fa-solid fa-folder-open fa-3x"></i>
                            <p>You haven't applied to any jobs yet.</p>
                            <a href="?tab=find-jobs" class="btn-browse-inline">Browse Jobs</a>
                        </td>
                    </tr>
                <?php else: foreach($applications as $app): ?>
                    <tr>
                        <td>
                            <h4 class="job-title-main"><?php echo htmlspecialchars($app['title']); ?></h4>
                            <span class="job-type-sub"><?php echo htmlspecialchars($app['type']); ?></span>
                        </td>
                        <td>
                            <div class="company-name-bold"><?php echo htmlspecialchars($app['company']); ?></div>
                            <div class="location-meta">
                                <i class="fa-solid fa-location-dot"></i> 
                                <?php echo htmlspecialchars($app['location']); ?>
                            </div>
                        </td>
                        <td class="date-column">
                            <?php echo date('M d, Y', strtotime($app['applied_at'])); ?>
                        </td>
                        <td>
                            <span class="status-pill pill-<?php echo $app['status']; ?>">
                                <?php echo $app['status']; ?>
                            </span>
                        </td>
                        <td>
                            
                            <button class="btn-view-details" 
                                    onclick='showJobDetails(<?php echo json_encode($app); ?>)'>
                                View Details
                            </button>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php include 'modal_job_details.php'; ?>