
<?php
session_start();
include "../inc/db.php";

// Handle form submit
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $election_id = intval($_POST['election_id']);

    if ($name === "" || $election_id === 0) {
        $message = "<p style='color:red;'>Please fill all fields.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO candidates (name, election_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $election_id);

        if ($stmt->execute()) {
            $message = "<p style='color:green;'>Candidate added successfully!</p>";
        } else {
            $message = "<p style='color:red;'>Error adding candidate.</p>";
        }
    }
}

// Fetch elections for dropdown
//$elections = $conn->query("SELECT id, title FROM elections WHERE status='Active'");
//$elections = $conn->query("SELECT id, title FROM elections WHERE status='Active'");
$elections = $conn->query("SELECT id, title FROM elections");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Candidate</title>
    <style>
        body { font-family: Arial; background:#f5f5f5; padding:40px; }
        .card {
            width:400px; margin:auto; background:#fff; padding:20px;
            border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1);
        }
        input, select {
            width:100%; padding:10px; margin-top:10px;
            border:1px solid #ccc; border-radius:4px;
        }
        button {
            margin-top:15px; width:100%; padding:10px;
            background:#007bff; border:none; color:white; 
            border-radius:4px; font-size:16px;
            cursor:pointer;
        }
        button:hover { background:#0056b3; }
        h2 { text-align:center; }
    </style>
</head>
<body>

<div class="card">
    <h2>Add Candidate</h2>

    <?= $message ?>

    <form method="POST">

        <label>Candidate Name</label>
        <input type="text" name="name" placeholder="Enter candidate name" required>

        <label>Select Election</label>
        <select name="election_id" required>
            <option value="">-- Select Election --</option>

            <?php while ($e = $elections->fetch_assoc()): ?>
                <option value="<?= $e['id'] ?>">
                    <?= $e['title'] ?>
                </option>
            <?php endwhile; ?>

        </select>

        <button type="submit">Save Candidate</button>
    </form>
</div>

</body>
</html>
