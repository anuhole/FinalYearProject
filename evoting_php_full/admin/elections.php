<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
$stmt = mysqli_prepare($conn, "SELECT * FROM elections ORDER BY id DESC"); mysqli_stmt_execute($stmt); $res = mysqli_stmt_get_result($stmt);
?>
<div class="d-flex justify-content-between align-items-center"><h1 class="h2">Elections</h1><a class="btn btn-success" href="add_election.php">Add Election</a></div>
<table class="table table-bordered mt-3"><thead><tr><th>ID</th><th>Title</th><th>Start</th><th>End</th><th>Status</th><th>Actions</th></tr></thead><tbody>
<?php while($row = mysqli_fetch_assoc($res)): ?>
<tr><td><?= $row['id'] ?></td><td><?= htmlspecialchars($row['title']) ?></td><td><?= $row['start_at'] ?></td><td><?= $row['end_at'] ?></td><td><?= $row['status'] ?></td>
<td><a class="btn btn-sm btn-info" href="edit_election.php?id=<?= $row['id'] ?>">Edit</a> <a class="btn btn-sm btn-danger" href="delete_election.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete election?')">Delete</a></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>