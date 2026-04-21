<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Join Event</title>
</head>
<?php
include "..\db.php";

session_start();
/*if(isset($_SESSION["user_id"])){
    $user= $_SESSION["user_id"];
    echo "Welcome $user";
}*/

//creating temporary session first
$_SESSION["users_id"] = 1;
$_SESSION['username'] = "testuser";


//get data from database using sql query

$users_id = $_SESSION["users_id"];

$sql = "SELECT * FROM users WHERE users_id = '$users_id' ";
//execute sql statement
$result = mysqli_query($conn, $sql);
//convert the data to array form
$userdata = mysqli_fetch_array($result,MYSQLI_BOTH);

//getting data from table categories
$sqlcategory = "SELECT * FROM categories";
//execute statement
$resultsqlcategory = mysqli_query($conn, $sqlcategory);
//convert data into array form


?>
<body>

<div class="container mt-5">
<form class="w-50 p-3 border border-black" name="insertdata-process" method="post" action="join_eventprocess.php">
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">User ID:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputName" name="users_id" value="<?php echo $userdata["users_id"]; ?>" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputName" name="fullname" value="<?php echo $userdata["fullname"]; ?>" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" value="<?php echo $userdata["email"]; ?>" readonly>
    </div>
  </div>
    <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" value="<?php echo $userdata["username"]; ?>" readonly>
    </div>
  </div>
    <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Category:</label>
    <div class="col-sm-10">
      <select class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <?php while($categorydata = mysqli_fetch_array($resultsqlcategory, MYSQLI_BOTH)){ ?>;
        <option name="category_id" value="<?php echo $categorydata["category_id"];?>">
            <?php echo $categorydata["category_name"];?>
        </option>
        <?php } ?>
      </select>
    </div>
  </div>  
   <button type="submit" class="btn btn-primary" value="Submit">Join</button>
</form>
</div>

</body>
</html>