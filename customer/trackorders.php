<!DOCTYPE html>
<html lang="en">
<head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        color: #2c3e50;
        margin-top: 30px;
        font-size: 28px;
    }

    .order-history-container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .order-history-table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #ffffff;
    }

    .order-history-table th, .order-history-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .order-history-table th {
        background-color: #3498db;
        color: white;
        font-size: 16px;
    }

    .order-history-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .order-history-table tr:hover {
        background-color: #e1e1e1;
    }

    .no-orders-message {
        text-align: center;
        font-size: 18px;
        color: #e74c3c;
        margin-top: 30px;
    }

    .return-button {
        background-color: #2ecc71;
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        border-radius: 4px;
    }

    .return-button:hover {
        background-color: #27ae60;
    }
</style>
</head>
<body>
    
<?php


include "authguard.php";
include "../shared/connection.php";
include "menu.html";

$sql = "
    SELECT orders.id AS order_id, orders.order_date, product.name AS product_name, 
           product.price, COALESCE(returns.status, 'No Request') AS refund_status
    FROM orders 
    INNER JOIN product ON orders.pid = product.pid 
    LEFT JOIN returns ON orders.id = returns.order_id
    WHERE orders.userid = $_SESSION[userid] 
    ORDER BY orders.order_date DESC;
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='order-history-container'>";
    echo "<h2>Your Order History</h2>";
    echo "<table class='order-history-table'>";
    echo "<thead><tr><th>Order ID</th><th>Product Name</th><th>Price</th><th>Order Date</th><th>Refund Status</th><th>Action</th></tr></thead>";
    echo "<tbody>";


    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['order_id'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>$" . number_format($row['price'], 2) . "</td>";
        echo "<td>" . date('F j, Y', strtotime($row['order_date'])) . "</td>";
        echo "<td>" . $row['refund_status'] . "</td>";

   
        if ($row['refund_status'] == 'No Request') {
            echo "<td><a href='RefundForm.php?order_id=" . $row['order_id'] . "'><button class='return-button'>Request Return</button></a></td>";
        } else {
            echo "<td>N/A</td>";
        }

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<div class='no-orders-message'><h3>You have not placed any orders yet.</h3></div>";
}

?>
</body>
</html>
