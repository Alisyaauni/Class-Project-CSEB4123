<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard User</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<?php
include "../db.php";

session_start();

/* ✅ FIX: check session instead of forcing user */
if (!isset($_SESSION["users_id"])) {
    header("Location: login.php");
    exit();
}

// ✅ FIX: use logged-in user ID from session
$users_id = $_SESSION["users_id"];


//get data from database using sql query
$sql = "SELECT * FROM users WHERE users_id = '$users_id' ";
$result = mysqli_query($conn, $sql);
$userdata = mysqli_fetch_array($result,MYSQLI_BOTH);


//get registered events
$sql2 = "SELECT categories.category_name 
        FROM registrations
        JOIN categories 
        ON registrations.category_id = categories.category_id
        WHERE registrations.users_id = '$users_id'";

$result2 = mysqli_query($conn, $sql2);
?>

<body>
<div class="container mt-5">
<h2>Welcome Hi, <?php echo $userdata["username"];?></h2>
</div>

<div class="container mt-5">
<form class="w-50 p-3 border border-black">
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">User ID:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputName" value="<?php echo $userdata["users_id"]; ?>" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputName" value="<?php echo $userdata["fullname"]; ?>" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["email"]; ?>"readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["username"]; ?>"readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["password"]; ?>"readonly>
    </div>
  </div>
  <a href="profile.php" class="btn btn-primary">Edit Info</a>
</form>
</div>

<!--for the events joined part-->
<div class="container mt-5">
<div class="border border-black w-50 p-3">
  <p>Events Joined:</p>
<ol>
  <?php while($userdata2= mysqli_fetch_array($result2, MYSQLI_BOTH)){ ?>
  <li><?php echo $userdata2["category_name"] ?></li>
  <?php } ?>
</ol>

<a href="join_event.php" class="btn btn-primary">Join More</a>
<a href="logout.php" class="btn btn-primary">Logout</a>
</div>
</div>

</body>
</html>