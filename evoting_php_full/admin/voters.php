<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
$stmt = mysqli_prepare($conn, "SELECT id,username,fullname,is_admin FROM voters ORDER BY id DESC"); mysqli_stmt_execute($stmt); $res = mysqli_stmt_get_result($stmt);
?>
<div class="d-flex justify-content-between"><h1 class="h2">Voters</h1><a class="btn btn-success" href="add_voter.php">Add Voter</a></div>
<table class="table mt-3"><thead><tr><th>ID</th><th>Username</th><th>Fullname</th><th>Admin</th><th>Actions</th></tr></thead><tbody>
<?php while($r = mysqli_fetch_assoc($res)): ?>
<tr><td><?= $r['id'] ?></td><td><?= htmlspecialchars($r['username']) ?></td><td><?= htmlspecialchars($r['fullname']) ?></td><td><?= $r['is_admin'] ? 'Yes' : 'No' ?></td>
<td><a class="btn btn-sm btn-info" href="edit_voter.php?id=<?= $r['id'] ?>">Edit</a> <a class="btn btn-sm btn-danger" href="delete_voter.php?id=<?= $r['id'] ?>" onclick="return confirm('Delete voter?')">Delete</a></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>