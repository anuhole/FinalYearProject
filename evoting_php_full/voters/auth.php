<?php
session_start();
include "../inc/db.php";

// Ensure POST fields exist
if (!isset($_POST['username'], $_POST['password'])) {
    $_SESSION['error'] = "Invalid form submission.";
    header("Location: login.php");
    exit;
}

$u = $_POST['username'];
$p = $_POST['password'];

// Prepare query
$stmt = $conn->prepare("SELECT id, username, password FROM voters WHERE username = ?");
$stmt->bind_param("s", $u);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 1) {
    $v = $res->fetch_assoc();

    // Verify password
    if (password_verify($p, $v['password'])) {
        $_SESSION['voter_id'] = $v['id'];
        $_SESSION['name'] = $v['username'];
        header("Location: dashboard.php");
        exit;
    }
}

// If login fails
$_SESSION['error'] = "Invalid username or password.";
header("Location: login.php");
exit;
