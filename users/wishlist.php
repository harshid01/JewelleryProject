<?php
include("includes/master-top.php");
include("includes/sidebar.php");
include("includes/header.php");

/* Wishlist Products */

$wishlistQuery = mysqli_query($conn,"
SELECT w.*,
       p.product_name,
       p.product_price,
       p.product_image
FROM wishlist w
INNER JOIN products p
ON w.product_id = p.id
WHERE w.user_id='$user_id'
ORDER BY w.id DESC
");
?>

<div class="content-wrapper">

<div class="table-container">

<h4>My Wishlist</h4>

<?php
if(isset($_GET['removed']))
{
?>
<div class="alert alert-success">
    Product Removed From Wishlist
</div>
<?php
}
?>

<?php
if(isset($_GET['cart']))
{
?>
<div class="alert alert-success">
    Product Added To Cart
</div>
<?php
}
?>

<div class="row">

<?php

if(mysqli_num_rows($wishlistQuery) > 0)
{
    while($row = mysqli_fetch_assoc($wishlistQuery))
    {

        $image = !empty($row['product_image'])
        ? "../admin/uploads/products/".$row['product_image']
        : "../images/no-image.png";
?>

<div class="col-lg-4 col-md-6 mb-4">

<div class="product-card">

<div class="product-image">

<img src="<?php echo $image; ?>"
     class="img-fluid rounded"
     style="height:250px;width:100%;object-fit:cover;">

</div>

<div class="product-content mt-3">

<h5>
<?php echo $row['product_name']; ?>
</h5>

<p class="product-price">
₹<?php echo number_format($row['product_price']); ?>
</p>

<div class="d-flex gap-2">

<a href="move-to-cart.php?id=<?php echo $row['id']; ?>"
   class="btn btn-cart w-100">

Add To Cart

</a>

<a href="remove-wishlist.php?id=<?php echo $row['id']; ?>"
   class="btn btn-danger"
   onclick="return confirm('Remove From Wishlist?')">

<i class="fa fa-trash"></i>

</a>

</div>

</div>

</div>

</div>

<?php
    }
}
else
{
?>

<div class="col-12">

<div class="alert alert-info text-center">

Wishlist Is Empty

<br><br>

<a href="collections.php"
   class="btn text-white"
   style="background:#5A0F2E;">

Browse Jewellery

</a>

</div>

</div>

<?php
}
?>

</div>

</div>

</div>

<?php
include("includes/footer.php");
?>