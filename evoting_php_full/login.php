<?php
include "config.php";

if($_POST){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id, username, password, is_admin FROM voters WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if($res && mysqli_num_rows($res) === 1){
        $u = mysqli_fetch_assoc($res);
        $stored = $u['password'];
        $ok = false;
        if(strlen($stored) == 32 && md5($password) === $stored) $ok = true;
        if(password_verify($password, $stored)) $ok = true;

        if($ok){
            $_SESSION['uid'] = $u['id'];
            $_SESSION['admin'] = $u['is_admin'];
            if($u['is_admin']==1) header('Location: admin/dashboard.php');
            else header('Location: voter/dashboard.php');
            exit;
        }
    }
    $error = 'Invalid username or password';
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login - E-Voting</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width:420px;margin-top:80px;">
  <div class="card p-4">
    <h3 class="mb-3">E-Voting Login</h3>
    <?php if(isset($error)): ?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="POST">
      <div class="form-group"><input name="username" class="form-control" placeholder="Username" required></div>
      <div class="form-group"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
      <button class="btn btn-primary btn-block">Login</button>
    </form>
    <hr>
    <p class="small text-muted">If you don't have an admin, run <code>create_admin.php</code> once to create one.</p>
  </div>
</div>
</body>
</html>
