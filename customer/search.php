<?php

include "menu.html";
include "authguard.php";
include "../shared/connection.php";


$query = isset($_GET['q']) ? $_GET['q'] : '';

$searchQuery = mysqli_real_escape_string($conn, $query);


$sql = "SELECT * FROM product WHERE name LIKE '%$searchQuery%' OR details LIKE '%$searchQuery%'";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Search Results</title>
</head>
<body>
<div class="container my-4">
    <h1 class="text-center">Search Results</h1>
    <p class="text-center">Showing results for: <strong><?php echo htmlspecialchars($query); ?></strong></p>
    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-4 mb-3'>";
                echo "    <div class='card'>";
                echo "        <img src='{$row['impath']}' class='card-img-top' alt='{$row['name']}'>";
                echo "        <div class='card-body'>";
                echo "            <h5 class='card-title'>{$row['name']}</h5>";
                echo "            <p class='card-text'>{$row['details']}</p>";
                echo "            <p class='price'>Price: {$row['price']} Rs</p>";
                echo "            <a href='addcart.php?pid={$row['pid']}' class='btn btn-primary'>Add to Cart</a>";
                echo "        </div>";
                echo "    </div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>No results found for your search.</p>";
        }
        ?>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG81rK2Az0g8E3p1Au6j7UH9fU94K4I5j6tXtzoH65Erj5DYj1qjE5eNyZa" crossorigin="anonymous"></script>
</body>
</html>
