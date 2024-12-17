<?php
include "authguard.php";
include "../shared/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $delivery_partner_id = $_POST['delivery_partner_id'];

    $query = "UPDATE orders SET delivery_partner_id = '$delivery_partner_id' WHERE id = '$order_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Delivery partner assigned successfully!');
                window.location.href = 'vieworders.php'; // Redirect back to orders
              </script>";
    } else {
        echo "Error assigning delivery partner: " . mysqli_error($conn);
    }
}
?>
