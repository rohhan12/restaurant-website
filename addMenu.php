<?php
require_once '../config.php';

if (!is_admin()) {
    header('Location: login.php');
    exit;
}
$success = '';
$error = '';

$categories= $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $category_id = $_POST['category_id'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['desc'] ?? '');
    $price = $_POST['price'] ?? '';
    $image_url = trim($_POST['img'] ?? '');

    if ($category_id === '') {
        $error = "Please select a category!!";
    } elseif ($name === '') {
        $error = "Please enter a menu item name!!";
    } elseif (!is_numeric($price) || $price < 0) {
        $error = "Please enter a valid price!!";
    } else {
        $sql = " INSERT INTO menu_items (category_id, name, description, price, image_url)
            VALUES (:category_id, :name, :description, :price, :image_url)";

        $stmt = $pdo->prepare($sql);

        if($stmt->execute([
            ':category_id' => $category_id,
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $image_url
        ])) {
            $success = "Menu item added!!";
            $_POST = [];
        } else {
            $error = "Menu item not added!!";
        }
    
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="../css/project.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Urban Spice Admin</h1>
            <a href="dashboard.php" class="backButton">Go to Dashboard</a>
        </div>
    </header>

    <div class="form-box">
        <h2>Add New Menu Item</h2>
        
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Category</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['id']); ?>"
                            <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" 
                placeholder="e.g. Butter Chicken, Samosa" required>
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea id="desc" name="desc" placeholder="Brief description of the dish">
                    <?php echo htmlspecialchars($_POST['desc'] ?? ''); ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price ($) </label>
                    <input type="number"id="price" name="price" step="0.01" min="0"value="
                    <?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"placeholder="0.00" required>
                </div>
                <div class="form-group">
                    <label for="img">Image URL</label>
                    <input type="text" id="img" name="img" value="<?php echo htmlspecialchars($_POST['img'] ?? ''); ?>" 
                    placeholder="images/dish.jpg">
                </div>
            </div>     
            <button type="submit" class="submitButton">Add Menu Item</button>
        </form>
    </div>
</body>
</html>