<?php
include "../shared/connection.php";
include "menu.html";

$sql = "SELECT r.id, r.order_id, r.customer_name, r.reason, r.refund_amount, r.status, o.id AS order_id 
        FROM returns r 
        INNER JOIN orders o ON r.order_id = o.id 
        ORDER BY r.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Refund Requests</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
            color: #444;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0f7fa;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-accept {
            background-color: #28a745;
            color: white;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .btn-accept:hover {
            background-color: #218838;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin: 20px;
        }

        .message a {
            color: #4CAF50;
            font-weight: bold;
        }

        .message a:hover {
            text-decoration: underline;
        }

        .no-requests {
            text-align: center;
            font-size: 18px;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Refund Requests</h1>
    <div class="message">
        <p>Below are the refund requests submitted by customers. You can approve or reject them.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Reason</th>
                <th>Refund Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['reason']); ?></td>
                        <td><?php echo "$" . number_format($row['refund_amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] == 'Pending'): ?>
                                <form action="updaterefund.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="status" value="Approved">
                                    <button type="submit" class="btn btn-accept">Approve</button>
                                </form>
                                <form action="updaterefund.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="btn btn-reject">Reject</button>
                                </form>
                            <?php else: ?>
                                <span><?php echo $row['status']; ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="no-requests">No refund requests found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
