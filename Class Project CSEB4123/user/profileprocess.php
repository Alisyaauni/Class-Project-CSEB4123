<html>
<head>
<title>Edit Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5 border border-black">
<div class="container mt-5">
<?php
include "C:\wamp64\www\Class Project CSEB4123\db.php";


$fullname=$_POST["fullname"];
$users_id=$_POST["users_id"];
$email=$_POST["email"];
$username=$_POST["username"];
$password=$_POST["password"];

$update_sql="UPDATE users SET password = '$password', fullname = '$fullname', email = '$email', username = '$username' WHERE users_id = '$users_id'";

$sql_result=mysqli_query($conn,$update_sql);

if($sql_result)
echo "Succesfully update the data. ";
else
echo "Error in updating the data";
?>
</div>
<div class="container mt-5 p-1">
<a href="dashboarduser.php" class="btn btn-primary">Home</a>
</div>
</div>  
</body>
</html>