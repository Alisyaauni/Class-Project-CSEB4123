<?php
$connect = mysqli_connect("localhost", "root", "", "eventmanagement");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// check username
$check = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($connect, $check);

if (mysqli_num_rows($result) > 0) {
    echo "Error: Username already exists! <br><br>";
    echo "<a href='register_id.php'>Try again</a>";
} else {

    $sql = "INSERT INTO users (fullname, email, username, password)
            VALUES ('$fullname', '$email', '$username', '$password')";

    if (mysqli_query($connect, $sql)) {
        echo "Registration successful! <br><br>";
        echo "<a href='login.php'>Click here to login</a>";
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>