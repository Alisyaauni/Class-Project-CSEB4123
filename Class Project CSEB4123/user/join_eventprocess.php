<html>
<head>
<title>Join Event Process</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5 border border-black">
<div class="container mt-5">
<?php
session_start();
include "..\db.php";

$users_id=$_SESSION["users_id"];
$category_id=$_POST["category_id"];

// check duplicate
$check = "SELECT * FROM registrations 
          WHERE users_id='$users_id' AND category_id='$category_id'";
$result = mysqli_query($conn, $check);


$insert_sql="INSERT INTO registrations (users_id , category_id) VALUES ($category, $users_id)";

$sql_result=mysqli_query($conn,$insert_sql);

if($sql_result)
echo "Succesfully register the category. ";
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