<?php

include "authguard.php";
include "menu.html";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef); /* Subtle gradient for the background */
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow for a modern look */
            padding: 30px;
            max-width: 500px;
            width: 90%;
            margin: auto;
        }

        .form-container h3 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
        }

        .form-container .form-control:focus {
            border-color: #495057;
            box-shadow: 0 0 5px rgba(73, 80, 87, 0.2); /* Highlight focus */
        }

        .form-container .btn {
            background: #d9534f; /* Bootstrap danger color */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            transition:  0.3s ease;
        }

        .form-container .btn:hover {
            background: #c9302c;
        }

        .form-container .text-center {
            margin-top: 15px;
        }
    </style>
    <title>Upload Product</title>
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <form action="upload.php" method="post" class="form-container" enctype="multipart/form-data">
        <h3 class="text-center">Upload Products</h3>
        <input class="form-control mt-3" type="text" placeholder="Product Name" name="name">
        <input class="form-control mt-2" type="text" placeholder="Product Price" name="price">
        <textarea class="form-control mt-2" name="details" cols="30" rows="5" placeholder="Product Description"></textarea>
        <input class="form-control mt-2" type="file" name="pdtimg" accept=".jpg,.png,.jpeg">
        <div class="text-center">
            <button type="submit" class="mt-3 btn btn-danger">Upload</button>
        </div>
    </form>
</div>
</body>
</html>
