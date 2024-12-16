CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS order_items CASCADE;
DROP TABLE IF EXISTS orders CASCADE;
DROP TABLE IF EXISTS product_size CASCADE;
DROP TABLE IF EXISTS products CASCADE;
DROP TABLE IF EXISTS product_type CASCADE;
DROP TABLE IF EXISTS admin CASCADE;
DROP TABLE IF EXISTS addons CASCADE;
DROP TABLE IF EXISTS item_addons CASCADE;

-- Create Admin Table
CREATE TABLE admin (
    admin_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    type VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

-- Create Product Type Table
CREATE TABLE product_type (
    type_id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Create Products Table
CREATE TABLE products (
    product_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    type_id INT REFERENCES product_type(type_id) ON DELETE CASCADE,
    img VARCHAR(255)
);

-- Create Product Size Table
CREATE TABLE product_size (
    ps_id SERIAL PRIMARY KEY,
    product_id INT REFERENCES products(product_id) ON DELETE CASCADE,
    size VARCHAR(50),
    price DECIMAL(10, 2) NOT NULL
);

-- Create Extras Table
CREATE TABLE addons (
    addon_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    type_id INT REFERENCES product_type(type_id) ON DELETE CASCADE
);

-- Create Orders Table
CREATE TABLE orders (
    order_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    service VARCHAR(100) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    cash DECIMAL(10, 2),
    change DECIMAL(10, 2)
);

-- Create Order Items Table
CREATE TABLE order_items (
    order_item_id SERIAL PRIMARY KEY,
    order_id INT NOT NULL REFERENCES orders(order_id) ON DELETE CASCADE,
    product_id INT NOT NULL REFERENCES products(product_id) ON DELETE CASCADE,
    size VARCHAR(50),
    add_ons VARCHAR(255), --will be removed
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

-- Create Item Addons Table
CREATE TABLE item_addons (
    item_addon_id SERIAL PRIMARY KEY,
    order_item_id INT NOT NULL REFERENCES order_items(order_item_id) ON DELETE CASCADE,
    addon_id INT NOT NULL REFERENCES addons(addon_id) ON DELETE CASCADE,
    quantity INT NOT NULL
);

-- Insert Admin and Staff
INSERT INTO admin (username, type, password_hash) 
VALUES ('admin', 'admin', crypt('admin', gen_salt('bf'))) 
ON CONFLICT DO NOTHING;

INSERT INTO admin (username, type, password_hash) 
VALUES ('staff', 'staff', crypt('staff', gen_salt('bf'))) 
ON CONFLICT DO NOTHING;

-- Insert Product Types
INSERT INTO product_type (name) 
VALUES 
('Coffee'), 
('Non-Coffee'), 
('Soda Drinks'), 
('Pizza'), 
('Bread') 
ON CONFLICT DO NOTHING;

-- Coffee Menu
INSERT INTO products (name, type_id, description, img) VALUES
('Americano', 1, 'A bold and smooth black coffee', 'img/americano.png'),
('Cafe Latte', 1, 'A creamy coffee blend with milk.', 'img/cafe_latte.png'),
('Salted Caramel', 1, 'A sweet and savory caramel latte.', 'img/salted_caramel.png'),
('Hazelnut Latte', 1, 'A nutty and aromatic coffee treat.', 'img/hazelnut_latte.png'),
('Spanish Latte', 1, 'A rich coffee with sweet milk.', 'img/spanish_latte.png'),
('White Mocha Latte', 1, 'A creamy white chocolate coffee.', 'img/white_mocha.png'),
('Caramel Macchiato', 1, 'A layered coffee with caramel.', 'img/caramel_macchiato.png'),
('Biscoffee', 1, 'A biscuit-flavored iced coffee.', 'img/biscoffee_cold.png'),
('Brown Sugar Cinnamon', 1, 'A spiced coffee with brown sugar.', 'img/brown_sugar_cinnamon.png'),
('Caramel Brulee', 1, 'A caramel-flavored coffee.', 'img/caramel_brulee.png'),
('Double Choco Chip Latte', 1, 'A chocolatey coffee with chips.', 'img/double_choco_chip.png');

-- Non-Coffee Menu
INSERT INTO products (name, type_id, description, img) VALUES
('Matcha Green Tea Latte', 2, 'A creamy latte with earthy matcha.', 'img/matcha_green_tea.png'),
('Strawberry Latte', 2, 'A sweet and fruity iced drink.', 'img/strawberry_latte.png'),
('Dark Choco Latte', 2, 'A rich and creamy chocolate drink.', 'img/dark_choco.png'),
('Berry Matcha', 2, 'A refreshing blend of berries and matcha.', 'img/berry_matcha.png'),
('Choco Berry', 2, 'A chocolate and berry delight.', 'img/choco_berry.png');

-- Soda Drinks
INSERT INTO products (name, type_id, description, img) VALUES
('Rose Berry', 3, 'A floral and fruity soda.', 'img/rose_berry.png'),
('Peach Citrus', 3, 'A tangy and sweet peach soda.', 'img/peach_citrus.png'),
('Passion Bloom', 3, 'A tropical passionfruit soda.', 'img/passion_bloom.png'),
('Hibiscus Lemon', 3, 'A zesty hibiscus lemon soda.', 'img/hibiscus_lemon.png'),
('Lemon Ginger Tea Soda', 3, 'A spicy and refreshing tea soda.', 'img/lemon_ginger_tea.png');

-- Pizza Menu
INSERT INTO products (name, type_id, description, img) VALUES
('Ham & Cheese', 4, 'A classic ham and cheese pizza.', 'img/ham_cheese.png'),
('Pepperoni', 4, 'A pizza topped with spicy pepperoni.', 'img/pepperoni.png'),
('Hawaiian', 4, 'A pizza with pineapple and ham.', 'img/hawaiian.png'),
('Cheesy Bacon', 4, 'A bacon pizza with extra cheese.', 'img/cheesy_bacon.png'),
('All Cheese', 4, 'A pizza with various cheeses.', 'img/all_cheese.png'),
('Beef Aloha', 4, 'A beef pizza with a tropical twist.', 'img/beef_aloha.png'),
('Beefy Mushroom', 4, 'A pizza with beef and mushrooms.', 'img/beefy_mushroom.png'),
('Cheese Aloha', 4, 'A cheesy pizza with a tropical touch.', 'img/cheese_aloha.png'),
('Supreme', 4, 'A pizza loaded with toppings.', 'img/supreme.png'),
('Farmhouse', 4, 'A pizza with fresh veggie toppings.', 'img/farmhouse.png'),
('Kaskada Pizza', 4, 'The cafe’s signature pizza.', 'img/kaskada_pizza.png'),
('Creamy Spinach', 4, 'A pizza with creamy spinach topping.', 'img/creamy_spinach.png');

-- Bread Menu
INSERT INTO products (name, type_id, description, img) VALUES
('Korean Garlic Bread', 5, 'A soft bread with creamy garlic filling.', 'img/korean_garlic.png'),
('Ham and Cheese', 5, 'A savory bread with ham and cheese.', 'img/ham_cheese_bread.png'),
('Floss Roll (Chicken)', 5, 'A soft bread topped with chicken floss.', 'img/floss_roll_chicken.png'),
('Floss Bun (Pork)', 5, 'A soft bread topped with pork floss.', 'img/floss_bun_pork.png'),
('Coffee Bun', 5, 'A sweet coffee-flavored bread.', 'img/coffee_bun.png'),
('Cinnamon', 5, 'A spiced bread with cinnamon flavor.', 'img/cinnamon.png'),
('Classic Ensaymada', 5, 'A traditional buttery and cheesy bread.', 'img/classic_ensaymada.png'),
('Ube Cheese Ensaymada', 5, 'A cheesy bread with ube flavor.', 'img/ube_ensaymada.png');

-- Product Sizes and Prices
INSERT INTO product_size (product_id, size, price) VALUES
-- Coffee Sizes and Prices
(1, 'Hot 12oz', 65),
(1, 'Cold 16oz', 85),
(2, 'Hot 12oz', 75),
(2, 'Cold 16oz', 95),
(3, 'Hot 12oz', 95),
(3, 'Cold 16oz', 120),
(4, 'Hot 12oz', 95),
(4, 'Cold 16oz', 120),
(5, 'Hot 12oz', 85),
(5, 'Cold 16oz', 110),
(6, 'Hot 12oz', 115),
(6, 'Cold 16oz', 125),
(7, 'Hot 12oz', 115),
(7, 'Cold 16oz', 125),
(8, 'Cold 16oz', 185),
(9, 'Hot 12oz', 95),
(9, 'Cold 16oz', 115),
(10, 'Hot 12oz', 95),
(10, 'Cold 16oz', 120),
(11, 'Hot 12oz', 100),
(11, 'Cold 16oz', 125),
-- Non-Coffee Sizes and Prices
(12, 'Hot 12oz', 95),
(12, 'Cold 16oz', 125),
(13, 'Cold 16oz', 125),
(14, 'Hot 12oz', 95),
(14, 'Cold 16oz', 125),
(15, 'Cold 16oz', 135),
(16, 'Cold 16oz', 135),
-- Soda Sizes and Prices
(17, 'Cold 16oz', 85),
(18, 'Cold 16oz', 85),
(19, 'Cold 16oz', 85),
(20, 'Cold 16oz', 95),
(21, 'Cold 16oz', 95),
-- Pizza Sizes and Prices
(22, '10"', 299),
(22, '12"', 335),
(23, '10"', 299),
(23, '12"', 335),
(24, '10"', 299),
(24, '12"', 335),
(25, '10"', 335),
(25, '12"', 385),
(26, '10"', 335),
(26, '12"', 385),
(27, '10"', 345),
(27, '12"', 395),
(28, '10"', 350),
(28, '12"', 405),
(29, '10"', 360),
(29, '12"', 415),
(30, '10"', 365),
(30, '12"', 410),
(31, '10"', 365),
(31, '12"', 410),
(32, '10"', 385),
(32, '12"', 420),
(33, '10"', 395),
(33, '12"', 435),
-- Bread Prices
(34, NULL, 95),
(35, NULL, 35),
(36, NULL, 45),
(37, NULL, 35),
(38, NULL, 35),
(39, NULL, 50),
(40, NULL, 35),
(41, NULL, 45);


-- Insert Extras
INSERT INTO addons (name, price, type_id) 
VALUES 
('Shot Espresso', 25.00, 1),
('Coffee Syrup', 15.00, 1),
('Coffee Sauce', 15.00, 1),
('Mozzarella 100g', 70.00, 4),
('Pepperoni 100g', 40.00, 4),
('Pineapple 50g', 20.00, 4),
('Ham 100g', 30.00, 4) 
ON CONFLICT DO NOTHING;

-- Insert Sample Orders
INSERT INTO orders (name, service, status, order_date, total, cash, change) 
VALUES 
('John Doe', 'Dine In', 'Completed', '2024-12-01 10:15:00', 385.00, 500.00, 115.00),
('Jane Smith', 'Take Out', 'Pending', '2024-12-02 15:30:00', 500.00, NULL, NULL),
('Michael Brown', 'Take Out', 'Pending', '2024-12-03 12:45:00', 500.00, NULL, NULL),
('Emily Davis', 'Dine In', 'Completed', '2024-11-30 18:20:00', 150.00, 200.00, 50.00),
('Robert Wilson', 'Take Out', 'Completed', '2024-11-29 09:00:00', 75.00, 100.00, 25.00);

-- Insert Sample Order Items
INSERT INTO order_items (order_id, product_id, size, quantity, price) 
VALUES 
-- For Order 1
(1, 22, '10"', 1, 299.00),
(1, 17, 'Cold 16oz', 1, 85.00),

-- For Order 2
(2, 23, '12"', 1, 335.00),
(2, 12, 'Cold 16oz', 1, 125.00),

-- For Order 3
(3, 24, '10"', 1, 299.00),
(3, 13, 'Cold 16oz', 1, 125.00),
(3, 21, 'Cold 16oz', 1, 95.00),

-- For Order 4
(4, 35, NULL, 2, 70.00),
(4, 41, NULL, 1, 45.00),

-- For Order 5
(5, 22, '10"', 1, 299.00);
