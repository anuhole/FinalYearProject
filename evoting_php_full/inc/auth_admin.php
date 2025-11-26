<?php
include_once __DIR__ . '/../config.php';
if (!isset($_SESSION['uid'])) {
    header('Location: ../login.php'); exit;
}
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    echo 'Access denied. Admins only.'; exit;
}
?>