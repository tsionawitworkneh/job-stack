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
?>