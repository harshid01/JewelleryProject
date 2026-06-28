<?php

session_start();
include("../config/db.php");

$product_id = $_POST['product_id'];

$query = mysqli_query($conn,"
SELECT *
FROM products
WHERE id='$product_id'
");

$product = mysqli_fetch_assoc($query);

?>

<div class="text-center">

    <img src="../admin/uploads/products/<?php echo $product['product_image']; ?>"
         class="img-fluid rounded mb-3"
         style="max-height:200px;">

    <h4>
        <?php echo $product['product_name']; ?>
    </h4>

    <h3 class="text-danger">
        ₹ <?php echo number_format($product['product_price']); ?>
    </h3>

    <hr>

    <form id="placeOrderForm">

        <input type="hidden"
               name="product_id"
               value="<?php echo $product['id']; ?>">

        <div class="mb-3">

            <textarea
                name="shipping_address"
                class="form-control"
                placeholder="Enter Shipping Address"
                required></textarea>

        </div>

        <button type="submit"
                class="btn btn-success w-100">

            Confirm Order

        </button>

    </form>

</div>

<script>

$('#placeOrderForm').submit(function(e){

    e.preventDefault();

    $.ajax({

        url:'place-order.php',

        type:'POST',

        data:$(this).serialize(),

        success:function(response){

            alert('Order Placed Successfully');

            location.reload();

        }

    });

});

</script>