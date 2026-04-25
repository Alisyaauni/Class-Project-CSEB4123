<html>
<head>
<title>Edit Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5 border border-black">
<div class="container mt-5">

<?php
session_start();
include "..\db.php";

// ✅ CHECK LOGIN
if (!isset($_SESSION["users_id"])) {
    header("Location: login.php");
    exit();
}

// ✅ USE SESSION (NOT POST)
$users_id = $_SESSION["users_id"];

// GET FORM DATA
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

// UPDATE QUERY
$update_sql = "UPDATE users 
               SET password = '$password', 
                   fullname = '$fullname', 
                   email = '$email', 
                   username = '$username' 
               WHERE users_id = '$users_id'";

$sql_result = mysqli_query($conn, $update_sql);

if ($sql_result) {
    // ✅ update session username if changed
    $_SESSION["username"] = $username;

    echo "<div class='alert alert-success'>Successfully updated the data.</div>";
} else {
    echo "<div class='alert alert-danger'>Error updating the data</div>";
}
?>

</div>

<div class="container mt-5 p-1">
<a href="dashboarduser.php" class="btn btn-primary">Home</a>
</div>

</div>  
</body>
</html>