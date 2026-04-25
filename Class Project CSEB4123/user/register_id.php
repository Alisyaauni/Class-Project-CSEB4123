<!DOCTYPE html>
<html>
<head>
    <title>Register ID</title>
    <link rel="stylesheet" href="register_id.css">
</head>
<body>

<div class="first">
    <h2>Create Account</h2>

    <form action="register_action.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="text" name="fullname" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>

        <input type="reset" value="Reset" class="button-reset"><br><br>
        <input type="submit" value="Register" class="button-submit">
        
    </form>

    <p>Already have an account?
        <a href="login.php">Login here</a>
    </p>
</div>

</body>
</html>
