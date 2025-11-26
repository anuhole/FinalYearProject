<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
if($_POST){
    $username = $_POST['username']; $fullname = $_POST['fullname']; $pwd = $_POST['password']; $is_admin = isset($_POST['is_admin'])?1:0;
    $hash = password_hash($pwd, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conn, "INSERT INTO voters (username,password,fullname,is_admin) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"sssi",$username,$hash,$fullname,$is_admin); mysqli_stmt_execute($stmt);
    header('Location: voters.php'); exit;
}
?>
<h3>Add Voter</h3>
<form method="POST">
  <div class="form-group"><label>Username</label><input name="username" class="form-control" required></div>
  <div class="form-group"><label>Full Name</label><input name="fullname" class="form-control"></div>
  <div class="form-group"><label>Password</label><input name="password" type="password" class="form-control" required></div>
  <div class="form-group"><label><input type="checkbox" name="is_admin"> Is Admin</label></div>
  <button class="btn btn-primary">Create</button>
</form>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>