<?php

include "../shared/connection.php"; 
$sql_result = mysqli_query($conn, "select * from product");
include "authguard.php";
include "menu.html";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
   .cart-container {
      display: flex;
      flex-wrap: wrap; 

      padding: 10px;

   }

   .card {
     
      color: black;
      width: 18rem; 
      margin: 10px;
      display: flex;
      flex-direction: column;
   }

   .card img {
       width: 100%; 
       height: 200px; 
       object-fit: cover; 
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



while ($dbrow = mysqli_fetch_assoc($sql_result)) {
   echo "<div class='card'>
      <img src='$dbrow[impath]' class='card-img-top' alt='...'>
      <div class='card-body'>
         <h5 class='card-title'>$dbrow[name]</h5>
         <h6 class='price'>$dbrow[price]</h6>
         <p class='card-text'>$dbrow[details]</p>
         <a href='addcart.php?pid=$dbrow[pid]' class='btn btn-primary'>Add to cart</a>
         <a href='review.php?pid=$dbrow[pid]' class='btn btn-secondary'>Add review</a>
      </div>
   </div>";
}
?>
</div>
</body>
</html>
