<?php
include "authguard.php";
include "../shared/connection.php";
include "menu.html";


echo "<style>
    h3 {
        font-family: Arial, sans-serif;
        color: #333;
        background-color: #f4f4f4;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
</style>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pid = $_POST['pid'];
    $userid = $_SESSION['userid'];
    $rating = $_POST['rating'];
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    $check_review = mysqli_query($conn, "select * FROM reviews WHERE pid = $pid AND userid = $userid");

    if (mysqli_num_rows($check_review) > 0) {
        echo "<div><h3>You have already reviewed this product.</h3></div>";
    } else {
        $insert_review = mysqli_query($conn, "insert INTO reviews (pid, userid, rating, review, review_date) VALUES ($pid, $userid, $rating, '$review', NOW())");

        if ($insert_review) {
            echo "<div><h3>Thank you for your review!</h3></div>";
        } else {
            echo "<div><h3>Failed to submit your review. Please try again.</h3></div>";
        }
    }
} else {
    echo "<div><h3>Invalid request.</h3></div>";
}
?>
