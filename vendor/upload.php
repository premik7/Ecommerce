<!DOCTYPE html>
<html lang="en">
    <head>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
<style>


                body {
                    background: linear-gradient(135deg, #e9ecef, #f8f9fa);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    font-family: 'Arial', sans-serif;
                }
                .success-container {
                    text-align: center;
                    background: #fff;
                    padding: 30px;
                    border-radius: 8px;
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                }
                .success-container h3 {
                    color: #28a745; 
                }
                .success-container p {
                    color: #495057;
                }
            </style>
            <script>
                let countdown = 5;
                function updateCountdown() {
                    const countdownElement = document.getElementById('countdown');
                    countdown--;
                    countdownElement.textContent = countdown;
                    if (countdown === 0) {
                        window.location.href = 'home.php';
                    } else {
                        setTimeout(updateCountdown, 1000);
                    }
                }
                window.onload = updateCountdown;
            </script>
        </head>
<body>
    
</body>
</html>
<?php

include "authguard.php";

include "../shared/connection.php";


$filename = $_FILES['pdtimg']['name'];
$source_path = $_FILES['pdtimg']['tmp_name'];
$target_path = "../shared/images/" . $filename;

if (move_uploaded_file($source_path, $target_path)) {

    $query = "INSERT INTO product (name, price, details, impath, owner) 
              VALUES ('$_POST[name]', '$_POST[price]', '$_POST[details]', '$target_path', $_SESSION[userid])";
    if (mysqli_query($conn, $query)) {

        echo "      
        <body>
            <div class='success-container'>
                <h3>Product Uploaded Successfully!</h3>
                <p>You will be redirected to the home page in <span id='countdown'>5</span> seconds.</p>
                <a href='home.php' class='btn btn-success'>Go to Home Now</a>
            </div>
        ";
    } else {
        echo "Error inserting data into the database: " . mysqli_error($conn);
    }
} else {
    echo "Error uploading file.";
}
?>
