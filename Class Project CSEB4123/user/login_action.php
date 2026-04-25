<?php
session_start();
include "../db.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // STORE REAL USER DATA
        $_SESSION['users_id'] = $user['users_id'];
        $_SESSION['username'] = $user['username'];

        header("Location: dashboarduser.php");
        exit();

    } else {
        echo "Invalid username or password!<br>";
        echo "<a href='login.php'>Try again</a>";
    }

} else {
    echo "Please fill in all fields.";
}
?>