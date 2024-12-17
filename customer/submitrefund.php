<!DOCTYPE html>
<html lang="en">
<head>

     <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 50px;
        }

        .message {
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .success-message {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
        }

        .error-message {
            background-color: #f44336;
            color: white;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            color: white;
            background-color: #008CBA;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }

        a:hover {
            background-color: #005f72;
        }
   </style>
</head>
<body>
    
</body>
</html>

<?php


include "../shared/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $user_id = $_POST['user_id'];
    $customer_name = $_POST['customer_name'];
    $reason = $_POST['reason'];
    $refund_amount = $_POST['refund_amount'];


    $sql = "INSERT INTO returns (order_id, user_id, customer_name, reason, status, refund_amount) 
            VALUES (?, ?, ?, ?, 'Pending', ?)";
    

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iissd", $order_id, $user_id, $customer_name, $reason, $refund_amount);


        if ($stmt->execute()) {
           
            echo "<div class='success-message'>
                    Refund request submitted successfully. You will be redirected in <span id='countdown'>5</span> seconds...
                  </div>";

            echo "<script>
                    var countdownElement = document.getElementById('countdown');
                    var seconds = 5;
                    var countdownInterval = setInterval(function() {
                        seconds--;
                        countdownElement.textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(countdownInterval);
                            window.location.href = 'home.php'; // Redirect to the homepage
                        }
                    }, 1000); // Update every second
                  </script>";
            exit();
        } else {
            echo "<div class='error-message'>
                    Error: Could not submit the refund request. Please try again later.
                  </div>";
        }


        $stmt->close();
    } else {
        echo "<div class='error-message'>
                Error preparing the SQL statement: " . $conn->error . "
              </div>";
    }

    $conn->close();
}
?>
