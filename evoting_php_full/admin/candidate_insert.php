<?php
include "../inc/db.php";

if (!isset($_POST['name'], $_POST['election_id'])) {
    die("Invalid submission.");
}

$name = $_POST['name'];
$election_id = intval($_POST['election_id']);

$stmt = $conn->prepare("INSERT INTO candidates (name, election_id) VALUES (?, ?)");
$stmt->bind_param("si", $name, $election_id);

if ($stmt->execute()) {
    echo "Candidate Added Successfully!";
} else {
    echo "Error: " . $stmt->error;
}
?>
