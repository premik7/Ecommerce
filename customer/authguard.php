<?php

session_start();

if ($_SESSION['login_status']==false) {
    echo "unauthorized Attempt";
    exit();
}

if ($_SESSION['usertype'] !=  "Customer") {
    echo "Forbidden Access";
    exit();
}


?>
