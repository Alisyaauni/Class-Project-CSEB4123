<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/admindashboard.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2 class="logo">🏃 RunAdmin</h2>

    <ul>
        <li><a href="#">🏠 Dashboard</a></li>
        <li><a href="category_crud.php">🏁 Manage Categories</a></li>
        <li><a href="view_participant.php">👥 Participants</a></li>
        <li><a href="search_admin.php">🔍 Search Participants</a></li>
    </ul>

    <a href="logout.php" class="logout">🚪 Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <!-- TOP NAVBAR -->
    <div class="topbar">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>

        <!-- ADMIN PROFILE -->
        <div class="profile">
            <span>👤 Admin</span>
            <div class="dropdown">
                <a href="admin_profile.php">View Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- DASHBOARD CARDS (your original content) -->
    <div class="grid">

        <a href="category_crud.php" class="card">
            <div class="icon">🏁</div>
            <h3>Manage Categories</h3>
        </a>

        <a href="view_participant.php" class="card">
            <div class="icon">👥</div>
            <h3>View Participants</h3>
        </a>

        <a href="search_admin.php" class="card">
            <div class="icon">🔍</div>
            <h3>Search Participants</h3>
        </a>

    </div>

</div>

</body>
</html>