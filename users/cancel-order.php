<?php

session_start();
include("../config/db.php");

$order_id = $_GET['id'];

mysqli_query($conn,"
UPDATE orders
SET order_status='Cancelled'
WHERE id='$order_id'
");

header("Location: Orders.php");
exit();

?>