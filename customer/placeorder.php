<?php

include "authguard.php";
include "../shared/connection.php"; 


$result = mysqli_query($conn, "select * from cart where userid = $_SESSION[userid]");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        mysqli_query($conn, "insert into orders(userid, pid, order_date) values ($_SESSION[userid],$row[pid], NOW())");
    }
    mysqli_query($conn, "delete from cart where userid = $_SESSION[userid]");

     header("location:orderconfirmation.php");

} else { 
  echo "
  <div>
     <h3>Cart is empty please add items to cart</h3>
  </div>
  ";
}

?>
