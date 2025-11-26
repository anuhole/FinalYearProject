<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
$stmt = mysqli_prepare($conn, "SELECT c.*, e.title AS election_title FROM candidates c LEFT JOIN elections e ON c.election_id=e.id ORDER BY c.id DESC");
mysqli_stmt_execute($stmt); $res = mysqli_stmt_get_result($stmt);
?>
<div class="d-flex justify-content-between"><h1 class="h2">Candidates</h1><a class="btn btn-success" href="add_candidate.php">Add Candidate</a></div>
<table class="table table-striped mt-3"><thead><tr><th>ID</th><th>Name</th><th>Election</th><th>Actions</th></tr></thead><tbody>
<?php while($r = mysqli_fetch_assoc($res)): ?>
<tr><td><?= $r['id'] ?></td><td><?= htmlspecialchars($r['name']) ?></td><td><?= htmlspecialchars($r['election_title']) ?></td>
<td><a class="btn btn-sm btn-info" href="edit_candidate.php?id=<?= $r['id'] ?>">Edit</a> <a class="btn btn-sm btn-danger" href="delete_candidate.php?id=<?= $r['id'] ?>" onclick="return confirm('Delete candidate?')">Delete</a></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>