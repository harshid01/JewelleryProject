<?php

session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];

$product_id = $_POST['product_id'];

$shipping_address = mysqli_real_escape_string(
    $conn,
    $_POST['shipping_address']
);

$productQuery = mysqli_query($conn,"
SELECT *
FROM products
WHERE id='$product_id'
");

$product = mysqli_fetch_assoc($productQuery);

$order_number = "AJP".time();

mysqli_query($conn,"
INSERT INTO orders
(
    order_number,
    user_id,
    shipping_address,
    total_amount,
    payment_method,
    payment_status,
    order_status,
    tracking_number,
    order_date
)
VALUES
(
    '$order_number',
    '$user_id',
    '$shipping_address',
    '".$product['product_price']."',
    'COD',
    'Pending',
    'Pending',
    '',
    NOW()
)
");

echo "success";