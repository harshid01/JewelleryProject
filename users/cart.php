<?php
include("includes/master-top.php");
include("includes/sidebar.php");
include("includes/header.php");

/* Cart Items */

$cartQuery = mysqli_query($conn,"
SELECT c.*,
       p.product_name,
       p.product_price,
       p.product_image
FROM cart c
INNER JOIN products p
ON c.product_id = p.id
WHERE c.user_id='$user_id'
ORDER BY c.id DESC
");

$grandTotal = 0;
?>

<div class="content-wrapper">

<div class="table-container">

<h4>My Cart</h4>
<?php
if(isset($_GET['updated']))
{
?>
<!-- <div class="alert alert-success">
    Cart Updated Successfully
</div> -->
<?php
}
?>
<div class="table-responsive">

<table class="table align-middle">

<thead>
<tr>
<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php

if(mysqli_num_rows($cartQuery) > 0)
{
    while($row = mysqli_fetch_assoc($cartQuery))
    {
        $total =
        $row['product_price'] *
        $row['quantity'];

        $grandTotal += $total;
?>

<tr>

<td>

<img src="../admin/uploads/products/<?php echo $row['product_image']; ?>"
     width="70"
     height="70"
     class="rounded"
     style="object-fit:cover;">

</td>

<td>
<?php echo $row['product_name']; ?>
</td>

<td>
₹<?php echo number_format($row['product_price']); ?>
</td>

<td>

<form action="update-cart.php"
      method="POST">

<input type="hidden"
       name="cart_id"
       value="<?php echo $row['id']; ?>">

<input type="number"
       name="quantity"
       value="<?php echo $row['quantity']; ?>"
       min="1"
       class="form-control"
       style="width:90px;"
       onchange="this.form.submit()">

</form>

</td>

<td>
₹<?php echo number_format($total); ?>
</td>
<td>
    <a href="remove-cart.php?id=<?php echo $row['id']; ?>"
       class="btn btn-danger"
       onclick="return confirm('Are you sure you want to remove this item?')">
        <i class="fa fa-trash"></i>
    </a>
</td>
<?php
if(isset($_GET['deleted']))
{
?>
<div class="alert alert-success">
    Item Removed Successfully
</div>
<?php
}
?>
</tr>

<?php
    }
}
else
{
?>

<tr>

<td colspan="6" class="text-center">

<h5>Your Cart Is Empty</h5>

<a href="collections.php"
   class="btn mt-2 text-white"
   style="background:#5A0F2E;">

Continue Shopping

</a>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

<?php
if($grandTotal > 0)
{
?>

<div class="text-end mt-4">

<h4>
Total :
₹<?php echo number_format($grandTotal); ?>
</h4>

<a href="checkout.php"
   class="btn btn-lg text-white"
   style="background:#5A0F2E;">
    Checkout
</a>

</div>

<?php
}
?>

</div>

</div>

<?php
include("includes/footer.php");
?>