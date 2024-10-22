-- Create Admin Table
CREATE TABLE admin (
    admin_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

-- Create Staff Table
CREATE TABLE staff (
    staff_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
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
    type_id INT REFERENCES product_type(type_id),
    price DECIMAL(10, 2) NOT NULL,
    size VARCHAR(50),
    img VARCHAR(255)
);

-- Create Extras Table
CREATE TABLE extras (
    extras_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

-- Create Order Items Table
CREATE TABLE order_items (
    order_item_id SERIAL PRIMARY KEY,
    product_id INT NOT NULL REFERENCES products(product_id),
    quantity INT NOT NULL,
    extras_id INT REFERENCES extras(extras_id),
    price DECIMAL(10, 2) NOT NULL
);

-- Create Order Total Table
CREATE TABLE order_total (
    order_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    order_item_id INT REFERENCES order_items(order_item_id),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL
);

-- Insert Initial Admin and Staff
INSERT INTO admin (username, password_hash) VALUES ('admin', 'admin');
INSERT INTO staff (username, password_hash) VALUES ('staff', 'staff');

-- Insert Product Types
INSERT INTO product_type (name) VALUES 
('Coffee'), 
('Non-Coffee'), 
('Soda Drinks'), 
('Pizza'), 
('Bread');

-- Coffee Menu
INSERT INTO products (name, type_id, price, size, img) VALUES
('Americano', 1, 65, 'Hot 12oz', 'img/americano_hot.png'),
('Americano', 1, 85, 'Cold 16oz', 'img/americano_cold.png'),
('Cafe Latte', 1, 75, 'Hot 12oz', 'img/cafe_latte_hot.png'),
('Cafe Latte', 1, 95, 'Cold 16oz', 'img/cafe_latte_cold.png'),
('Salted Caramel', 1, 95, 'Hot 12oz', 'img/salted_caramel_hot.png'),
('Salted Caramel', 1, 120, 'Cold 16oz', 'img/salted_caramel_cold.png'),
('Hazelnut Latte', 1, 95, 'Hot 12oz', 'img/hazelnut_latte_hot.png'),
('Hazelnut Latte', 1, 120, 'Cold 16oz', 'img/hazelnut_latte_cold.png'),
('Spanish Latte', 1, 85, 'Hot 12oz', 'img/spanish_latte_hot.png'),
('Spanish Latte', 1, 110, 'Cold 16oz', 'img/spanish_latte_cold.png'),
('White Mocha Latte', 1, 115, 'Hot 12oz', 'img/white_mocha_hot.png'),
('White Mocha Latte', 1, 125, 'Cold 16oz', 'img/white_mocha_cold.png'),
('Caramel Macchiato', 1, 115, 'Hot 12oz', 'img/caramel_macchiato_hot.png'),
('Caramel Macchiato', 1, 125, 'Cold 16oz', 'img/caramel_macchiato_cold.png'),
('Biscoffee', 1, 165, 'Cold 16oz', 'img/biscoffee_cold.png'),
('Brown Sugar Cinnamon', 1, 95, 'Hot 12oz', 'img/brown_sugar_cinnamon_hot.png'),
('Brown Sugar Cinnamon', 1, 115, 'Cold 16oz', 'img/brown_sugar_cinnamon_cold.png'),
('Caramel Brulee', 1, 95, 'Hot 12oz', 'img/caramel_brulee_hot.png'),
('Caramel Brulee', 1, 120, 'Cold 16oz', 'img/caramel_brulee_cold.png'),
('Double Choco Chip Latte', 1, 100, 'Hot 12oz', 'img/double_choco_chip_hot.png'),
('Double Choco Chip Latte', 1, 125, 'Cold 16oz', 'img/double_choco_chip_cold.png');

-- Non-Coffee Menu
INSERT INTO products (name, type_id, price, size, img) VALUES
('Matcha Green Tea Latte', 2, 95, 'Hot 12oz', 'img/matcha_green_tea_hot.png'),
('Matcha Green Tea Latte', 2, 125, 'Cold 16oz', 'img/matcha_green_tea_cold.png'),
('Strawberry Latte', 2, 125, 'Cold 16oz', 'img/strawberry_latte.png'),
('Dark Choco Latte', 2, 95, 'Hot 12oz', 'img/dark_choco_hot.png'),
('Dark Choco Latte', 2, 125, 'Cold 16oz', 'img/dark_choco_cold.png'),
('Berry Matcha', 2, 135, 'Cold 16oz', 'img/berry_matcha.png'),
('Choco Berry', 2, 135, 'Cold 16oz', 'img/choco_berry.png');

-- Soda Drinks
INSERT INTO products (name, type_id, price, size, img) VALUES
('Rose Berry', 3, 85, 'Cold 16oz', 'img/rose_berry.png'),
('Peach Citrus', 3, 85, 'Cold 16oz', 'img/peach_citrus.png'),
('Passion Bloom', 3, 85, 'Cold 16oz', 'img/passion_bloom.png'),
('Hibiscus Lemon', 3, 85, 'Cold 16oz', 'img/hibiscus_lemon.png'),
('Lemon Ginger Tea Soda', 3, 95, 'Cold 16oz', 'img/lemon_ginger_tea.png');

-- Pizza Menu
INSERT INTO products (name, type_id, price, size, img) VALUES
('Ham & Cheese', 4, 299, '10"', 'img/ham_cheese_10.png'),
('Ham & Cheese', 4, 335, '12"', 'img/ham_cheese_12.png'),
('Pepperoni', 4, 299, '10"', 'img/pepperoni_10.png'),
('Pepperoni', 4, 335, '12"', 'img/pepperoni_12.png'),
('Hawaiian', 4, 299, '10"', 'img/hawaiian_10.png'),
('Hawaiian', 4, 335, '12"', 'img/hawaiian_12.png'),
('Cheesy Bacon', 4, 335, '10"', 'img/cheesy_bacon_10.png'),
('Cheesy Bacon', 4, 385, '12"', 'img/cheesy_bacon_12.png'),
('All Cheese', 4, 335, '10"', 'img/all_cheese_10.png'),
('All Cheese', 4, 385, '12"', 'img/all_cheese_12.png'),
('Beef Aloha', 4, 345, '10"', 'img/beef_aloha_10.png'),
('Beef Aloha', 4, 395, '12"', 'img/beef_aloha_12.png'),
('Beefy Mushroom', 4, 350, '10"', 'img/beefy_mushroom_10.png'),
('Beefy Mushroom', 4, 405, '12"', 'img/beefy_mushroom_12.png'),
('Cheese Aloha', 4, 360, '10"', 'img/cheese_aloha_10.png'),
('Cheese Aloha', 4, 415, '12"', 'img/cheese_aloha_12.png'),
('Supreme', 4, 365, '10"', 'img/supreme_10.png'),
('Supreme', 4, 410, '12"', 'img/supreme_12.png'),
('Farmhouse', 4, 365, '10"', 'img/farmhouse_10.png'),
('Farmhouse', 4, 410, '12"', 'img/farmhouse_12.png'),
('Kaskada Pizza', 4, 385, '10"', 'img/kaskada_pizza_10.png'),
('Kaskada Pizza', 4, 420, '12"', 'img/kaskada_pizza_12.png'),
('Creamy Spinach', 4, 395, '10"', 'img/creamy_spinach_10.png'),
('Creamy Spinach', 4, 435, '12"', 'img/creamy_spinach_12.png');

-- Bread Menu
INSERT INTO products (name, type_id, price, img) VALUES
('Korean Garlic Bread', 5, 95, 'img/korean_garlic.png'),
('Ham and Cheese', 5, 35, 'img/ham_cheese_bread.png'),
('Floss Roll (Chicken)', 5, 45, 'img/floss_roll_chicken.png'),
('Floss Bun (Pork)', 5, 35, 'img/floss_bun_pork.png'),
('Coffee Bun', 5, 35, 'img/coffee_bun.png'),
('Cinnamon', 5, 50, 'img/cinnamon.png'),
('Classic Ensaymada', 5, 35, 'img/classic_ensaymada.png'),
('Ube Cheese Ensaymada', 5, 45, 'img/ube_ensaymada.png');

-- Add-Ons
INSERT INTO extras (name, price) VALUES
('1 Shot Espresso', 25),
('Coffee Syrup', 15),
('Coffee Sauce', 20),
('Mozzarella 100g', 70),
('Pepperoni 100g', 40),
('Beef 100g', 40 ),
('Ham 100g', 30),
('Mushroom 50g', 20),
('Pineapple 50g', 20);
