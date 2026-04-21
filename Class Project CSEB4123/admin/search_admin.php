<?php
session_start();
include "../db.php";

// 🔒 Protect admin
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// Search
$search = "";
if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $sql = "SELECT users.users_id, users.fullname, users.email, categories.category_name
            FROM users
            LEFT JOIN registrations 
                ON users.users_id = registrations.users_id
            LEFT JOIN categories 
                ON registrations.category_id = categories.category_id
            WHERE users.users_id LIKE '%$search%' 
            OR users.fullname LIKE '%$search%'";
} else {
    $sql = "SELECT users.users_id, users.fullname, users.email, categories.category_name
            FROM users
            LEFT JOIN registrations 
                ON users.users_id = registrations.users_id
            LEFT JOIN categories 
                ON registrations.category_id = categories.category_id";
}

$result = mysqli_query($conn, $sql);
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
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li><a href="category_crud.php">🏁 Manage Categories</a></li>
        <li><a href="view_participant.php">👥 Participants</a></li>
        <li><a href="search_admin.php">🔍 Search Participants</a></li>
    </ul>

    <a href="logout.php" class="logout">🚪 Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

 <div class="container mt-5">
    <h2>Welcome, admin!</h2>
</div>

<div style="margin-top: 20px;">
    <h3>Search Participants</h3>

    <form method="GET">
        <input type="text" name="search" placeholder="Search by ID or Name" value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<div style="margin-top: 30px;">
    <table border="1" cellpadding="10">
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Category</th>
        </tr>

        <?php
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['users_id']."</td>";
                echo "<td>".$row['fullname']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".($row['category_name'] ?? 'No Category')."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>
    </table>
</div>