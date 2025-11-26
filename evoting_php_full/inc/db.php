<?php
$host = "localhost";
$user = "root";      // default XAMPP username
$pass = "";          // default XAMPP password
$db   = "evoting";   // your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>

