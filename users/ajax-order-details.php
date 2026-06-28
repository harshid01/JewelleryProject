<?php

include("includes/master-top.php");

if(isset($_POST['order_id']))
{
    $order_id = (int)$_POST['order_id'];

    $orderQuery = mysqli_query(
        $conn,
        "SELECT *
         FROM orders
         WHERE id='$order_id'
         AND user_id='$user_id'"
    );

    if(mysqli_num_rows($orderQuery) > 0)
    {
        $order = mysqli_fetch_assoc($orderQuery);
?>

<div class="row">

<div class="col-md-6 mb-3">

<b>Order Number :</b><br>
<?php echo $order['order_number']; ?>

</div>

<div class="col-md-6 mb-3">

<b>Order Date :</b><br>
<?php echo date(
    "d-m-Y",
    strtotime($order['order_date'])
); ?>

</div>

<div class="col-md-6 mb-3">

<b>Total Amount :</b><br>
₹<?php echo number_format(
    $order['total_amount']
); ?>

</div>

<div class="col-md-6 mb-3">

<b>Payment Method :</b><br>
<?php echo $order['payment_method']; ?>

</div>

<div class="col-md-6 mb-3">

<b>Payment Status :</b><br>
<?php echo $order['payment_status']; ?>

</div>

<div class="col-md-6 mb-3">

<b>Order Status :</b><br>
<?php echo $order['order_status']; ?>

</div>

<div class="col-12">

<b>Shipping Address :</b><br>

<?php echo nl2br(
    $order['shipping_address']
); ?>

</div>

<?php
if(!empty($order['tracking_number']))
{
?>

<div class="col-12 mt-3">

<b>Tracking Number :</b><br>

<?php echo $order['tracking_number']; ?>

</div>

<?php
}
?>

</div>

<?php
    }
}
?>