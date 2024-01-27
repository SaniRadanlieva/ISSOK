<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .frame {
            border: 2px solid #000;
            padding: 20px;
            text-align: center;
        }
    </style>
    <title>Payment Receipt</title>
</head>
<body>
    <div class="frame">
        <?php
        include 'config.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cart_id = $_POST['cart_id'];

            // Retrieve payment type from shopping cart
            $paymentType = getPaymentType($conn, $cart_id);

            // Retrieve items and calculate total price
            $items = getCartItems($conn, $cart_id);
            $totalPrice = calculateTotalPrice($items);

            // Process payment type
            processPayment($totalPrice, $paymentType);
        }

        function getPaymentType($conn, $cart_id) {
            $stmt = $conn->prepare("SELECT payment_type FROM shopping_cart WHERE id = :cart_id");
            $stmt->bindParam(':cart_id', $cart_id);
            $stmt->execute();
            return $stmt->fetchColumn();
        }

        function getCartItems($conn, $cart_id) {
            $stmt = $conn->prepare("SELECT p.unit_price, ci.product_amount
                                    FROM cart_items ci
                                    JOIN products p ON ci.product_id = p.id
                                    WHERE ci.cart_id = :cart_id");
            $stmt->bindParam(':cart_id', $cart_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        function calculateTotalPrice($items) {
            $totalPrice = 0;
            foreach ($items as $item) {
                $totalPrice += $item['unit_price'] * $item['product_amount'];
            }
            return $totalPrice;
        }

        function processPayment($totalPrice, $paymentType) {
            if (isset($_POST['cash'])) {
                echo "<p>Receipt for cash payment. Total Price: $$totalPrice</p>";
            } elseif (isset($_POST['card'])) {
                $totalPrice *= 0.95;
                echo "<p>Receipt for card payment with 5% discount. Total Price: $$totalPrice</p>";
            } else {
                echo "<p>Invalid payment type.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
