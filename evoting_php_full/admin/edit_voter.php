<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
$id = intval($_GET['id'] ?? 0); if(!$id) { header('Location: voters.php'); exit; }
if($_POST){
    $username = $_POST['username']; $fullname = $_POST['fullname']; $is_admin = isset($_POST['is_admin'])?1:0;
    if(!empty($_POST['password'])){
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = mysqli_prepare($conn, "UPDATE voters SET username=?,fullname=?,password=?,is_admin=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,"sssii",$username,$fullname,$hash,$is_admin,$id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE voters SET username=?,fullname=?,is_admin=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,"ssii",$username,$fullname,$is_admin,$id);
    }
    mysqli_stmt_execute($stmt);
    header('Location: voters.php'); exit;
}
$stmt = mysqli_prepare($conn, "SELECT * FROM voters WHERE id=?"); mysqli_stmt_bind_param($stmt,"i",$id); mysqli_stmt_execute($stmt); $res = mysqli_stmt_get_result($stmt); $row = mysqli_fetch_assoc($res);
?>
<h3>Edit Voter</h3>
<form method="POST">
  <div class="form-group"><label>Username</label><input name="username" class="form-control" value="<?=htmlspecialchars($row['username'])?>" required></div>
  <div class="form-group"><label>Full Name</label><input name="fullname" class="form-control" value="<?=htmlspecialchars($row['fullname'])?>"></div>
  <div class="form-group"><label>New Password (leave blank to keep)</label><input name="password" type="password" class="form-control"></div>
  <div class="form-group"><label><input type="checkbox" name="is_admin" <?= $row['is_admin'] ? 'checked' : '' ?>> Is Admin</label></div>
  <button class="btn btn-primary">Update</button>
</form>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>