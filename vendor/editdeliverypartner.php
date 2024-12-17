<?php
include "authguard.php"; 
include "../shared/connection.php"; 
include "menu.html";


if (isset($_GET['id'])) {
    $partner_id = $_GET['id'];

    $query = "SELECT * FROM delivery_partners WHERE id = $partner_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $partner = mysqli_fetch_assoc($result);
    } else {
        $error_message = "Delivery partner not found.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];


    $update_query = "UPDATE delivery_partners SET name = '$name', contact_number = '$contact', email = '$email' WHERE id = $partner_id";
    if (mysqli_query($conn, $update_query)) {
        $success_message = "Delivery partner details updated successfully.";
    } else {
        $error_message = "Error updating delivery partner details: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Edit Delivery Partner</title>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h3 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-container .form-control {
            margin-bottom: 15px;
        }
        .form-container .btn {
            width: 100%;
            background-color: #007bff;
            color: white;
            font-size: 16px;
        }
        .form-container .btn:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
        .message.success {
            color: #28a745;
        }
        .message.error {
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Edit Delivery Partner</h3>


    <?php if (isset($success_message)): ?>
        <div class="message success"><?= $success_message ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="message error"><?= $error_message ?></div>
    <?php endif; ?>

  
    <?php if (isset($partner)): ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($partner['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($partner['contact_number']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($partner['email']) ?>" required>
            </div>
            <button type="submit" class="btn">Update Delivery Partner</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
