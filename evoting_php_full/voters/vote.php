<?php
session_start();
include __DIR__ . '/../inc/db.php';

if (!isset($_SESSION['voter_id'])) { 
    header("Location: login.php"); 
    exit; 
}

$election_id = intval($_GET['election_id'] ?? 0);
if ($election_id <= 0) { 
    header("Location: elections.php"); 
    exit; 
}

// Check election status
$es = $conn->prepare("SELECT title, status FROM elections WHERE id=?");
$es->bind_param("i", $election_id);
$es->execute();
$election = $es->get_result()->fetch_assoc();

if (!$election || $election['status'] !== 'Ongoing') {
    die("This election is not open.");
}

// Check if already voted
$check = $conn->prepare("SELECT id FROM votes WHERE voter_id=? AND election_id=?");
$check->bind_param("ii", $_SESSION['voter_id'], $election_id);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    die("<p style='text-align:center;padding:24px;font-family:Inter;'>You have already voted in this election.</p>");
}

// Fetch candidates
//$stmt = $conn->prepare("SELECT id, name, party FROM candidates WHERE election_id=?");
$stmt = $conn->prepare("SELECT id, name FROM candidates WHERE election_id=?");

$stmt->bind_param("i", $election_id);
$stmt->execute();
$candidates = $stmt->get_result();

// Store count before loop (Fix)
$candidate_count = $candidates->num_rows;
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Vote</title>
<style>
 body{font-family:Inter,Arial;background:#f7fafc;margin:0;padding:28px;display:flex;justify-content:center}
 .wrap{max-width:900px;width:100%}
 .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px}
 .card{background:#fff;padding:18px;border-radius:12px;border:1px solid #eef5ff;text-align:center}
 .name{font-weight:600;color:#0f172a}
 .party{color:#64748b;margin-top:6px}
 .vote-btn{margin-top:12px;}
 button{padding:8px 12px;background:#0b5ed7;color:#fff;border:none;border-radius:8px;cursor:pointer}
</style>
</head>
<body>
  <div class="wrap">
    <h2 style="margin:0 0 14px;color:#0f172a">Choose Candidate</h2>
    <div class="grid">

      <?php if ($candidate_count > 0): ?>
          <?php while ($c = $candidates->fetch_assoc()): ?>
            <div class="card">
              <div class="name"><?= htmlspecialchars($c['name']) ?></div>
             
             <div class="party"><?= isset($c['party']) ? htmlspecialchars($c['party']) : '' ?></div>

              <form method="post" action="vote_submit.php" class="vote-btn">
                <input type="hidden" name="election_id" value="<?= $election_id ?>">
                <input type="hidden" name="candidate_id" value="<?= $c['id'] ?>">
                <button type="submit">Vote</button>
              </form>

            </div>
          <?php endwhile; ?>
      <?php else: ?>
        <div style="grid-column:1/-1;background:#fff;padding:20px;border-radius:12px;border:1px solid #eef5ff;text-align:center;color:#64748b">
          No candidates for this election.
        </div>
      <?php endif; ?>

    </div>
  </div>
</body>
</html>
