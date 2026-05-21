<?php


echo '<link rel="stylesheet" href="../assets/css/ai-insight.css">';


$userSkills = getUserSkills($pdo, $user_id);
$matches = getAITopMatches($pdo, $user_id);

if (empty($userSkills)): ?>
    
    <div class="ai-card ai-empty-state">
        <i class="fa-solid fa-robot fa-4x"></i>
        <h2>Analyze your CV with AI</h2>
        <p>
            Our AI engine scans your resume to identify core competencies and matches them against current job openings in real-time.
        </p>
        <a href="?tab=profile" class="btn-save-profile" style="text-decoration:none;">Go to Profile</a>
    </div>

<?php else: ?>

    <div class="ai-container">
        
        
        <div class="ai-card">
            <h3><i class="fa-solid fa-circle-check" style="color:#10b981;"></i> Extracted Core Skills</h3>
            <p class="sub-desc">The following professional keywords were successfully identified in your latest CV.</p>
            
            <div class="skills-flex">
                <?php foreach($userSkills as $skill): ?>
                    <span class="skill-tag"><?php echo htmlspecialchars($skill); ?></span>
                <?php endforeach; ?>
            </div>

            <div class="ai-tip-box">
                <h4><i class="fa-solid fa-lightbulb"></i> AI Optimization Tip</h4>
                <p>
                    Job Stack helps you to find your dream job. To boost your match score, ensure your CV includes specific tools, frameworks, and soft skills mentioned in target job descriptions.
                </p>
            </div>
        </div>

       
        <div class="match-sidebar">
            <h3 class="match-sidebar-title">Top Matches For You</h3>
            
            <div class="match-list">
                <?php foreach($matches as $m): ?>
                    <div class="match-card">
                        <div class="score-badge"><?php echo $m['match_score']; ?>% Match</div>
                        <h4><?php echo htmlspecialchars($m['title']); ?></h4>
                        <span><?php echo htmlspecialchars($m['company']); ?> • <?php echo $m['location']; ?></span>
                        
                        <?php if(!empty($m['missing_skills'])): ?>
                            <div class="missing-warning">
                                <i class="fa-solid fa-bolt"></i> Boost your score: Add <strong><?php echo htmlspecialchars($m['missing_skills']); ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="?tab=find-jobs" class="view-all-link">
                Browse all matching opportunities <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </div>

<?php endif; ?>