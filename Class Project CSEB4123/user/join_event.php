<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Join Event</title>
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

// get categories
$sqlcategory = "SELECT * FROM categories";
$resultsqlcategory = mysqli_query($conn, $sqlcategory);
?>

<body>

<div class="container mt-5">
<form class="w-50 p-3 border border-black" method="post" action="join_eventprocess.php">

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">User ID:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["users_id"]; ?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["fullname"]; ?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["email"]; ?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $userdata["username"]; ?>" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Category:</label>
    <div class="col-sm-10">
      <select class="form-select" name="category_id" required>
        <option value="">Select Category</option>
        <?php while($categorydata = mysqli_fetch_array($resultsqlcategory, MYSQLI_BOTH)){ ?>
        <option value="<?php echo $categorydata["category_id"]; ?>">
            <?php echo $categorydata["category_name"]; ?>
        </option>
        <?php } ?>
      </select>
    </div>
  </div>  

  <button type="submit" class="btn btn-primary">Join</button>
  <a href="dashboarduser.php" class="btn btn-primary">Back</a>

</form>
</div>

</body>
</html>