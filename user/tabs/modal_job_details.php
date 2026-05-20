
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
    
    modal.style.display = 'flex';
}

function closeModal() {
    modal.style.display = 'none';
}

window.onclick = (e) => { if(e.target == modal) closeModal(); }
</script>