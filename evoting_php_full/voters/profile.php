<?php
session_start();
include __DIR__ . '/../inc/db.php';
if (!isset($_SESSION['voter_id'])) { header("Location: login.php"); exit; }

$stmt = $conn->prepare("SELECT username,name,status FROM voters WHERE id=?");
$stmt->bind_param("i", $_SESSION['voter_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Profile</title>
<style>body{font-family:Inter,Arial;background:#f7fafc;margin:0;padding:28px} .card{max-width:640px;margin:0 auto;background:#fff;padding:20px;border-radius:12px;border:1px solid #eef5ff}</style>
</head><body>
  <div class="card">
    <h2>Profile</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($user['status']) ?></p>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
  </div>
</body></html>
