<?php
/**
 * Get count of applications based on status for a specific user
 */
function getApplicationCount($pdo, $userId, $status = null) {
    if ($status) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM applications WHERE user_id = ? AND status = ?");
        $stmt->execute([$userId, $status]);
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM applications WHERE user_id = ?");
        $stmt->execute([$userId]);
    }
    return $stmt->fetchColumn();
}

/**
 * Get count of saved jobs for a user
 */
function getSavedCount($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM saved_jobs WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Fetch the 5 most recent applications for the dashboard table
 */
function getRecentApplications($pdo, $userId, $limit = 5) {
    $sql = "SELECT a.status, a.applied_at, j.title, j.company 
            FROM applications a 
            JOIN jobs j ON a.job_id = j.id 
            WHERE a.user_id = ? 
            ORDER BY a.applied_at DESC LIMIT ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId, $limit]);
    return $stmt->fetchAll();
}

/**
 * Simple Helper for Status Badge Colors
 */
function getStatusClass($status) {
    switch ($status) {
        case 'Accepted': return 'status-accepted';
        case 'Rejected': return 'status-rejected';
        case 'Reviewed': return 'status-reviewed';
        default: return 'status-pending';
    }
}

/**
 * Fetch all active job postings
 */
function getAllJobs($pdo) {
    $stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

/**
 * Check if the user has applied to this specific job
 */
function hasApplied($pdo, $userId, $jobId) {
    $stmt = $pdo->prepare("SELECT id FROM applications WHERE user_id = ? AND job_id = ?");
    $stmt->execute([$userId, $jobId]);
    return $stmt->fetch() ? true : false;
}


/**
 * Check if the user has saved this specific job
 */
function isSaved($pdo, $userId, $jobId) {
    $stmt = $pdo->prepare("SELECT id FROM saved_jobs WHERE user_id = ? AND job_id = ?");
    $stmt->execute([$userId, $jobId]);
    return $stmt->fetch() ? true : false;
}


// Get counts for Admin Dashboard
function getAdminStats($pdo) {
    $stats = [];
    $stats['users'] = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn();
    $stats['jobs'] = $pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
    $stats['apps'] = $pdo->query("SELECT COUNT(*) FROM applications")->fetchColumn();
    // Extra stat: Successful matches (Accepted applications)
    $stats['hires'] = $pdo->query("SELECT COUNT(*) FROM applications WHERE status = 'Accepted'")->fetchColumn();
    return $stats;
}

function getAppChartData($pdo) {
    $sql = "SELECT DATE(applied_at) as date, COUNT(*) as count 
            FROM applications 
            GROUP BY DATE(applied_at) 
            ORDER BY date DESC LIMIT 7";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Fetch all registered candidates for the Admin User Directory
 */
function getAllCandidates($pdo) {
    $stmt = $pdo->prepare("SELECT id, fullname, email, created_at FROM users WHERE role = 'user' ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Fetch all jobs for the Admin dashboard
 */
function getAllJobsAdmin($pdo) {
    $stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

/**
 * Get a single job by ID for editing
 */
function getJobById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * Fetch all job applications for the logged-in user with job details
 */
function getUserApplications($pdo, $userId) {
    $sql = "SELECT a.id as app_id, a.status, a.applied_at, j.title, j.company, j.location, j.type, j.salary, j.description, j.requirements
            FROM applications a 
            INNER JOIN jobs j ON a.job_id = j.id 
            WHERE a.user_id = ? 
            ORDER BY a.applied_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getSavedJobs($pdo, $userId) {
    $sql = "SELECT s.id as save_id, j.* 
            FROM saved_jobs s 
            JOIN jobs j ON s.job_id = j.id 
            WHERE s.user_id = ? 
            ORDER BY s.id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

/**
 * Fetch User and Profile information together
 */
function getFullUserProfile($pdo, $userId) {
    $sql = "SELECT u.fullname, u.email, u.created_at, p.cv_file, p.bio, p.skills 
            FROM users u 
            LEFT JOIN user_profiles p ON u.id = p.user_id 
            WHERE u.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

/**
 * Fetch the skills extracted from the user's latest CV analysis
 */
function getUserSkills($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT strengths FROM ai_insights WHERE user_id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $row = $stmt->fetch();
    // Returns an array of skills or an empty array
    return $row ? explode(', ', $row['strengths']) : [];
}

/**
 * Fetch all job matches for this user, ranked by highest score
 */
function getAITopMatches($pdo, $userId) {
    $sql = "SELECT ai.match_score, ai.missing_skills, j.title, j.company, j.location, j.salary 
            FROM ai_insights ai 
            JOIN jobs j ON ai.job_id = j.id 
            WHERE ai.user_id = ? 
            ORDER BY ai.match_score DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>