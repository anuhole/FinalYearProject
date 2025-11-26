<!DOCTYPE html>
<html>
<head>
<title>Voter Panel</title>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg, #0066ff, #00c3ff);
        min-height: 100vh;
    }

    /* Clean Top Navigation */
    .nav-bar {
        width: 100%;
        background: #ffffffcc;
        backdrop-filter: blur(6px);
        padding: 12px 25px;
        display: flex;
        justify-content: center;
        gap: 40px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 10;
        border-radius: 0 0 15px 15px;
    }

    .nav-bar a {
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        color: #004aad;
        transition: 0.2s;
    }

    .nav-bar a:hover {
        color: #002f7a;
        transform: translateY(-2px);
    }

</style>
</head>

<body>

<!-- Clean Top Navigation -->
<div class="nav-bar">
    <a href="dashboard.php">Dashboard</a>
    <a href="elections.php">Elections</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
</div>
