<?php
$connect = mysqli_connect("localhost", "root", "", "project");

if (!$connect) { 
    die("Connection failed: " . mysqli_connect_error()); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $age      = $_POST['age'];
    $gender   = $_POST['gender'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];


    $sql = "INSERT INTO registrations (fullname, age, gender, phone, email)
            VALUES ('$fullname', '$age', '$gender', '$phone', '$email')";

    if (mysqli_query($connect, $sql)) {
        echo "<h2>Registration Successful!</h2>";
        echo "<b>Full Name:</b> $fullname <br><br>";
        echo "<b>Age:</b> $age <br><br>";
        echo "<b>Gender:</b> $gender <br><br>";
        echo "<b>Phone Number:</b> $phone <br><br>";
        echo "<b>Email Address:</b> $email <br><br>";
        echo "<a href='logout.php'>Logout</a>";
    } else {
        echo "Error: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>