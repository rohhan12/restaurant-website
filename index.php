<?php
require_once 'config.php';

$stmt = $pdo->query(" SELECT menu_items.*, categories.name AS category_name FROM menu_items JOIN categories 
    ON menu_items.category_id = categories.id  LIMIT 6"); 

$popular_items = $stmt->fetchAll();

include 'header.php';
?>
<main>
    <section class="hero">
        <div class="hero-slider">
            <div class="slide active" style="background-image:url('images/restaurant.jpg')">
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <h1>Welcome to Urban Spice</h1>
                    <p>Authentic Indian Cuisine in the Heart of the City</p>
                    <a href="menu.php" class="btn">Explore Menu</a>
                </div>
            </div>

            <div class="slide" style="background-image:url('images/reserve.jpg')">
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <h1>Reserve Your Table</h1>
                    <p>Experience Fine Dining at Its Best</p>
                    <a href="reservations.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="slide" style="background-image:url('images/cocktail.jpg')">
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <h1>Crafted Cocktails</h1>
                    <p>Unique Drinks with an Indian Twist</p>
                    <a href="menu.php#cocktails" class="btn">View Drinks</a>
                </div>
            </div>
        </div>

        <button class="slider-btn prev">&lt;</button>
        <button class="slider-btn next">&gt;</button>
        <div class="slider-dots"></div>
    </section>
    <br><br>
    <section class="about container">
        <div class="about-grid">
            <img src="images/restaurant_interior.jpg" alt="Restaurant">
            <div>
                <h2>Our Story</h2>
                <p>Urban Spice represents Indian food in all its eccentricity 
                and diversity along with a high quality family dining experience at down to earth prices.
                We blend traditional recipes with modern cooking to create fresh, authentic, and memorable dishes. 
                Our goal is simple — to offer delicious Indian cuisine in a warm, welcoming, and family-friendly atmosphere. 
                Enjoy the true taste of India, crafted with passion and quality ingredients.</p>
            </div>
        </div>
    </section>
<br>
    <section class="popular">
        <div class="container">
            <h2>Popular Dishes</h2>

            <div class="menu-grid">
                <?php foreach ($popular_items as $item): ?>
                <div class="menu-card">
                    <div class="menu-image">
                        <img src="<?php echo htmlspecialchars($item['image_url']) ?>" 
                             alt="<?php echo htmlspecialchars($item['name']) ?>">
                    </div>

                    <div class="menu-content">
                        <h3><?php echo htmlspecialchars($item['name']) ?></h3>
                        <p class="category"><?php echo htmlspecialchars($item['category_name']) ?></p>
                        <p class="description"><?php echo htmlspecialchars($item['description']) ?></p>
                        <p class="price">$<?php echo number_format($item['price'], 2) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center">
                <a href="menu.php" class="btn">View Full Menu</a>
            </div>
        </div>
    </section>

    <section class="reserve">
        <div class="container">
            <h2>Ready to Dine With Us?</h2>
            <p>Reserve your table today and experience the finest Indian cuisine</p><br>
            <a href="reservations.php" class="btn">Make a Reservation</a>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
