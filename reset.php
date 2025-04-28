<?php
include_once 'db.php';
function initUsers() {
    echo "Creating usersTable...<br>";
    $sql = "
        CREATE TABLE IF NOT EXISTS `users` (
        `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(255) UNIQUE NOT NULL,
        `password` VARCHAR(255) NOT NULL
    );";
    $result = @conn->query($sql);
    if ($result) {
        echo "usersTable created successfully.<br>";
    }
    else{
        echo "Error creating table: " . conn->error;
    }

    $sql = "INSERT INTO `users`(`username`,`password`) VALUES ('admin',md5('admin'))";
    $result = @conn->query($sql);
    if ($result) {
        echo "usersTable data inserted successfully.<br>";
    }
    else{
        echo "Error inserting data: " . conn->error;
    }
}

function initProducts() {
    $sql = "CREATE TABLE IF NOT EXISTS `products` (
        `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255),
        `description` TEXT,
        `price` DECIMAL(10, 2),
        `image_url` VARCHAR(255)
    );";
    $result = @conn->query($sql);
    if (!$result) {
        echo "Error creating table: " . conn->error;
    }
    else{
        echo "productsTable created successfully.<br>";
    }
    $sql = "INSERT INTO `products`(`name`,`description`,`price`,`image_url`) VALUES ('Sneaker One','A stylish and comfy sneaker.', 49.99, 'sneakers.webp'),
    ('Luis Vuiton Pencil heels','A stylish elegant heel.', 89.99, 'heels.jpg'),
    ('Sneaker two','A stylish and comfy sneaker.', 49.99, 'converse.jpg');";
    $result = @conn->query($sql);
    if (!$result) {
        echo "Error inserting data: " . conn->error;
    }
    else{
        echo "productsTable data inserted successfully.<br>";
    }
}

function initOrders() {
    $sql = "
        CREATE TABLE IF NOT EXISTS `orders` (
        `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `user_id` INT(11),
        `product_id` INT(11),
        `quantity` INT(11),
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (product_id) REFERENCES products(id)
    );";
    $result = @conn->query($sql);
    if (!$result) {
        echo "Error creating table: " . conn->error;
    }
    else{
        echo "ordersTable created successfully.<br>";
    }
}

function runQuery($query, $successMsg, $errorMsg) {
    $result = @conn->query($query);
    if ($result) {
        echo "$successMsg<br>";
    } else {
        echo "$errorMsg: " . conn->error . "<br>";
    }
}

function dropTables() {
    echo "Dropping tables...<br>";
    foreach (['orders', 'users', 'products'] as $table) {
        runQuery(
            "DROP TABLE IF EXISTS `$table`;",
            "$table table dropped successfully.",
            "Error dropping $table table"
        );
    }
}

dropTables();


initUsers();
initProducts();
initOrders();

?>