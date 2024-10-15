-- Table for Coffee Menu
CREATE TABLE coffee_menu (
    id SERIAL PRIMARY KEY,
    item_name VARCHAR(100),
    type VARCHAR(20),
    size VARCHAR(10),
    price DECIMAL(10, 2),
    image_url TEXT
);

-- Table for Non-Coffee Menu
CREATE TABLE non_coffee_menu (
    id SERIAL PRIMARY KEY,
    item_name VARCHAR(100),
    type VARCHAR(20),
    size VARCHAR(10),
    price DECIMAL(10, 2),
    image_url TEXT
);

-- Table for Soda Drinks
CREATE TABLE soda_menu (
    id SERIAL PRIMARY KEY,
    item_name VARCHAR(100),
    type VARCHAR(20),
    size VARCHAR(10),
    price DECIMAL(10, 2),
    image_url TEXT
);

-- Table for Pizza Menu
CREATE TABLE pizza_menu (
    id SERIAL PRIMARY KEY,
    item_name VARCHAR(100),
    type VARCHAR(20),
    size VARCHAR(10),
    price DECIMAL(10, 2),
    image_url TEXT
);

-- Table for Add-On Toppings
CREATE TABLE pizza_toppings (
    id SERIAL PRIMARY KEY,
    item_name VARCHAR(100),
    type VARCHAR(20),
    price DECIMAL(10, 2)
);

-- Table for Add-Ons for Drinks
CREATE TABLE drink_add_ons (
    id SERIAL PRIMARY KEY,
    item_name VARCHAR(100),
    type VARCHAR(20),
    price DECIMAL(10, 2)
);

-- Table for Bread Menu
CREATE TABLE bread_menu (
    id SERIAL PRIMARY KEY,
    item_name VARCHAR(100),
    type VARCHAR(20),
    price DECIMAL(10, 2),
    image_url TEXT
);

-- Insert Data for Coffee Menu
INSERT INTO coffee_menu (item_name, type, size, price, image_url) VALUES
('Americano', 'Coffee', 'Hot 12oz', 65, 'path/to/americano_hot.jpg'),
('Americano', 'Coffee', 'Cold 16oz', 85, 'path/to/americano_cold.jpg'),
('Cafe Latte', 'Coffee', 'Hot 12oz', 75, 'path/to/cafe_latte_hot.jpg'),
('Cafe Latte', 'Coffee', 'Cold 16oz', 95, 'path/to/cafe_latte_cold.jpg'),
('Salted Caramel', 'Coffee', 'Hot 12oz', 95, 'path/to/salted_caramel_hot.jpg'),
('Salted Caramel', 'Coffee', 'Cold 16oz', 120, 'path/to/salted_caramel_cold.jpg'),
('Hazelnut Latte', 'Coffee', 'Hot 12oz', 95, 'path/to/hazelnut_latte_hot.jpg'),
('Hazelnut Latte', 'Coffee', 'Cold 16oz', 120, 'path/to/hazelnut_latte_cold.jpg'),
('Spanish Latte', 'Coffee', 'Hot 12oz', 85, 'path/to/spanish_latte_hot.jpg'),
('Spanish Latte', 'Coffee', 'Cold 16oz', 110, 'path/to/spanish_latte_cold.jpg'),
('White Mocha Latte', 'Coffee', 'Hot 12oz', 115, 'path/to/white_mocha_hot.jpg'),
('White Mocha Latte', 'Coffee', 'Cold 16oz', 125, 'path/to/white_mocha_cold.jpg'),
('Caramel Macchiato', 'Coffee', 'Hot 12oz', 115, 'path/to/caramel_macchiato_hot.jpg'),
('Caramel Macchiato', 'Coffee', 'Cold 16oz', 125, 'path/to/caramel_macchiato_cold.jpg'),
('Biscoffee', 'Coffee', 'Cold 16oz', 165, 'path/to/biscoffee.jpg'),
('Brown Sugar Cinnamon', 'Coffee', 'Hot 12oz', 95, 'path/to/brown_sugar_cinnamon_hot.jpg'),
('Brown Sugar Cinnamon', 'Coffee', 'Cold 16oz', 115, 'path/to/brown_sugar_cinnamon_cold.jpg'),
('Caramel Brulee', 'Coffee', 'Hot 12oz', 95, 'path/to/caramel_brulee_hot.jpg'),
('Caramel Brulee', 'Coffee', 'Cold 16oz', 120, 'path/to/caramel_brulee_cold.jpg'),
('Double Choco Chip Latte', 'Coffee', 'Hot 12oz', 100, 'path/to/double_choco_chip_hot.jpg'),
('Double Choco Chip Latte', 'Coffee', 'Cold 16oz', 125, 'path/to/double_choco_chip_cold.jpg');

-- Insert Data for Non-Coffee Menu
INSERT INTO non_coffee_menu (item_name, type, size, price, image_url) VALUES
('Matcha Green Tea Latte', 'Non-Coffee', 'Hot 12oz', 95, 'path/to/matcha_hot.jpg'),
('Matcha Green Tea Latte', 'Non-Coffee', 'Cold 16oz', 125, 'path/to/matcha_cold.jpg'),
('Strawberry Latte', 'Non-Coffee', 'Cold 16oz', 125, 'path/to/strawberry_latte.jpg'),
('Dark Choco Latte', 'Non-Coffee', 'Hot 12oz', 95, 'path/to/dark_choco_hot.jpg'),
('Dark Choco Latte', 'Non-Coffee', 'Cold 16oz', 125, 'path/to/dark_choco_cold.jpg'),
('Berry Matcha', 'Non-Coffee', 'Cold 16oz', 135, 'path/to/berry_matcha.jpg'),
('Choco Berry', 'Non-Coffee', 'Cold 16oz', 135, 'path/to/choco_berry.jpg');

