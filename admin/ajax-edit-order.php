<?php

include '../config/db.php';

$id = $_POST['id'];

$query = mysqli_query($conn,"
SELECT *
FROM orders
WHERE id='$id'
");

$row = mysqli_fetch_assoc($query);

?>

<form id="updateOrderForm">

<input type="hidden"
       name="id"
       value="<?= $row['id']; ?>">

<div class="mb-3">

<label>Order Status</label>

<select name="order_status"
        class="form-select">

<option <?= $row['order_status']=="Pending"?"selected":"" ?>>
Pending
</option>

<option <?= $row['order_status']=="Processing"?"selected":"" ?>>
Processing
</option>

<option <?= $row['order_status']=="Shipped"?"selected":"" ?>>
Shipped
</option>

<option <?= $row['order_status']=="Delivered"?"selected":"" ?>>
Delivered
</option>

<option <?= $row['order_status']=="Cancelled"?"selected":"" ?>>
Cancelled
</option>

</select>

</div>

<div class="mb-3">

<label>Payment Status</label>

<select name="payment_status"
        class="form-select">

<option <?= $row['payment_status']=="Pending"?"selected":"" ?>>
Pending
</option>

<option <?= $row['payment_status']=="Paid"?"selected":"" ?>>
Paid
</option>

</select>

</div>

<div class="mb-3">

<label>Tracking Number</label>

<input type="text"
       class="form-control"
       name="tracking_number"
       value="<?= $row['tracking_number']; ?>">

</div>

<button type="submit"
        class="btn btn-success">

Update Order

</button>

</form>

<script>

$("#updateOrderForm").submit(function(e){

    e.preventDefault();

    $.ajax({

        url:"ajax-update-order.php",

        type:"POST",

        data:$(this).serialize(),

        success:function(){

            location.reload();

        }

    });

});

</script>