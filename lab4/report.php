<?php
include 'config.php';

$selectedDate = null;
$transactions = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['show_transactions'])) {
    $selectedDate = $_POST['selected_date'];

    $query = "
        SELECT sc.date_and_time, p.product_name, ci.product_amount, 
               (p.unit_price * ci.product_amount) as product_price
        FROM shopping_cart sc
        JOIN cart_items ci ON sc.id = ci.cart_id
        JOIN products p ON ci.product_id = p.id
        WHERE DATE(sc.date_and_time) = ?
        ORDER BY sc.date_and_time ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute([$selectedDate]);
    $transactions = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Transaction Report</h1>

    <form method="POST" action="report.php#show_transactions">
        <label for="selected_date">Select Date:</label>
        <input type="date" name="selected_date" required>
        <button type="submit" name="show_transactions">Show Transactions</button>
    </form>

    <?php if (isset($transactions) && isset($_POST['show_transactions'])): ?>
        <h2>Transactions on <?= $selectedDate ?></h2>
        <table>
            <thead>
            <tr>
                <th>Date and Time</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Product Price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= $transaction['date_and_time'] ?></td>
                    <td><?= $transaction['product_name'] ?></td>
                    <td><?= $transaction['product_amount'] ?></td>
                    <td><?= $transaction['product_price'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
