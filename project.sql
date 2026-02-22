CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

INSERT INTO categories (name) VALUES
('Appetizers'),
('Main Course'),
('Cocktails'),
('Desserts');


CREATE TABLE menu_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  name VARCHAR(150) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2) NOT NULL,
  image_url VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

INSERT INTO menu_items (category_id, name, description, price, image_url) VALUES
(1, 'Samosa Chaat', 'Crispy samosas topped with chickpeas, yogurt, and tangy chutneys', 8.99, 'images/samosa.png'),
(1, 'Paneer Tikka', 'Grilled cottage cheese marinated in aromatic spices', 12.99, 'images/paneer.png'),
(1, 'Chicken Wings', 'Spicy tandoori-style chicken wings with mint dip', 11.99, 'images/wings.png'),
(2, 'Butter Chicken', 'Tender chicken in creamy tomato sauce with aromatic spices', 18.99, 'images/butter_chicken.avif'),
(2, 'Lamb Rogan Josh', 'Slow-cooked lamb in rich cashew and tomato gravy', 22.99, 'images/rogan_josh.jpg'),
(2, 'Paneer Makhani', 'Cottage cheese cubes in silky tomato cream sauce', 16.99, 'images/butter.png'),
(2, 'Biryani', 'Fragrant basmati rice with vegetables or meat, served with raita', 19.99, 'images/biryani.jpg'),
(3, 'Mango Lassi Martini', 'Vodka-spiked mango lassi with cardamom', 12.00, 'images/lassi.jpg'),
(3, 'Spiced Old Fashioned', 'Bourbon with garam masala bitters and orange', 14.00, 'images/spiced_old_fashioned.webp'),
(3, 'Tamarind Margarita', 'Tequila with tamarind, lime, and chili salt rim', 13.00, 'images/tamarind.webp'),
(4, 'Gulab Jamun', 'Warm milk dumplings in rose-scented syrup', 7.99, 'images/gulab-jamun.webp'),
(4, 'Kulfi', 'Traditional Indian ice cream with pistachios', 6.99, 'images/kulfi.avif'),
(4, 'Rasmalai', 'Soft cheese patties in sweetened milk with saffron', 8.99, 'images/rasmalai.webp');

CREATE TABLE reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  guests INT NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL
);

CREATE TABLE admin_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admin_users (username, password) VALUES
('admin', 'your_secure_password_hash_here');