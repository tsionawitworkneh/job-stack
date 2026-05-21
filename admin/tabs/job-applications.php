<?php
/**
 * File: admin/tabs/job-applications.php
 */

// Link the dedicated CSS
echo '<link rel="stylesheet" href="styles/job-applications.css">';

// Fetch all applications (Make sure this function is in includes/functions.php)
$applications = getAllApplicationsAdmin($pdo);
?>

<div class="apps-container">
    <div class="apps-card">
        
        <div class="apps-header">
            <h2>Platform Applications</h2>
            <p>Manage candidate submissions and track hiring progress.</p>
        </div>

        <table class="apps-table">
            <thead>
                <tr>
                    <th>Candidate</th>
                    <th>Job Post</th>
                    <th>Resume</th>
                    <th>Applied Date</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($applications)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding:60px; color:#9ca3af;">
                            No applications have been submitted yet.
                        </td>
                    </tr>
                <?php else: foreach($applications as $app): ?>
                    <tr>
                        <!-- Candidate Info -->
                        <td>
                            <div class="candidate-info">
                                <b><?php echo htmlspecialchars($app['fullname']); ?></b>
                                <span><?php echo htmlspecialchars($app['email']); ?></span>
                            </div>
                        </td>

                        <!-- Job Info -->
                        <td>
                            <span class="job-info-text"><?php echo htmlspecialchars($app['job_title']); ?></span>
                            <span class="company-sub-text"><?php echo htmlspecialchars($app['company']); ?></span>
                        </td>

                        <!-- Resume Link -->
                        <td>
                            <?php if(!empty($app['cv_file'])): ?>
                                <a href="../uploads/cvs/<?php echo $app['cv_file']; ?>" target="_blank" class="link-cv">
                                    <i class="fa-solid fa-file-pdf"></i> View CV
                                </a>
                            <?php else: ?>
                                <span style="color:#cbd5e1; font-size:12px;">No CV</span>
                            <?php endif; ?>
                        </td>

                        <!-- Date -->
                        <td>
                            <span class="date-text"><?php echo date('M d, Y', strtotime($app['applied_at'])); ?></span>
                        </td>

                        <!-- Status Management -->
                        <td>
                            <form action="../actions/update_app_status.php" method="POST" class="status-select-wrapper">
                                <input type="hidden" name="app_id" value="<?php echo $app['app_id']; ?>">
                                
                                <select name="new_status" 
                                        class="select-<?php echo $app['status']; ?>" 
                                        onchange="this.form.submit()">
                                    <option value="Pending" <?php echo ($app['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Reviewed" <?php echo ($app['status'] == 'Reviewed') ? 'selected' : ''; ?>>Reviewed</option>
                                    <option value="Accepted" <?php echo ($app['status'] == 'Accepted') ? 'selected' : ''; ?>>Accepted</option>
                                    <option value="Rejected" <?php echo ($app['status'] == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>

    </div>
</div>