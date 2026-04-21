<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// ADD
if (isset($_POST['add'])) {
    $name = $_POST['category_name'];
    $quota = $_POST['quota'];

    $stmt = $conn->prepare("INSERT INTO categories (category_name, quota) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $quota);
    $stmt->execute();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM categories WHERE category_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['category_id'];
    $name = $_POST['category_name'];
    $quota = $_POST['quota'];

    $stmt = $conn->prepare("UPDATE categories SET category_name=?, quota=? WHERE category_id=?");
    $stmt->bind_param("sii", $name, $quota, $id);
    $stmt->execute();
}
// SEARCH
$search = "";

if (isset($_POST['search'])) {
    $search = $_POST['category_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Categories</title>
<link rel="stylesheet" href="../css/category_crud.css">
</head>

<body>


<!-- SIDEBAR -->
<div class="sidebar">
    <h2 class="logo">🏃 RunAdmin</h2>

    <ul>
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li><a href="category_crud.php">🏁 Manage Categories</a></li>
        <li><a href="view_participant.php">👥 Participants</a></li>
        <li><a href="search_admin.php">🔍 Search Participants</a></li>
    </ul>

    <a href="logout.php" class="logout">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h2>Manage Categories</h2>
    </div>

    <!-- ADD FORM -->
    <div class="form-card">
       <form method="POST">
    <input type="text" name="category_name" placeholder="Category Name" required>
    <input type="number" name="quota" placeholder="Quota" required>

    <button type="submit" name="search" formnovalidate>Search</button>
    <button type="submit" name="add">Add</button>
</form>

        </form>
    </div>

    <!-- TABLE -->
    <div class="table-card">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quota</th>
                <th>Action</th>
            </tr>

            <?php
            
           if ($search != "") {
    $result = mysqli_query($conn, "
        SELECT * FROM categories 
        WHERE category_name LIKE '%$search%' 
        OR category_id LIKE '%$search%'
    ");
} else {
    $result = mysqli_query($conn, "SELECT * FROM categories");
}
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['category_id']; ?></td>

                <td>
                    <input type="text" name="category_name"
                    value="<?php echo $row['category_name']; ?>"
                    form="form-<?php echo $row['category_id']; ?>">
                </td>

                <td>
                    <input type="number" name="quota"
                    value="<?php echo $row['quota']; ?>"
                    form="form-<?php echo $row['category_id']; ?>">
                </td>

                <td>
                    <form method="POST" id="form-<?php echo $row['category_id']; ?>" style="display:inline;">
                        <input type="hidden" name="category_id"
                        value="<?php echo $row['category_id']; ?>">

                        <button class="update-btn" name="update">Update</button>
                    </form>

                    <a class="delete-btn"
                       href="?delete=<?php echo $row['category_id']; ?>">
                       Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>