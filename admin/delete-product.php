<?php

include '../config/db.php';

$id = $_GET['id'];

$get = mysqli_query(
    $conn,
    "SELECT product_image FROM products WHERE id='$id'"
);

$row = mysqli_fetch_assoc($get);

if(!empty($row['product_image']))
{
    $file = 'uploads/products/'.$row['product_image'];

    if(file_exists($file))
    {
        unlink($file);
    }
}

mysqli_query(
    $conn,
    "DELETE FROM products WHERE id='$id'"
);

header("Location: products.php");
exit();