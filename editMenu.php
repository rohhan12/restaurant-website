<?php
require_once '../config.php';

if (!is_admin()) {
    header('Location: login.php');
    exit;
}
$success = '';
$error = '';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: manageMenu.php');
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = :id");
$stmt->execute([':id'=>$id]);
$item = $stmt->fetch();

if (!$item) {
    header('Location: manageMenu.php');
    exit;
}

$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category_id = $_POST['category_id'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $image_url = trim($_POST['img'] ?? '');

    if (empty($category_id) || empty($name) || empty($price)) {
        $error = 'Please fill all required fields';
    } else {
        $stmt = $pdo->prepare("UPDATE menu_items SET category_id = :category_id,name = :name,description = :description,price = :price,
            image_url = :img WHERE id = :id");

        if ($stmt->execute([
            ':category_id'=> $category_id,
            ':name'=> $name,
            ':description'=> $description,
            ':price'=> $price,
            ':img'=> $image_url,
            ':id'=> $id
        ])) {
            $success = 'Menu item updated!!';
            $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $item = $stmt->fetch();
        } else {
            $error = 'Menu item not updated!!';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu Item</title>
    <link rel="stylesheet" href="../css/project.css">
</head>
<body>
<header class="header">
    <div class="container">
        <h2>Urban Spice Admin</h2>
        <a class="backButton" href="manageMenu.php">Go To Menu Items</a>
    </div>
</header>

<div class="form-box">
    <h2>Edit Menu Item</h2>
    <div><strong>Item ID:</strong> <?= $item['id'] ?></div>

    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                        <?= ($item['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Item Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description"><?= htmlspecialchars($item['description']) ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" step="0.01" min="0" value="<?= $item['price'] ?>" required>
            </div>
            <div class="form-group">
                <label>Image URL</label>
                <input type="text" name="img" value="<?= htmlspecialchars($item['image_url']) ?>">
            </div>
        </div>
        <button class="submitButton">Update Menu Item</button>
    </form>
</div>
</body>
</html>
