<?php
session_start();
include "../inc/db.php";

// Check admin login (optional)
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch elections
$elections = $conn->query("SELECT id, title FROM elections ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Election Results</title>
    <style>
        body { font-family: Arial; background:#f0f4f8; padding:20px; }
        .box { background:#fff; padding:16px; border-radius:10px; max-width:900px; margin:auto; }
        h2 { margin-top:0; }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { padding:10px; border-bottom:1px solid #ddd; text-align:left; }
        th { background:#1e3a8a; color:white; }
        .select-box { padding:8px; width:250px; }
    </style>
</head>

<body>
<div class="box">
    <h2>Election Results</h2>

    <!-- Select Election -->
    <form method="GET">
        <label><strong>Select Election:</strong></label><br>
        <select name="election_id" class="select-box" required>
            <option value="">-- Choose Election --</option>

            <?php while($e = $elections->fetch_assoc()): ?>
                <option value="<?= $e['id'] ?>" 
                <?= (isset($_GET['election_id']) && $_GET['election_id'] == $e['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e['title']) ?>
                </option>
            <?php endwhile; ?>

        </select>
        <button type="submit">View</button>
    </form>

    <?php
    if (isset($_GET['election_id'])):
        $e_id = intval($_GET['election_id']);

        // Fetch candidates
        $stmt = $conn->prepare("
            SELECT c.id, c.name,
            (SELECT COUNT(*) FROM votes WHERE candidate_id = c.id) AS vote_count
            FROM candidates c
            WHERE c.election_id = ?
        ");
        $stmt->bind_param("i", $e_id);
        $stmt->execute();
        $candidates = $stmt->get_result();
    ?>

    <h3 style="margin-top:30px;">Results:</h3>

    <table>
        <tr>
            <th>Candidate</th>
            <th>Votes</th>
        </tr>

        <?php 
        $total = 0;
        while($c = $candidates->fetch_assoc()):
            $total += $c['vote_count'];
        ?>
        <tr>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= $c['vote_count'] ?></td>
        </tr>
        <?php endwhile; ?>

        <tr>
            <th>Total Votes</th>
            <th><?= $total ?></th>
        </tr>

    </table>

    <?php endif; ?>

</div>
</body>
</html>
