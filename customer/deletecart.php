<?php
include "../shared/connection.php";

mysqli_query($conn,"delete from cart where cartid=$_GET[cartid]");

header("location:viewcart.php");
?>