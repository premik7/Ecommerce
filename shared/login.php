

<?php

session_start();
$_SESSION['login_status']=false;

include "connection.php";

 $sql_result = mysqli_query($conn ,"select * from user where username='$_POST[username]' and password='$_POST[password]'");

if ($sql_result->num_rows == 0) {

    echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Invalid Credentials</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .message-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .message-container h1 {
            color: #dc3545;
            font-size: 2rem;
        }
        .message-container p {
            margin-top: 10px;
            color: #6c757d;
        }
        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class='message-container'>
        <h1>Invalid Credentials</h1>
        <p>The username or password you entered is incorrect.</p>
        <a href='login.html' class='btn'>Go Back to Login</a>
    </div>
</body>
</html>
";
    exit();
}


echo "<h1>Login Successfull</h1>";

$_SESSION['login_status']=true;

$dbrow = mysqli_fetch_assoc($sql_result);

$_SESSION['usertype']=$dbrow['usertype'];
$_SESSION['userid']=$dbrow['userid'];


if ($dbrow['usertype'] == 'Vendor') {
    header("location:../vendor/home.php");

}else if ($dbrow['usertype'] == 'Customer'){
    header("location:../customer/home.php");
}



?>