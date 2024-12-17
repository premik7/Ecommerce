<?php
include "../shared/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $status = $_POST['status'];


    if (!in_array($status, ['Approved', 'Rejected'])) {
        die("Invalid status.");
    }

    $sql = "UPDATE returns SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            echo "Refund request updated successfully.";
        } else {
            echo "Error: Could not update the refund status.";
        }

        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }

    $conn->close();


    header("Location: viewrefunds.php");
    exit();
}
?>
