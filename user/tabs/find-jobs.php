<?php

echo '<link rel="stylesheet" href="../assets/css/find-jobs.css">';


$jobs = getAllJobs($pdo);
?>

<div class="find-jobs-container">
    
    <div class="search-filter-row">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="jobSearch" placeholder="Search title or company...">
        </div>
        
        <select id="typeFilter" class="filter-dropdown">
            <option value="all">All Types</option>
            <option value="Full Time">Full Time</option>
            <option value="Remote">Remote</option>
            <option value="Internship">Internship</option>
            <option value="Part Time">Part Time</option>
        </select>
    </div>

    <div class="jobs-grid">
        <?php if(empty($jobs)): ?>
            <div style="text-align:center; padding: 100px 0; color:#9ca3af; width: 100%;">
                <i class="fa-solid fa-briefcase fa-3x" style="margin-bottom:20px; opacity:0.3;"></i>
                <p>No job postings available yet. Check back soon!</p>
            </div>
        <?php else: foreach($jobs as $job): ?>
            <?php 
                // Check status for each job
                $applied = hasApplied($pdo, $user_id, $job['id']); 
                $saved = isSaved($pdo, $user_id, $job['id']); 
            ?>
            <div class="job-card" 
                 data-title="<?php echo strtolower(htmlspecialchars($job['title'])); ?>" 
                 data-company="<?php echo strtolower(htmlspecialchars($job['company'])); ?>" 
                 data-type="<?php echo htmlspecialchars($job['type']); ?>">
                <div class="job-card-header">
                    <div class="job-type-badge"><?php echo htmlspecialchars($job['type']); ?></div>
                    
                    <!-- SAVE / BOOKMARK BUTTON -->
                    <a href="../actions/job_interaction_action.php?save_id=<?php echo $job['id']; ?>" 
                       class="btn-save-icon <?php echo ($saved) ? 'saved' : ''; ?>" 
                       title="<?php echo ($saved) ? 'Unsave Job' : 'Save Job'; ?>">
                        <i class="fa-<?php echo ($saved) ? 'solid' : 'regular'; ?> fa-bookmark"></i>
                    </a>
                </div>

                <div class="job-card-body">
                    <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                    <span class="company"><?php echo htmlspecialchars($job['company']); ?></span>
                    
                    <div class="job-details-small">
                        <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($job['location']); ?></span>
                    </div>
                </div>

                <div class="job-card-footer">
                    <span class="salary-text"><?php echo htmlspecialchars($job['salary']); ?></span>
                    
                    <?php if($applied): ?>
                        <button class="btn-action btn-applied">Already Applied</button>
                    <?php else: ?>
                
                        <button class="btn-action btn-apply" 
                                onclick='showJobDetails(<?php echo json_encode($job); ?>)'>
                            Apply Now
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>


<div id="jobDetailModal" class="job-modal-overlay">
    <div class="job-modal-box">
        <div class="modal-header">
            <div>
                <h2 id="m-title" class="modal-job-title"></h2>
                <span id="m-company" class="modal-company"></span>
            </div>
            <button class="close-modal-btn" onclick="closeModal()">&times;</button>
        </div>

        <div class="modal-meta-grid">
            <div class="meta-item"><i class="fa-solid fa-location-dot"></i> <span id="m-location"></span></div>
            <div class="meta-item"><i class="fa-solid fa-briefcase"></i> <span id="m-type"></span></div>
            <div class="meta-item"><i class="fa-solid fa-wallet"></i> <span id="m-salary"></span></div>
            <div class="meta-item"><i class="fa-solid fa-calendar"></i> <span id="m-date"></span></div>
        </div>

        <h4 class="modal-section-title">Job Description</h4>
        <p id="m-desc" class="modal-text"></p>

        <h4 class="modal-section-title">Requirements</h4>
        <p id="m-req" class="modal-text"></p>

        <div class="modal-footer">
            <form action="../actions/job_interaction_action.php" method="POST">
                <input type="hidden" name="job_id" id="m-job-id">
                <button type="submit" name="confirm_apply" class="btn-confirm-apply">
                    Confirm & Submit Application
                </button>
            </form>
        </div>
    </div>
</div>

<script>

const modal = document.getElementById('jobDetailModal');

function showJobDetails(job) {
    document.getElementById('m-title').innerText = job.title;
    document.getElementById('m-company').innerText = job.company;
    document.getElementById('m-location').innerText = job.location;
    document.getElementById('m-type').innerText = job.type;
    document.getElementById('m-salary').innerText = job.salary;
    document.getElementById('m-date').innerText = "Posted on " + job.created_at;
    document.getElementById('m-desc').innerText = job.description;
    document.getElementById('m-req').innerText = job.requirements || "No specific requirements listed.";
    document.getElementById('m-job-id').value = job.id;
    
    modal.style.display = 'flex';
}

function closeModal() {
    modal.style.display = 'none';
}


window.onclick = (e) => { if(e.target == modal) closeModal(); }


const jobSearch = document.getElementById('jobSearch');
const typeFilter = document.getElementById('typeFilter');
const cards = document.querySelectorAll('.job-card');

function filterData() {
    const q = jobSearch.value.toLowerCase();
    const type = typeFilter.value;

    cards.forEach(card => {
        
        const title = card.getAttribute('data-title') || "";
        const company = card.getAttribute('data-company') || "";
        const jobType = card.getAttribute('data-type') || "";

        const matchesText = title.includes(q) || company.includes(q);
        const matchesType = (type === 'all' || jobType === type);

        
        if (matchesText && matchesType) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

jobSearch.addEventListener('input', filterData);
typeFilter.addEventListener('change', filterData);
</script>