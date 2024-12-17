<?php
include "menu.html";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review for Selected Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            color: #333;
        }


        .stars {
            display: flex;
            gap: 10px;
            flex-direction: row-reverse;
        }

        .stars input[type="radio"] {
            display: none;
        }

        .stars label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }


        .stars input[type="radio"]:checked ~ label {
            color: #FFD700; 
        }


        .stars input[type="radio"]:not(:checked) ~ label:hover,
        .stars input[type="radio"]:not(:checked) ~ label:hover ~ label {
            color: #FFD700; 
        }

        textarea {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            resize: vertical;
        }

        button {
            padding: 12px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Add a Review for a Product</h2>
    <div class="container">
        <form action="addreview.php" method="POST">
            <?php
            if (isset($_GET['pid'])) {
                echo "<input type='hidden' name='pid' value=$_GET[pid]>";
            } else {
                echo "<div class='error-message'><h3>Invalid Product ID.</h3></div>";
                exit;
            }
            ?>
            <label for="rating">Rating:</label>
            <div class="stars">
                <input type="radio" id="star1" name="rating" value="1" required>
                <label for="star1">&#9733;</label>
                
                <input type="radio" id="star2" name="rating" value="2" required>
                <label for="star2">&#9733;</label>
                
                <input type="radio" id="star3" name="rating" value="3" required>
                <label for="star3">&#9733;</label>
                
                <input type="radio" id="star4" name="rating" value="4" required>
                <label for="star4">&#9733;</label>
                
                <input type="radio" id="star5" name="rating" value="5" required>
                <label for="star5">&#9733;</label>
            </div><br>

            <label for="review">Review:</label><br>
            <textarea id="review" name="review" rows="4" cols="50" required></textarea><br><br>

            <button type="submit">Submit Review</button>
        </form>
    </div>
</body>
</html>
