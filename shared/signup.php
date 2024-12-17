<?php

if ($_POST['password'] != $_POST['password2']) {
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Mismatch</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8d7da;
            font-family: Arial, sans-serif;
        }
        .message-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            background-color: #f8d7da;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .message-container h1 {
            color: #721c24;
            font-size: 2rem;
        }
        .message-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .message-container a:hover {
            background-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Password Mismatch</h1>
        <p>Please make sure both passwords match.</p>
        <a href="signup.html">Go Back to Signup</a>
    </div>
</body>
</html>
HTML;
    exit();
}

include "connection.php";


$status = mysqli_query($conn, "INSERT INTO user(username, password, usertype) VALUES('$_POST[username]', '$_POST[password]', '$_POST[usertype]')");


if ($status) {
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Successful</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #d4edda;
            font-family: Arial, sans-serif;
        }
        .message-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            background-color: #d4edda;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .message-container h1 {
            color: #155724;
            font-size: 2rem;
        }
        .message-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .message-container a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Signup Successful</h1>
        <p>Your account has been created successfully!</p>
        <a href="login.html">Go to Login Page</a>
    </div>
</body>
</html>
HTML;
} else {
  
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Failed</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8d7da;
            font-family: Arial, sans-serif;
        }
        .message-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            background-color: #f8d7da;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .message-container h1 {
            color: #721c24;
            font-size: 2rem;
        }
        .message-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .message-container a:hover {
            background-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Signup Failed</h1>
        <p>There was an error creating your account. Please try again later.</p>
        <a href="signup.html">Go Back to Signup</a>
    </div>
</body>
</html>
HTML;
    echo mysqli_error($conn);
}
?>
