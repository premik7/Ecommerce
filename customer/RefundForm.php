<?php
include "../shared/connection.php";
include "authguard.php";
include "menu.html";

if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    die("Invalid Order ID.");
}
$order_id = intval($_GET['order_id']);

if (!isset($_SESSION['userid'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['userid'];
$user_name = ''; 
$product_price = 0.00; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT o.id, u.username, p.price 
        FROM orders o 
        INNER JOIN user u ON o.userid = u.userid 
        INNER JOIN product p ON o.pid = p.pid 
        WHERE o.id = ? AND o.userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {

    $user_name = $row['username'];
    $product_price = $row['price'];
} else {
    die("Order not found or does not belong to the logged-in user.");
}


$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        .container {
            width: 50%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input[readonly] {
            background-color: #f1f1f1;
        }

        .form-group select {
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    <h1>Refund Request Form</h1>
    <div class="container">
        <form action="submitrefund.php" method="POST">
            <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($user_name); ?>" readonly><br>
            </div>

            <div class="form-group">
                <label for="order_id">Order ID:</label>
                <input type="text" id="order_id" name="order_id" value="<?php echo $order_id; ?>" readonly required><br>
            </div>

            <div class="form-group">
                <label for="product_price">Product Price:</label>
                <input type="text" id="product_price" name="product_price" value="$<?php echo number_format($product_price, 2); ?>" readonly><br>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Refund:</label>
                <select id="reason" name="reason" required>
                    <option value="Damaged Item">Damaged Item</option>
                    <option value="Incorrect Item">Incorrect Item</option>
                    <option value="Late Delivery">Late Delivery</option>
                    <option value="Item Not Needed">Item Not Needed</option>
                    <option value="Other">Other</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="refund_amount">Refund Amount:</label>
                <input type="number" step="0.01" id="refund_amount" name="refund_amount" value="<?php echo number_format($product_price, 2); ?>" required><br>
            </div>

            <input type="submit" value="Submit Refund Request">
        </form>
    </div>
</body>
</html>
