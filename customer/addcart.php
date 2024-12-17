<?php

include "authguard.php";
include "../shared/connection.php"; 

mysqli_query($conn,"insert into  cart(userid,pid) values ($_SESSION[userid],$_GET[pid])");

header("location:viewcart.php");

?>