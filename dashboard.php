<?php
require_once '../config.php';

if (!is_admin()) { 
    header('Location: login.php');
    exit; 
}

$items = $pdo->query("SELECT COUNT(*) FROM menu_items")->fetchColumn();
$categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$reservations = $pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/project.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <h2>Urban Spice Admin</h2>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="dashboard-container">
        <h1 >Dashboard</h1>
        <p>Manage your restaurant</p>
        <br>

        <div class="grid">
            <div class="cards">
                <img src="../images/menu.jpg" alt="Menu Items"><h3><?php echo $items; ?></h3>
                <p>Menu Items</p>
            </div>
            <div class="cards">
                <img src="../images/category.jpg" alt="Categories"><h3><?php echo $categories; ?></h3>
                <p>Categories</p>
            </div>
            <div class="cards">
                <img src="../images/reservation.jpg" alt="Reservations"><h3><?php echo $reservations; ?></h3>
                <p>Reservations</p>
            </div>
        </div>

        <div class="section">
            <h2>Quick Actions</h2>
            <div class="grid">
                <a href="addMenu.php" class="addButton">Add Menu Item</a>
            </div>
        </div>

        <div class="section">
            <h2>Management</h2>
            <a href="manageMenu.php" class="link">Manage Menu Items</a>
        </div>
    </div>
</body>
</html>