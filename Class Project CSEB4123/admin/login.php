<?php
session_start();
include("../db.php");

$error = ""; // variable to store error message

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // simple query (easy to explain)
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin_login.css">
</head>
<body>

<div class="login-card">

    <h2>Welcome, Admin!</h2>

    <!-- Show error message -->
    <?php if($error != "") { ?>
        <script>
            alert("<?php echo $error; ?>");
        </script>
    <?php } ?>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login" class="login-btn">Login</button>

        <button type="reset" class="refresh-btn">Reset</button>

    </form>

</div>

</body>
</html>