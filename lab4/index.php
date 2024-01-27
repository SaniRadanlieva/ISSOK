<?php
include 'config.php';

// Initialize session and create shopping cart if not exists
if (!isset($_SESSION['cart_id'])) {
    $stmt = $conn->prepare("INSERT INTO shopping_cart (date_and_time) VALUES (NOW())");
    $stmt->execute();
    $_SESSION['cart_id'] = $conn->lastInsertId();
}

$cart_id = $_SESSION['cart_id'];

// Handle adding products to the basket
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_shoppingCart'])) {
    $productCode = $_POST['product_code'];
    $quantity = $_POST['quantity'];

    // Validate input
    // ...

    // Check if the product exists
    $product = $conn->query("SELECT * FROM products WHERE product_code = '$productCode'")->fetch();

    if ($product) {
        $productPrice = $quantity * $product['unit_price'];

        // Add product to the basket (cart_items table)
        $conn->query("INSERT INTO cart_items (product_id, cart_id, product_amount) VALUES (
            '{$product['id']}', '{$_SESSION['cart_id']}', '$quantity'
        )");

        // Redirect to the homepage
        header("Location: index.php");
        exit();
    } else {
        $errorMessage = "Product with code $productCode does not exist.";
    }
}

// Fetch cart items for display
$cartItems = $conn->query("
    SELECT products.product_name, products.unit_price, cart_items.product_amount, 
           (products.unit_price * cart_items.product_amount) as product_price
    FROM cart_items
    JOIN products ON cart_items.product_id = products.id
    WHERE cart_items.cart_id = '{$_SESSION['cart_id']}'
")->fetchAll();

// Fetch total price
$totalPrice = $conn->query("SELECT * FROM shopping_cart WHERE id = '{$_SESSION['cart_id']}'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Checkout</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            border: 2px solid #ccc;
            padding: 20px;
            max-width: 600px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        h1, h2, h3 {
            margin-bottom: 10px;
        }

        button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Supermarket Checkout</h1>

    <!-- Form to add products to the shopping cart -->
    <form method="POST" action="index.php">
        <label for="product_code">Product Code:</label>
        <input type="text" name="product_code" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>

        <button type="submit" name="add_to_shoppingCart">Add to Shopping Cart</button>
    </form>

    <?php
    // Display error message if any
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>

    <!-- Display shopping cart items -->
    <h2>Shopping Cart</h2>
    <table>
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Product Price</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?= $item['product_name'] ?></td>
                <td><?= $item['unit_price'] ?></td>
                <td><?= $item['product_amount'] ?></td>
                <td><?= $item['product_price'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Display total price -->
    <h3>Total Price: <?= array_sum(array_column($cartItems, 'product_price')) ?></h3>

    <!-- Payment buttons -->
    <form method="POST" action="payment.php">
        <input type="hidden" name="cart_id" value="<?= $cart_id ?>">
        <button type="submit" name="cash">Pay by Cash</button>
        <button type="submit" name="card">Pay by Card</button>
    </form>
</div>
</body>
</html>
