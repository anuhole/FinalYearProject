<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';

$stmt = mysqli_prepare($conn, "SELECT COUNT(*) as c FROM elections"); mysqli_stmt_execute($stmt); $r = mysqli_stmt_get_result($stmt); $e = mysqli_fetch_assoc($r);
$stmt = mysqli_prepare($conn, "SELECT COUNT(*) as c FROM candidates"); mysqli_stmt_execute($stmt); $r = mysqli_stmt_get_result($stmt); $c = mysqli_fetch_assoc($r);
$stmt = mysqli_prepare($conn, "SELECT COUNT(*) as c FROM voters"); mysqli_stmt_execute($stmt); $r = mysqli_stmt_get_result($stmt); $v = mysqli_fetch_assoc($r);
$stmt = mysqli_prepare($conn, "SELECT COUNT(*) as c FROM votes"); mysqli_stmt_execute($stmt); $r = mysqli_stmt_get_result($stmt); $vo = mysqli_fetch_assoc($r);
?>
<h1 class="h2">Dashboard</h1>
<div class="row my-4">
  <div class="col-md-3"><div class="card"><div class="card-body"><h5>Elections</h5><h3><?= (int)$e['c'] ?></h3></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><h5>Candidates</h5><h3><?= (int)$c['c'] ?></h3></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><h5>Voters</h5><h3><?= (int)$v['c'] ?></h3></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><h5>Votes</h5><h3><?= (int)$vo['c'] ?></h3></div></div></div>
</div>

<h4>Recent Elections</h4>
<?php
$stmt = mysqli_prepare($conn, "SELECT * FROM elections ORDER BY id DESC LIMIT 5"); mysqli_stmt_execute($stmt); $res = mysqli_stmt_get_result($stmt);
?>
<table class="table table-striped"><thead><tr><th>ID</th><th>Title</th><th>Start</th><th>End</th><th>Status</th><th>Actions</th></tr></thead><tbody>
<?php while($row = mysqli_fetch_assoc($res)): ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= htmlspecialchars($row['title']) ?></td>
  <td><?= $row['start_at'] ?></td>
  <td><?= $row['end_at'] ?></td>
  <td><?= $row['status'] ?></td>
  <td>
    <a class="btn btn-sm btn-primary" href="edit_election.php?id=<?= $row['id'] ?>">Edit</a>
    <a class="btn btn-sm btn-danger" href="delete_election.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</tbody></table>

<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>