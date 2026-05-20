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

?>