<?php
// simple admin header
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Admin - E-Voting</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style> body{padding-top:70px;} .sidebar{min-height:60vh;} </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="dashboard.php">E-Voting Admin</a>
  <div class="ml-auto">
    <a class="btn btn-sm btn-outline-light" href="../logout.php">Logout</a>
  </div>
</nav>
<div class="container-fluid"><div class="row">
<nav class="col-md-2 d-none d-md-block bg-light sidebar pt-4">
  <ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
    <li class="nav-item"><a class="nav-link" href="elections.php">Elections</a></li>
    <li class="nav-item"><a class="nav-link" href="candidates.php">Candidates</a></li>
    <li class="nav-item"><a class="nav-link" href="voters.php">Voters</a></li>
    <li class="nav-item"><a class="nav-link" href="verify_chain.php">Verify Blockchain</a></li>
    <li class="nav-item"><a class="nav-link" href="export.php">Export CSV</a></li>
  </ul>
</nav>
<main class="col-md-9 ml-sm-auto col-lg-10 px-4">