-- Insert Data for Soda Menu
INSERT INTO soda_menu (item_name, type, size, price, image_url) VALUES
('Rose Berry', 'Soda', 'Cold 16oz', 85, 'path/to/rose_berry.jpg'),
('Peach Citrus', 'Soda', 'Cold 16oz', 85, 'path/to/peach_citrus.jpg'),
('Passion Bloom', 'Soda', 'Cold 16oz', 85, 'path/to/passion_bloom.jpg'),
('Hibiscus Lemon', 'Soda', 'Cold 16oz', 85, 'path/to/hibiscus_lemon.jpg'),
('Lemon Ginger Tea Soda', 'Soda', 'Cold 16oz', 95, 'path/to/lemon_ginger_tea.jpg');

-- Insert Data for Pizza Menu
INSERT INTO pizza_menu (item_name, type, size, price, image_url) VALUES
('Ham & Cheese', 'Pizza', '10’’', 299, 'path/to/ham_cheese_10.jpg'),
('Ham & Cheese', 'Pizza', '12’’', 335, 'path/to/ham_cheese_12.jpg'),
('Pepperoni', 'Pizza', '10’’', 299, 'path/to/pepperoni_10.jpg'),
('Pepperoni', 'Pizza', '12’’', 335, 'path/to/pepperoni_12.jpg'),
('Hawaiian', 'Pizza', '10’’', 299, 'path/to/hawaiian_10.jpg'),
('Hawaiian', 'Pizza', '12’’', 335, 'path/to/hawaiian_12.jpg'),
('Cheesy Bacon', 'Pizza', '10’’', 335, 'path/to/cheesy_bacon_10.jpg'),
('Cheesy Bacon', 'Pizza', '12’’', 385, 'path/to/cheesy_bacon_12.jpg'),
('All Cheese', 'Pizza', '10’’', 335, 'path/to/all_cheese_10.jpg'),
('All Cheese', 'Pizza', '12’’', 385, 'path/to/all_cheese_12.jpg'),
('Beef Aloha', 'Pizza', '10’’', 345, 'path/to/beef_aloha_10.jpg'),
('Beef Aloha', 'Pizza', '12’’', 395, 'path/to/beef_aloha_12.jpg'),
('Beefy Mushroom', 'Pizza', '10’’', 350, 'path/to/beefy_mushroom_10.jpg'),
('Beefy Mushroom', 'Pizza', '12’’', 405, 'path/to/beefy_mushroom_12.jpg'),
('Cheese Aloha', 'Pizza', '10’’', 360, 'path/to/cheese_aloha_10.jpg'),
('Cheese Aloha', 'Pizza', '12’’', 415, 'path/to/cheese_aloha_12.jpg'),
('Supreme', 'Pizza', '10’’', 365, 'path/to/supreme_10.jpg'),
('Supreme', 'Pizza', '12’’', 410, 'path/to/supreme_12.jpg'),
('Farmhouse', 'Pizza', '10’’', 365, 'path/to/farmhouse_10.jpg'),
('Farmhouse', 'Pizza', '12’’', 410, 'path/to/farmhouse_12.jpg'),
('Kaskada Pizza', 'Pizza', '10’’', 385, 'path/to/kaskada_10.jpg'),
('Kaskada Pizza', 'Pizza', '12’’', 420, 'path/to/kaskada_12.jpg'),
('Creamy Spinach', 'Pizza', '10’’', 395, 'path/to/creamy_spinach_10.jpg'),
('Creamy Spinach', 'Pizza', '12’’', 435, 'path/to/creamy_spinach_12.jpg');

-- Insert Data for Pizza Toppings
INSERT INTO pizza_toppings (item_name, type, price) VALUES
('Mozzarella 100g', 'Topping', 70),
('Pepperoni 100g', 'Topping', 40),
('Beef 100g', 'Topping', 40),
('Ham 100g', 'Topping', 30),
('Mushroom 50g', 'Topping', 20),
('Pineapple 50g', 'Topping', 20);

-- Insert Data for Drink Add-Ons
INSERT INTO drink_add_ons (item_name, type, price) VALUES
('1 Shot Espresso', 'Add-On', 25),
('Coffee Syrup', 'Add-On', 15),
('Coffee Sauce', 'Add-On', 20);

-- Insert Data for Bread Menu
INSERT INTO bread_menu (item_name, type, price, image_url) VALUES
('Korean Garlic Bread', 'Bread', 95, 'img/korean_garlic_bread.png'),
('Strawberry Muffin', 'Bread', 95, 'img/strawberry_muffin.png'),
('Ham and Cheese', 'Bread', 35, 'img/ham_and_cheese.png'),
('Floss Roll (Chicken)', 'Bread', 45, 'img/floss_roll_chicken.png'),
('Pork Floss Bun (Seaweeds)', 'Bread', 35, 'img/pork_floss_bun.png'),
('Coffee Bun', 'Bread', 35, 'img/coffee_bun.png'),
('Cinnamon', 'Bread', 50, 'img/cinnamon.png'),
('Classic Ensaymada', 'Bread', 35, 'img/classic_ensaymada.png'),
('Ube Cheese Ensaymada', 'Bread', 45, 'img/ube_cheese_ensaymada.png');



