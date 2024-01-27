<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        $productCode = $_POST['product_code'];
        $productName = $_POST['product_name'];
        $unitPrice = $_POST['unit_price'];

    
        $stmt = $conn->prepare("INSERT INTO products (product_code, product_name, unit_price) VALUES (:productCode, :productName, :unitPrice)");
        $stmt->bindParam(':productCode', $productCode);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':unitPrice', $unitPrice);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error adding product to the database";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form method="POST" action="add_product.php">
        <h1 style="text-align: center;">Add Product</h1>

        <!-- Form to add a new product -->
        <label for="product_code">Product Code:</label>
        <input type="text" name="product_code" required>

        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>

        <label for="unit_price">Unit Price:</label>
        <input type="text" name="unit_price" required>

        <button type="submit" name="add_product">Add Product</button>
    </form>
</body>
</html>

