<?php

include("../config/db.php");

if(!isset($_POST['product_id']))
{
    exit();
}

$product_id = $_POST['product_id'];

$query = mysqli_query($conn,"
SELECT *
FROM products
WHERE id='$product_id'
");

$product = mysqli_fetch_assoc($query);

?>
<?php

$product_id = $_POST['product_id'];

$query = mysqli_query($conn,"
SELECT *
FROM products
WHERE id='$product_id'
");

$product = mysqli_fetch_assoc($query);
?>

<div class="row g-4">

    <div class="col-md-6">

        <div class="product-modal-image">

            <img src="../admin/uploads/products/<?php echo $product['product_image']; ?>"
                 class="img-fluid rounded shadow-sm w-100">

        </div>

    </div>

    <div class="col-md-6">

        <span class="badge bg-danger mb-2">
            Premium Jewellery
        </span>

        <h2 class="fw-bold mb-3">
            <?php echo $product['product_name']; ?>
        </h2>

        <h3 class="text-danger mb-3">
            ₹ <?php echo number_format($product['product_price']); ?>
        </h3>

        <div class="mb-3 text-warning">
            ★★★★★
        </div>

        <p class="text-muted">
            <?php echo $product['product_description']; ?>
        </p>

        <hr>

        <div class="d-grid gap-2">

            <a href="add-cart.php?id=<?php echo $product['id']; ?>"
               class="btn btn-dark btn-lg">
                <i class="fa fa-shopping-cart"></i>
                Add To Cart
            </a>

            <a href="add-wishlist.php?id=<?php echo $product['id']; ?>"
               class="btn btn-outline-danger btn-lg">
                <i class="fa fa-heart"></i>
                Add To Wishlist
            </a>
<button
class="btn btn-success btn-lg buyNowBtn"
data-id="<?php echo $product['id']; ?>">
Buy Now
<i class="fa fa-bolt"></i>
</button>
        </div>

    </div>

</div>

<div class="modal fade" id="buyNowModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Checkout
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body"
                 id="buyNowContent">

                Loading...

            </div>

        </div>

    </div>

</div>

<script>
$(document).on('click','.buyNowBtn',function(){

    var product_id = $(this).data('id');

    $.ajax({

        url:'ajax-buy-now.php',

        type:'POST',

        data:{
            product_id:product_id
        },

        success:function(response){

            $('#buyNowContent').html(response);

            var modal = new bootstrap.Modal(
                document.getElementById('buyNowModal')
            );

            modal.show();

        }

    });

});
</script>