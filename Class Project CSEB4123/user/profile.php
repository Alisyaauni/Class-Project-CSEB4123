<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include "../db.php";

session_start();

// FIX: check login
if (!isset($_SESSION["users_id"])) {
    header("Location: login.php");
    exit();
}

// use real logged-in user
$users_id = $_SESSION["users_id"];

// get user data
$sql = "SELECT * FROM users WHERE users_id = '$users_id'";
$result = mysqli_query($conn, $sql);
$userdata = mysqli_fetch_array($result, MYSQLI_BOTH);
?>

<body>

<div class="container mt-5">
<h2>Welcome Hi, <?php echo $userdata["username"];?></h2>
</div>

<div class="container mt-5">
<form class="w-50 p-3 border border-black" method="post" action="profileprocess.php">

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">User ID:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["users_id"]; ?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="fullname" value="<?php echo $userdata["fullname"]; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" value="<?php echo $userdata["email"]; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" value="<?php echo $userdata["username"]; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="password" value="<?php echo $userdata["password"]; ?>">
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Update</button>

</form>
</div>

</body>
</html>