<?php
include "authguard.php";
include "../shared/connection.php";
include "menu.html";
?>

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
            font-size: 20px;
            color: #e74c3c; 
            font-weight: bold;
            margin-top: 30px;
            padding: 20px;
            background-color: #f8d7da; 
            border: 1px solid #f5c6cb; 
            border-radius: 8px;
            width: 80%;
            margin: 30px auto; 
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .assign-delivery-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .assign-delivery-form select,
        .assign-delivery-form button {
            margin: 5px;
        }
    </style>
</head>
<body>
    <?php

    $result = mysqli_query($conn, "SELECT 
                                      orders.id AS order_id, 
                                      orders.order_date, 
                                      product.name AS product_name, 
                                      product.price, 
                                      user.username AS customer_name, 
                                      orders.delivery_partner_id,
                                      delivery_partners.id AS partner_id, 
                                      delivery_partners.name AS partner_name
                                  FROM orders
                                  INNER JOIN product ON orders.pid = product.pid
                                  INNER JOIN user ON orders.userid = user.userid
                                  LEFT JOIN delivery_partners ON orders.delivery_partner_id = delivery_partners.id
                                  WHERE product.owner = $_SESSION[userid]
                                  ORDER BY orders.order_date DESC;");

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='order-history-container'>";
        echo "<h2>Your Order History</h2>";
        echo "<table class='order-history-table'>";
        echo "<thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Order Date</th>
                    <th>Assigned Delivery Partner</th>
                    <th>Assign Delivery Partner</th>
                </tr>
              </thead>";
        echo "<tbody>";


        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . $row['customer_name'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['order_date'] . "</td>";
            echo "<td>" . ($row['partner_name'] ?? "Not Assigned") . "</td>";
            echo "<td>
                    <form method='POST' action='AssignDelivery.php' class='assign-delivery-form'>
                        <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                        <select name='delivery_partner_id' required>
                            <option value=''>Select Partner</option>";

    
            $partners = mysqli_query($conn, "SELECT id, name FROM delivery_partners");
            while ($partner = mysqli_fetch_assoc($partners)) {
                echo "<option value='" . $partner['id'] . "'>" . $partner['name'] . "</option>";
            }

            echo "      </select>
                        <button type='submit' class='btn btn-success'>Assign</button>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</tbody></table></div>";
    } else {
        echo "<div class='no-orders-message'>No orders have been placed for your products yet.</div>";
    }
    ?>
</body>
</html>
