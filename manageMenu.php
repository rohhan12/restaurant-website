<?php
require_once '../config.php';

if (!is_admin()) {
    header('Location: login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->execute([$delete_id]);
    header('Location: manageMenu.php');
    exit;
}

$items = $pdo->query("SELECT menu_items.*, categories.name AS cat_name FROM menu_items 
    JOIN categories ON menu_items.category_id = categories.id 
    ORDER BY categories.name, menu_items.name")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Menu Items</title>
    <link rel="stylesheet" href="../css/project.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Urban Spice Admin</h1>
            <a href="dashboard.php" class="backButton">Dashboard</a>
        </div>
    </header>

    <div class="content">
        <div class="page-header">
            <h2>Manage Menu Items</h2>
            <a href="addMenu.php" class="addButton">Add New Item</a>
        </div>

        <div class="table-box">
            <?php if (count($items) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td>
                            <?php if ($item['image_url']): ?>
                                <img src="../<?= htmlspecialchars($item['image_url']) ?>" class="item-img">
                            <?php else: ?>
                                <div class="no-img"></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="item-name"><?= htmlspecialchars($item['name']) ?></div>
                            <?php if ($item['description']): ?>
                                <div class="item-description">
                                    <?= htmlspecialchars(substr($item['description'], 0, 50)) ?>
                                    <?= strlen($item['description']) > 50 ? '...' : '' ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                           <?= htmlspecialchars($item['cat_name']) ?>
                        </td>
                        <td class="price">$<?= number_format($item['price'], 2) ?></td>
                        <td>
                            <a href="editMenu.php?id=<?= $item['id'] ?>" class="edit">Edit</a>
                            <form method="POST" style="display:inline">
                                <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="delete" onclick="return confirm('Delete this item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php else: ?>
            <div class="empty">
                <h3>No Menu Items Found</h3>
                <p>Start by adding your first menu item</p>
                <a href="addMenu.php" class="addItem">Add Menu Item</a>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
</body>
</html>