<?php
require_once 'config.php';

$category_filter = $_GET['category'] ?? 'all';

$stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $stmt->fetchAll();

$query = "SELECT menu_items.*, categories.name AS category_name FROM menu_items JOIN categories ON menu_items.category_id = categories.id";

$params = [];
if ($category_filter !== 'all') {
    $query .= " WHERE menu_items.category_id = ?";
    $params[] = $category_filter;
}

$query .= " ORDER BY categories.name, menu_items.name";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$menu_items = $stmt->fetchAll();

include 'header.php';
?>
<main>
    <div class="header" style = "background-image:url(images/img1.png);">
        <h1>Our Menu</h1>
        <p>Discover authentic flavors from our kitchen</p>
    </div>

    <section class="menu-section">
        <div class="container">
            <div class="menu-filters">
                <button class="filter-btn <?= $category_filter === 'all' ? 'active' : '' ?>" onclick="window.location.href='menu.php?category=all'">All Items</button>

                <?php foreach ($categories as $cat): ?>
                    <button class="filter-btn <?= $category_filter == $cat['id'] ? 'active' : '' ?>" onclick="window.location.href='menu.php?category=<?php echo htmlspecialchars($cat['id']); ?>'">
                        <?= htmlspecialchars($cat['name']) ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($menu_items)): ?>
                <div class="menu-grid">
                    <?php foreach ($menu_items as $item): ?>
                        <div class="menu-card">
                            <div class="menu-image">
                                <img src="<?= htmlspecialchars($item['image_url']) ?>" 
                                     alt="<?= htmlspecialchars($item['name']) ?>">
                            </div>

                            <div class="menu-content">
                                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="category"><?php echo htmlspecialchars($item['category_name']) ?></p>
                                <p class="description"><?php echo htmlspecialchars($item['description']) ?></p>
                                <p class="price">$<?php echo number_format($item['price'], 2) ?></p>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
