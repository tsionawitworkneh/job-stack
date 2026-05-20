<?php
echo '<link rel="stylesheet" href="styles/manage-jobs.css">';
$jobs = getAllJobsAdmin($pdo);
?>

<div class="manage-jobs-card">
    <div class="manage-header">
        <h2>Manage Job Postings</h2>
        
        <button class="btn-primary-add" onclick="openJobModal('add')">
            <i class="fa-solid fa-plus"></i> Post New Job
        </button>
    </div>

    <table class="modern-job-table">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Location</th>
                <th>Type</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($jobs)): ?>
                <tr><td colspan="6" style="text-align:center; padding:50px; color:#9ca3af;">No jobs posted yet.</td></tr>
            <?php else: foreach($jobs as $job): ?>
                <tr>
                    <td class="job-title-bold"><?php echo htmlspecialchars($job['title']); ?></td>
                    <td class="company-muted"><?php echo htmlspecialchars($job['company']); ?></td>
                    <td><?php echo htmlspecialchars($job['location']); ?></td>
                    <td><?php echo htmlspecialchars($job['type']); ?></td>
                    <td><?php echo htmlspecialchars($job['salary']); ?></td>
                    <td class="actions-group">
                        <!-- We pass all job data into the JS function -->
                        <button class="btn-icon-action btn-edit" title="Edit Job" 
                            onclick='openJobModal("edit", <?php echo json_encode($job); ?>)'>
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="btn-icon-action btn-delete" title="Delete Job" 
                            onclick="openConfirmModal('../actions/manage_job_action.php?delete=<?php echo $job['id']; ?>', 'job')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>


<div id="jobModal" class="job-modal-overlay">
    <div class="job-modal-box">
        <div class="job-modal-top">
            <h3 id="modalTitle">Post a New Job</h3>
            <button class="btn-close-modal" onclick="closeJobModal()">&times;</button>
        </div>

        <form action="../actions/manage_job_action.php" method="POST">
            
            <input type="hidden" name="job_id" id="form_job_id">
            
            <div class="job-form-grid">
                <div class="input-field-group">
                    <label>Job Title</label>
                    <input type="text" name="title" id="form_title" required>
                </div>
                <div class="input-field-group">
                    <label>Company</label>
                    <input type="text" name="company" id="form_company" required>
                </div>
                <div class="input-field-group">
                    <label>Location</label>
                    <input type="text" name="location" id="form_location">
                </div>
                <div class="input-field-group">
                    <label>Job Type</label>
                    <input type="text" name="type" id="form_type" placeholder="Full-time, Remote, etc.">
                </div>
                <div class="input-field-group full-width">
                    <label>Salary Range</label>
                    <input type="text" name="salary" id="form_salary">
                </div>
                <div class="input-field-group full-width">
                    <label>Job Description</label>
                    <textarea name="description" id="form_description" rows="3" required></textarea>
                </div>
                <div class="input-field-group full-width">
                    <label>Requirements</label>
                    <textarea name="requirements" id="form_requirements" rows="3" placeholder="List key requirements..."></textarea>
                </div>
            </div>

            <button type="submit" name="save_job" id="submitBtn" class="btn-publish">Publish Job Posting</button>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById('jobModal');
const modalTitle = document.getElementById('modalTitle');
const submitBtn = document.getElementById('submitBtn');

function openJobModal(mode, data = null) {
    modal.style.display = 'flex';
    
    if (mode === 'edit' && data) {
        modalTitle.innerText = "Edit Job Posting";
        submitBtn.innerText = "Update Job Posting";
        submitBtn.name = "edit_job"; 
        
        
        document.getElementById('form_job_id').value = data.id;
        document.getElementById('form_title').value = data.title;
        document.getElementById('form_company').value = data.company;
        document.getElementById('form_location').value = data.location;
        document.getElementById('form_type').value = data.type;
        document.getElementById('form_salary').value = data.salary;
        document.getElementById('form_description').value = data.description;
        document.getElementById('form_requirements').value = data.requirements;
    } else {
        modalTitle.innerText = "Post a New Job";
        submitBtn.innerText = "Publish Job Posting";
        submitBtn.name = "add_job"; 
        
        document.getElementById('form_job_id').value = "";
        document.querySelector('form').reset();
    }
}

function closeJobModal() {
    modal.style.display = 'none';
}

window.onclick = function(e) { if (e.target == modal) closeJobModal(); }
</script>