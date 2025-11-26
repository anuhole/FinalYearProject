<?php
session_start();
include "../inc/db.php";

// Redirect if not logged in
if (!isset($_SESSION['voter_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch elections safely
$stmt = $conn->prepare("SELECT id, title FROM elections WHERE status = 'Ongoing'");
$stmt->execute();
$elections = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voter Dashboard</title>
    <style>
        body {
            font-family: 'Inter', Arial;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .header {
            background: #ffffff;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            font-size: 22px;
            color: #111827;
            font-weight: 600;
        }

        .logout {
            padding: 8px 14px;
            background: #ef4444;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 10px;
        }

        h2 {
            color: #0f172a;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.05);
            transition: 0.2s;
            border: 1px solid #e5e7eb;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 20px rgba(0,0,0,0.12);
        }

        .election-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .vote-btn {
            display: inline-block;
            padding: 10px 14px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .vote-btn:hover {
            background: #1d4ed8;
        }

        .no-election {
            text-align: center;
            padding: 25px;
            background: white;
            border-radius: 12px;
            color: #6b7280;
        }
    </style>
</head>

<body>

<div class="header">
    <div class="title">Voter Dashboard</div>
    <a class="logout" href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>
    <h3 style="color:#334155;">Available Elections</h3>

    <div class="grid">
        <?php if ($elections->num_rows > 0): ?>
            <?php while($e = $elections->fetch_assoc()): ?>
                <div class="card">
                    <div class="election-title"><?= htmlspecialchars($e['title']) ?></div>
                    <a href="vote.php?election_id=<?= urlencode($e['id']) ?>" class="vote-btn">Vote Now</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-election">No ongoing elections at the moment.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
