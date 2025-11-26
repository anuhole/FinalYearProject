<?php
require_once __DIR__ . '/../inc/auth_admin.php';
$id = intval($_GET['id'] ?? 0);
if($id){
    $stmt = mysqli_prepare($conn, "DELETE FROM candidates WHERE election_id=?"); mysqli_stmt_bind_param($stmt,"i",$id); mysqli_stmt_execute($stmt);
    $stmt = mysqli_prepare($conn, "DELETE FROM votes WHERE election_id=?"); mysqli_stmt_bind_param($stmt,"i",$id); mysqli_stmt_execute($stmt);
    $stmt = mysqli_prepare($conn, "DELETE FROM elections WHERE id=?"); mysqli_stmt_bind_param($stmt,"i",$id); mysqli_stmt_execute($stmt);
}
header('Location: elections.php'); exit;
?>