<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['admin'];

/* GET ADMIN DATA */
$query = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

/* SESSION IMAGE */
if (!isset($_SESSION['profile_img'])) {
    $_SESSION['profile_img'] = "default.png";
}

/* UPDATE PROFILE */
if (isset($_POST['update'])) {

    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    if (!empty($_FILES['profile_pic']['name'])) {

        $image = time() . "_" . $_FILES['profile_pic']['name'];
        $tmp = $_FILES['profile_pic']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/" . $image);

        $_SESSION['profile_img'] = $image;
    }

    $update = "UPDATE admin 
               SET username='$new_username',
                   password='$new_password'
               WHERE username='$username'";

    if (mysqli_query($conn, $update)) {
        $_SESSION['admin'] = $new_username;
        header("Location: admin_profile.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../css/admin_profile.css">
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

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h2>Admin Profile</h2>
    </div>

 <div class="profile-wrapper">

    <div class="profile-card">

        <div class="profile-img">
            <img src="../uploads/<?php echo $_SESSION['profile_img']; ?>">
        </div>

        <form method="POST" enctype="multipart/form-data">

            <label>Username</label>
            <input type="text" name="username"
            value="<?php echo $admin['username']; ?>" required>

            <label>Password</label>
            <input type="text" name="password" value="<?php echo $admin['password']; ?>" readonly><br>
            <label>Profile Image</label>
            <input type="file" name="profile_pic">

            <button type="submit" name="update">Update Profile</button>

        </form>

    </div>

</div>
</div>

</body>
</html>