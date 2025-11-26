
<?php
// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$db   = "evoting";

// Create connection using mysqli
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Start the session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
