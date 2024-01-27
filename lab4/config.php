<?php

$host = "localhost";
$dbname = "lab4-203120";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    session_start();
   // Check if a cart session variable is set; if not, create a new shopping cart
    if (!isset($_SESSION['cart_id'])) {
        $stmt = $conn->query("INSERT INTO shopping_cart (date_and_time) VALUES (NOW())");
        $_SESSION['cart_id'] = $conn->lastInsertId();
    }
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
