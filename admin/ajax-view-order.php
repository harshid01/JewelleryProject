<?php

include '../config/db.php';

$id = $_POST['id'];

$query = mysqli_query($conn,"
SELECT orders.*, users.full_name
FROM orders
LEFT JOIN users
ON users.id = orders.user_id
WHERE orders.id='$id'
");

$row = mysqli_fetch_assoc($query);

?>

<div class="row">

    <div class="col-md-6 mb-3">
        <strong>Order Number</strong><br>
        <?= $row['order_number']; ?>
    </div>

    <div class="col-md-6 mb-3">
        <strong>Customer</strong><br>
        <?= $row['full_name']; ?>
    </div>

    <div class="col-md-6 mb-3">
        <strong>Amount</strong><br>
        ₹<?= number_format($row['total_amount'],2); ?>
    </div>

    <div class="col-md-6 mb-3">
        <strong>Payment Method</strong><br>
        <?= $row['payment_method']; ?>
    </div>

    <div class="col-md-6 mb-3">
        <strong>Payment Status</strong><br>
        <?= $row['payment_status']; ?>
    </div>

    <div class="col-md-6 mb-3">
        <strong>Order Status</strong><br>
        <?= $row['order_status']; ?>
    </div>

    <div class="col-md-12 mb-3">
        <strong>Shipping Address</strong><br>
        <?= $row['shipping_address']; ?>
    </div>

    <div class="col-md-12">
        <strong>Tracking Number</strong><br>
        <?= $row['tracking_number']; ?>
    </div>

</div>