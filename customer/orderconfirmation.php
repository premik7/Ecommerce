<!DOCTYPE html>
<html lang="en">
<head>
    <style>
     
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }


        .order-confirmation-message {
            font-size: 30px;
            color: #fff;
            background-color: #2ecc71; 
            padding: 30px 60px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            opacity: 0; 
            transform: translateY(-50px); 
            animation: fadeInUp 2s forwards; 
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(-50px); 
            }
            100% {
                opacity: 1;
                transform: translateY(0); 
            }
        }


        .timer {
            font-size: 20px;
            color: #333;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <?php
    echo "<div class='order-confirmation-message'>Order confirmed</div>";
    ?>


    <div id="timer" class="timer">Redirecting in 10 seconds...</div>

    <script>
  
        let countdown = 10;
        const timerElement = document.getElementById('timer');

       
        const interval = setInterval(() => {
            if (countdown > 0) {
                countdown--;
                timerElement.textContent = `Redirecting in ${countdown} seconds...`;
            } else {
                clearInterval(interval);
                window.location.href = "home.php";
            }
        }, 1000);
    </script>

</body>
</html>
