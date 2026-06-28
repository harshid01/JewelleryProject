<?php

include '../config/db.php';

$id = $_POST['id'];
$order_status = $_POST['order_status'];
$payment_status = $_POST['payment_status'];
$tracking_number = $_POST['tracking_number'];

mysqli_query($conn,"
UPDATE orders
SET
order_status='$order_status',
payment_status='$payment_status',
tracking_number='$tracking_number'
WHERE id='$id'
");

echo "success";