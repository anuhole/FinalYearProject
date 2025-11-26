<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Voter Login</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Inter", Arial, sans-serif;
        background: #ffffff; /* pure white */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .box {
        width: 360px;
        background: #ffffff;
        padding: 32px;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        text-align: center;
    }

    h2 {
        margin: 0 0 20px;
        font-size: 26px;
        color: #1e293b;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 15px;
        transition: 0.2s;
    }
    input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 4px rgba(37,99,235,0.4);
    }

    button {
        width: 100%;
        padding: 12px;
        background: #2563eb;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.2s;
    }
    button:hover {
        background: #1d4ed8;
    }

    .error {
        color: #dc2626;
        margin-top: 12px;
        font-size: 14px;
    }
</style>
</head>

<body>
<div class="box">
    <h2>Voter Login</h2>

    <form method="POST" action="auth.php">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>

    <?php
    if (!empty($_SESSION['error'])) {
        echo "<p class='error'>" . htmlspecialchars($_SESSION['error']) . "</p>";
        unset($_SESSION['error']);
    }
    ?>
</div>
</body>
</html>
