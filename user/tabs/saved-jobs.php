<?php
echo '<link rel="stylesheet" href="../assets/css/saved-jobs.css">';
echo '<link rel="stylesheet" href="../assets/css/find-jobs.css">'; 
$saved_jobs = getSavedJobs($pdo, $user_id);
?>

<div class="saved-jobs-container">
    <h2 style="margin:12px 0 28px; font-size:20px; font-weight:600;">Your Bookmarked Jobs</h2>
    
    <div class="saved-jobs-grid">
        <?php if(empty($saved_jobs)): ?>
            <p style="color:#94a3b8;">You haven't saved any jobs yet.</p>
        <?php else: foreach($saved_jobs as $job): ?>
            <div class="saved-card">
                <a href="../actions/job_interaction_action.php?save_id=<?php echo $job['id']; ?>" class="btn-remove-save" title="Remove">
                    <i class="fa-solid fa-bookmark"></i>
                </a>
                <div class="job-type-badge"><?php echo $job['type']; ?></div>
                <h3 style="margin:10px 0 5px;"><?php echo htmlspecialchars($job['title']); ?></h3>
                <p style="color:#64748b; font-size:14px; margin-bottom:20px;"><?php echo htmlspecialchars($job['company']); ?></p>
                
                <button class="btn-action btn-apply" style="width: 150px;" onclick='showJobDetails(<?php echo json_encode($job); ?>)'>
                    View Details
                </button>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>

<?php include 'modal_job_details.php'; ?>