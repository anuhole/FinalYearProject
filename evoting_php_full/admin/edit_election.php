<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
$id = intval($_GET['id'] ?? 0); if(!$id) { header('Location: elections.php'); exit; }
if($_POST){
    $title = $_POST['title']; $start = $_POST['start_at']; $end = $_POST['end_at']; $status = $_POST['status'];
    $stmt = mysqli_prepare($conn, "UPDATE elections SET title=?,start_at=?,end_at=?,status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $start, $end, $status, $id); mysqli_stmt_execute($stmt);
    header('Location: elections.php'); exit;
}
$stmt = mysqli_prepare($conn, "SELECT * FROM elections WHERE id=?"); mysqli_stmt_bind_param($stmt, "i", $id); mysqli_stmt_execute($stmt); $res = mysqli_stmt_get_result($stmt); $row = mysqli_fetch_assoc($res);
?>
<h3>Edit Election</h3>
<form method="POST">
  <div class="form-group"><label>Title</label><input name="title" class="form-control" value="<?=htmlspecialchars($row['title'])?>" required></div>
  <div class="form-group"><label>Start At</label><input name="start_at" type="datetime-local" class="form-control" value="<?= date('Y-m-d\TH:i',strtotime($row['start_at'])) ?>" required></div>
  <div class="form-group"><label>End At</label><input name="end_at" type="datetime-local" class="form-control" value="<?= date('Y-m-d\TH:i',strtotime($row['end_at'])) ?>" required></div>
  <div class="form-group"><label>Status</label><select name="status" class="form-control"><option <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option><option <?= $row['status']=='Ongoing'?'selected':'' ?>>Ongoing</option><option <?= $row['status']=='Completed'?'selected':'' ?>>Completed</option></select></div>
  <button class="btn btn-primary">Update</button>
</form>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>