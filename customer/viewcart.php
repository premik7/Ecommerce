<?php
 include "authguard.php";
 include "../shared/connection.php";
 include "menu.html";

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
   .price {
      color: goldenrod;
      font-size: 22px;
   }
   .price::after {
      content: " Rs";
      font-size: 12px;
   }
   .ordertype-container {
      margin: 20px;
      padding: 10px;
      background-color: #f8f9fa;
      border: 1px solid #ccc;
      border-radius: 5px;
      text-align: center;
   }
   .ordertype {
      margin: 10px;
      padding: 6px;
   }
</style>
</head>
<body>

<div class="cart-container">
<?php

 $sql_result = mysqli_query($conn,"select * from cart join product on cart.pid=product.pid where userid=$_SESSION[userid]");

 $total = 0;

while ($dbrow = mysqli_fetch_assoc($sql_result)) {

   $total += $dbrow["price"];

  echo "<div class='card' style='width: 18rem;'>
  <img src='$dbrow[impath]' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$dbrow[name]</h5>
     <h6 class='price'>$dbrow[price]</h6>
    <p class='card-text'>$dbrow[details]</p>
    <div class='text-center'>
    <a href='deletecart.php?cartid=$dbrow[cartid]' class='btn btn-primary'>Remove from cart</a>
    </div>
  </div>
</div>";
}
?>
</div>

<div class="ordertype-container">
   <div class="display-2">Checkout</div>
   <div class="display-4">Total: <?php echo $total; ?> Rs</div>
   <div>
      <select name="ordertype" class="ordertype">
         <option value="COD">Cash on Delivery</option>
      </select>
   </div>
   <div class="text-center">
      <a href="placeorder.php">
         <button class="btn btn-success">Place Order</button>
      </a>
   </div>
</div>

</body>
</html>
