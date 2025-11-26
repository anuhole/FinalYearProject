<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
$id = intval($_GET['id'] ?? 0); if(!$id) { header('Location: candidates.php'); exit; }
if($_POST){
    $name = $_POST['name']; $election_id = intval($_POST['election_id']);
    $stmt = mysqli_prepare($conn, "UPDATE candidates SET name=?, election_id=? WHERE id=?"); mysqli_stmt_bind_param($stmt,"sii",$name,$election_id,$id); mysqli_stmt_execute($stmt);
    header('Location: candidates.php'); exit;
}
$stmt = mysqli_prepare($conn, "SELECT * FROM candidates WHERE id=?"); mysqli_stmt_bind_param($stmt,"i",$id); mysqli_stmt_execute($stmt); $res = mysqli_stmt_get_result($stmt); $row = mysqli_fetch_assoc($res);
$stmtE = mysqli_prepare($conn, "SELECT id,title FROM elections"); mysqli_stmt_execute($stmtE); $elections = mysqli_stmt_get_result($stmtE);
?>
<h3>Edit Candidate</h3>
<form method="POST">
  <div class="form-group"><label>Name</label><input name="name" class="form-control" value="<?=htmlspecialchars($row['name'])?>" required></div>
  <div class="form-group"><label>Election</label><select name="election_id" class="form-control"><?php while($re = mysqli_fetch_assoc($elections)): ?><option value="<?= $re['id'] ?>" <?= $re['id']==$row['election_id']?'selected':'' ?>><?= htmlspecialchars($re['title']) ?></option><?php endwhile; ?></select></div>
  <button class="btn btn-primary">Update</button>
</form>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>