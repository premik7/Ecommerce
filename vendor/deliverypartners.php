<?php
include "authguard.php";
include "../shared/connection.php"; 
include "menu.html";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];


    $query = "INSERT INTO delivery_partners (name, contact_number, email) 
              VALUES ('$name', '$contact', '$email')";
    if (mysqli_query($conn, $query)) {
        $success_message = "Delivery partner added successfully.";
    } else {
        $error_message = "Error adding delivery partner: " . mysqli_error($conn);
    }
}


if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    $remove_query = "DELETE FROM delivery_partners WHERE id = $remove_id";
    if (mysqli_query($conn, $remove_query)) {
        $success_message = "Delivery partner removed successfully.";
    } else {
        $error_message = "Error removing delivery partner: " . mysqli_error($conn);
    }
}


$sql = "SELECT * FROM delivery_partners";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Manage Delivery Partners</title>
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
        .table-container {
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-remove, .btn-edit {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .btn-remove {
            background-color: #dc3545;
            color: white;
        }
        .btn-remove:hover {
            background-color: #c82333;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Add New Delivery Partner</h3>


    <?php if (isset($success_message)): ?>
        <div class="message success"><?= $success_message ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="message error"><?= $error_message ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter delivery partner's name" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
        </div>
        <button type="submit" class="btn">Add Delivery Partner</button>
    </form>
</div>

<div class="table-container">
    <h3>Delivery Partners List</h3>

   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['contact_number']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td>
                            <a href="editdeliverypartner.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                            <a href="?remove_id=<?= $row['id'] ?>" class="btn btn-remove" onclick="return confirm('Are you sure you want to remove this partner?')">Remove</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No delivery partners found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
