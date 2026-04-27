<?php
include("../db.php");

/* SEARCH CATEGORY */
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

/* FILTER FROM CARD CLICK */
$filterCategory = "";
if (isset($_GET['category'])) {
    $filterCategory = $_GET['category'];
}

/* MAIN QUERY */
if ($search != "") {
    $query = "
    SELECT users.users_id, users.fullname, categories.category_name
    FROM registrations
    JOIN users ON registrations.users_id = users.users_id
    JOIN categories ON registrations.category_id = categories.category_id
   WHERE categories.category_name LIKE '$search%'

    ";
} elseif ($filterCategory != "") {
    $query = "
    SELECT users.users_id, users.fullname, categories.category_name
    FROM registrations
    JOIN users ON registrations.users_id = users.users_id
    JOIN categories ON registrations.category_id = categories.category_id
    WHERE categories.category_name = '$filterCategory'
    ";
} else {
    $query = "
    SELECT users.users_id, users.fullname, categories.category_name
    FROM registrations
    JOIN users ON registrations.users_id = users.users_id
    JOIN categories ON registrations.category_id = categories.category_id
    ";
}

$result = mysqli_query($conn, $query);

/* CATEGORY COUNT (IMPORTANT: SHOW ALL EVEN 0) */
if ($search != "") {
    $countQuery = "
    SELECT categories.category_name, COUNT(registrations.users_id) AS total
    FROM categories
    LEFT JOIN registrations ON categories.category_id = registrations.category_id
    WHERE categories.category_name LIKE '$search%'
    GROUP BY categories.category_name
    ";
} else {
    $countQuery = "
    SELECT categories.category_name, COUNT(registrations.users_id) AS total
    FROM categories
    LEFT JOIN registrations ON categories.category_id = registrations.category_id
    GROUP BY categories.category_name
    ";
}


$countResult = mysqli_query($conn, $countQuery);

/* TOTAL */
$totalResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM registrations");
$totalData = mysqli_fetch_assoc($totalResult);

$catResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM categories");
$catData = mysqli_fetch_assoc($catResult);
?>


<!DOCTYPE html>
<html>
<head>
<title>Participants</title>
<link rel="stylesheet" href="../css/view_participant.css">
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
        <h2>Participants</h2>
    </div>

    <!-- SUMMARY -->
    <div class="summary-cards">
        <div class="card participants-card">
            <div class="card-title">👥 Total Participants</div>
            <div class="card-value"><?php echo $totalData['total']; ?></div>
        </div>

        <div class="card categories-card">
            <div class="card-title">🏁 Total Categories</div>
            <div class="card-value"><?php echo $catData['total']; ?></div>
        </div>
    </div>

    <!-- SEARCH CATEGORY -->
<div class="section-card">
    <form method="POST" class="search-form">

        <input type="text" name="search"
        placeholder="Search category name..."
        value="<?php echo $search; ?>">

        <div class="search-actions">
            <button type="submit">Search</button>
            <a href="view_participant.php" class="reset-btn">Reset</a>
        </div>

    </form>
</div>

    <!-- TABLE -->
     <h3>
<?php 
if ($search != "") {
    echo "Search Result: " . $search;
} elseif ($filterCategory != "") {
    echo "Category: " . $filterCategory;
} else {
    echo "Participants Per Category";
}
?>
</h3><br>


    <!-- CATEGORY CARDS -->
    <div class="category-cards">
        <?php while ($row = mysqli_fetch_assoc($countResult)) { ?>
            <div class="category-card">
    <h4><?php echo $row['category_name']; ?></h4>
    <p><?php echo $row['total']; ?> Participants</p>
</div>

        <?php } ?>
    </div>

</div>

</body>
</html>