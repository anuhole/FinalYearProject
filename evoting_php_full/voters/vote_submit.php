<?php
session_start();
include "../inc/db.php";

if (!isset($_SESSION['voter_id'])) {
    header("Location: login.php");
    exit;
}

// Ensure request method is POST only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request.");
}

// Validate required POST fields
if (empty($_POST['election_id']) || empty($_POST['candidate_id'])) {
    die("Missing parameters.");
}

$voter     = $_SESSION['voter_id'];
$election  = intval($_POST['election_id']);
$candidate = intval($_POST['candidate_id']);

// Validate election exists and is ongoing
$es = $conn->prepare("SELECT status FROM elections WHERE id=?");
$es->bind_param("i", $election);
$es->execute();
$edata = $es->get_result()->fetch_assoc();

if (!$edata) {
    die("Election not found.");
}

if ($edata['status'] !== 'Ongoing') {
    die("This election is not open for voting.");
}

// Check if candidate belongs to this election
$cs = $conn->prepare("SELECT id FROM candidates WHERE id=? AND election_id=?");
$cs->bind_param("ii", $candidate, $election);
$cs->execute();
if ($cs->get_result()->num_rows === 0) {
    die("Invalid candidate.");
}

// Check if user already voted
$chk = $conn->prepare("SELECT id FROM votes WHERE voter_id=? AND election_id=?");
$chk->bind_param("ii", $voter, $election);
$chk->execute();
if ($chk->get_result()->num_rows > 0) {
    die("You have already voted in this election.");
}

// Insert vote
$ins = $conn->prepare("INSERT INTO votes (voter_id, election_id, candidate_id) VALUES (?, ?, ?)");
$ins->bind_param("iii", $voter, $election, $candidate);

if ($ins->execute()) {
    $_SESSION['success'] = "Your vote has been submitted!";
    header("Location: dashboard.php");
    exit;
} else {
    die("Error submitting vote.");
}
?>
