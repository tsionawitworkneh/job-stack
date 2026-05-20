<?php

echo '<link rel="stylesheet" href="styles/manage-users.css">';


$candidates = getAllCandidates($pdo);
?>

<div class="user-list-card">
    <div class="card-header">
        <h3>User Directory</h3>
        <span style="color: #64748b; font-size: 14px;">Total: <?php echo count($candidates); ?> Candidates</span>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Joined Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($candidates)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                        No candidates registered yet.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($candidates as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td class="user-name"><?php echo htmlspecialchars($user['fullname']); ?></td>
                        <td class="user-email"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                        <td>
                            <button class="btn-delete" 
                                onclick="openConfirmModal('../actions/manage_user_action.php?delete=<?php echo $user['id']; ?>', 'user')">
                                <i class="fa-solid fa-trash-can"></i> Remove
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>