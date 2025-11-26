<?php
require_once __DIR__ . '/../inc/auth_admin.php';
$id = intval($_GET['id'] ?? 0);
if($id){
    $stmt = mysqli_prepare($conn, "DELETE FROM voters WHERE id=?"); mysqli_stmt_bind_param($stmt,"i",$id); mysqli_stmt_execute($stmt);
}
header('Location: voters.php'); exit;
?>