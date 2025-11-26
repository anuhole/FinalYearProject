<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
if($_POST){
    $title = $_POST['title']; $start = $_POST['start_at']; $end = $_POST['end_at']; $status = $_POST['status'];
    $stmt = mysqli_prepare($conn, "INSERT INTO elections (title,start_at,end_at,status) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "ssss", $title, $start, $end, $status); mysqli_stmt_execute($stmt);
    header('Location: elections.php'); exit;
}
?>
<h3>Add Election</h3>
<form method="POST">
  <div class="form-group"><label>Title</label><input name="title" class="form-control" required></div>
  <div class="form-group"><label>Start At</label><input name="start_at" type="datetime-local" class="form-control" required></div>
  <div class="form-group"><label>End At</label><input name="end_at" type="datetime-local" class="form-control" required></div>
  <div class="form-group"><label>Status</label><select name="status" class="form-control"><option>Pending</option><option>Ongoing</option><option>Completed</option></select></div>
  <button class="btn btn-primary">Create</button>
</form>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>