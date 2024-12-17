<?php
include "../shared/connection.php";

mysqli_query($conn,"delete from product where pid=$_GET[pid]");

header("location:view.php");
?>