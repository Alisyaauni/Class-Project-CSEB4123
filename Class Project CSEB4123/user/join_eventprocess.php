<html>
<head>
<title>Join Event Process</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5 border border-black">
<div class="container mt-5">

<?php
session_start();
include "../db.php";

// check login
if (!isset($_SESSION["users_id"])) {
    header("Location: login.php");
    exit();
}

$users_id = $_SESSION["users_id"];

// check category
if (!isset($_POST["category_id"]) || empty($_POST["category_id"])) {
    echo "<div class='alert alert-warning'>Please select a category.</div>";
    exit();
}

$category_id = $_POST["category_id"];

// check duplicate
$check = "SELECT * FROM registrations 
          WHERE users_id='$users_id' AND category_id='$category_id'";
$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) == 0) {

    // ✅ STEP 1: get quota
    $quota_query = "SELECT quota FROM categories WHERE category_id='$category_id'";
    $quota_result = mysqli_query($conn, $quota_query);
    $quota_row = mysqli_fetch_assoc($quota_result);
    $quota = $quota_row['quota'];

    // ✅ STEP 2: count current participants
    $count_query = "SELECT COUNT(*) as total FROM registrations WHERE category_id='$category_id'";
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $current_total = $count_row['total'];

    // ✅ STEP 3: compare
    if ($current_total >= $quota) {
        echo "<div class='alert alert-danger'>Sorry, this event is already full!</div>";
    } else {

        // insert registration
        $insert = "INSERT INTO registrations (users_id, category_id) 
                   VALUES ('$users_id', '$category_id')";

        if (mysqli_query($conn, $insert)) {
            echo "<div class='alert alert-success'>Successfully registered!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error inserting data</div>";
        }
    }

} else {
    echo "<div class='alert alert-warning'>You already registered for this category!</div>";
}
?>

</div>

<div class="container mt-5 p-1">
<a href="dashboarduser.php" class="btn btn-primary">Home</a>
</div>

</div>  
</body>
</html>