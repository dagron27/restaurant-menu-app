-- Dummy schema and seed data for RestaurantMenuAppBackend.
--
-- This file did not exist in the original coursework submission; the app
-- previously had no way to be run from a clean checkout since db.php
-- expects a pre-existing `items_table` with no schema committed anywhere.
-- This file fills that gap with placeholder data only -- it is not real
-- restaurant content, just enough to exercise every page.
--
-- Usage:
--   mysql -u <user> -p < schema.sql
-- or, inside a MySQL client already connected to the target server:
--   SOURCE schema.sql;
--
-- Row order matters: db.php runs `SELECT * FROM items_table` with no
-- ORDER BY, and each page reads a fixed array index ($menu_items[0..3]).
-- The INSERT order below must stay index-0 = Focaccia (breakfast_page1),
-- index-1 = Frutta Fresca (breakfast_page2), index-2 = Beef Tagliata
-- (dinner_page1), index-3 = Penne Pomodoro (dinner_page2), matching what
-- each page already expects. Do not reorder without also checking those
-- four files.

CREATE DATABASE IF NOT EXISTS restaurant_db;
USE restaurant_db;

DROP TABLE IF EXISTS items_table;

CREATE TABLE items_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL
);

-- index 0 -- read by breakfast_page1.php
INSERT INTO items_table (item_name, description, image_path) VALUES
    ('Focaccia', 'Placeholder description for Focaccia. Replace with real menu copy.', 'images/Focaccia.png');

-- index 1 -- read by breakfast_page2.php
INSERT INTO items_table (item_name, description, image_path) VALUES
    ('Frutta Fresca', 'Placeholder description for Frutta Fresca. Replace with real menu copy.', 'images/FruttaFresca.png');

-- index 2 -- read by dinner_page1.php
INSERT INTO items_table (item_name, description, image_path) VALUES
    ('Beef Tagliata', 'Placeholder description for Beef Tagliata. Replace with real menu copy.', 'images/Beef.png');

-- index 3 -- read by dinner_page2.php
INSERT INTO items_table (item_name, description, image_path) VALUES
    ('Penne Pomodoro', 'Placeholder description for Penne Pomodoro. Replace with real menu copy.', 'images/PennePomodoro.png');
