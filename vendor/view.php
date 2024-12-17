
<?php
include "authguard.php";
include "menu.html";

include "../shared/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .cart-container {
        display: flex;
        flex-wrap: wrap; 
        gap: 10px;
        padding: 10px; 
    }

    .card {
        color: black;
        width: 18rem; 
        display: flex;
        flex-direction: column; 
        border: 1px solid #ddd; 
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); 
        border-radius: 5px; 
    }

    .card img {
        width: 100%; 
        height: 200px; 
        object-fit: cover; 
        border-top-left-radius: 5px; 
        border-top-right-radius: 5px;
    }

    .card .price {
        color: goldenrod;
        font-size: 22px;
    }

    .card .price::after {
        content: " Rs";
        font-size: 12px;
    }

    .card-body {
        padding: 10px;
    }

    .btn {
        margin-right: 5px;
    }
</style>
</head>
<body>

<div class="cart-container">
<?php


$sql_result = mysqli_query($conn, "select * from product where owner=$_SESSION[userid]");

while ($dbrow = mysqli_fetch_assoc($sql_result)) {
    echo "<div class='card'>
        <img src='$dbrow[impath]' class='card-img-top' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'>$dbrow[name]</h5>
            <h6 class='price'>$dbrow[price]</h6>
            <p class='card-text'>$dbrow[details]</p>
            <a href='delete.php?pid=$dbrow[pid]' class='btn btn-primary'>Remove</a>
        </div>
    </div>";
}
?>
</div>

</body>
</html>
