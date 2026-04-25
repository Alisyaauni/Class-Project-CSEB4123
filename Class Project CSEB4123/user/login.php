<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Run - User Login</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="logbox">

    <h1>Login to Sport Run Event</h1><br></br>

    <form action="login_action.php" method="post">

        <div class="username">
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="password">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">Login</button>

    </form>

    <p>Don't have an account? <a href="register_id.php">Register Account</a></p><br></br>

    <div class="tab-header">
        <a href="../admin/login.php" class="tab-btn">Admin Login</a>
    </div>
</body>
</html>
