<?php
include 'config.php';
if($_POST){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conn, "INSERT INTO voters (username,password,fullname,is_admin) VALUES (?,?,?,1)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $hash, $fullname);

    if(mysqli_stmt_execute($stmt)){
        echo "<div style='
            background:#fff;
            padding:20px;
            width:360px;
            margin:120px auto;
            text-align:center;
            border-radius:12px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            font-family:Arial;'>
            <p style='font-size:20px;color:green;'>Admin Created Successfully ✔</p>
            <a href='login.php' style='color:#0b5ed7;font-size:16px;text-decoration:none;'>Go to Login</a>
        </div>";
        exit;
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create Admin</title>

<style>
body {
    background: #f8f9fa;
    font-family: Arial, sans-serif;
    margin: 0;
}

.box {
    width: 380px;
    margin: 120px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 0 16px rgba(0,0,0,0.08);
}

h3 {
    text-align: center;
    margin-bottom: 18px;
    color: #0f172a;
}

label {
    font-size: 14px;
    color: #334155;
    display: block;
    margin-top: 12px;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 15px;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    background: #0b5ed7;
    color: white;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #0949ad;
}
</style>

</head>
<body>

<div class="box">
    <h3>Create Admin</h3>

    <form method="POST">
        <label>Username</label>
        <input name="username" required>

        <label>Password</label>
        <input name="password" required type="password">

        <label>Full Name</label>
        <input name="fullname">

        <button type="submit">Create Admin</button>
    </form>
</div>

</body>
</html>
