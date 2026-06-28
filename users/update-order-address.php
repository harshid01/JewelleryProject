<?php

session_start();
include("../config/db.php");

$order_id = $_POST['order_id'];

$shipping_address =
mysqli_real_escape_string(
    $conn,
    $_POST['shipping_address']
);

mysqli_query($conn,"
UPDATE orders
SET shipping_address='$shipping_address'
WHERE id='$order_id'
");

header("Location: Orders.php");
exit();

?>