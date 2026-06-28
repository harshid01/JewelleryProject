<?php
include("includes/master-top.php");
include("includes/sidebar.php");
include ("includes/header.php");
include("../config/db.php");
?>
<?php

/* Dashboard Statistics */

$orderQuery = mysqli_query($conn,
"SELECT COUNT(*) AS total FROM orders WHERE user_id='$user_id'");
$orderData = mysqli_fetch_assoc($orderQuery);
$totalOrders = $orderData['total'];

$wishlistQuery = mysqli_query($conn,
"SELECT COUNT(*) AS total FROM wishlist WHERE user_id='$user_id'");
$wishlistData = mysqli_fetch_assoc($wishlistQuery);
$totalWishlist = $wishlistData['total'];

$cartQuery = mysqli_query($conn,
"SELECT COUNT(*) AS total FROM cart WHERE user_id='$user_id'");
$cartData = mysqli_fetch_assoc($cartQuery);
$totalCart = $cartData['total'];

$spentQuery = mysqli_query($conn,"SELECT SUM(total_amount) AS total_spent
FROM orders
WHERE user_id='$user_id'
AND order_status='Delivered'
");

$spentData = mysqli_fetch_assoc($spentQuery);
$totalSpent = $spentData['total_spent'] ?? 0;


/* Recent Orders */

$recentOrders = mysqli_query($conn,
"SELECT *
FROM orders
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 5");

?>
<!-- <div class=".page-content"> -->
    <div class="content-wrapper">

    <div class="row g-4">

        <!-- Total Orders -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="card-icon">
                        <i class="fa fa-box"></i>
                    </div>
                    <h5 class="card-title">My Orders</h5>
                    <h2 class="card-number"> <?php echo $totalOrders; ?> </h2>
                </div>
            </div>
        </div>

        <!-- Wishlist -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="card-icon">
                        <i class="fa fa-heart"></i>
                    </div>
                    <h5 class="card-title">Wishlist</h5>
                    <h2 class="card-number">
    <?php echo $totalWishlist; ?>
</h2>
                </div>
            </div>
        </div>

        <!-- Cart -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="card-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <h5 class="card-title">Cart Items</h5>
                    <h2 class="card-number">
    <?php echo $totalCart; ?>
</h2>
                </div>
            </div>
        </div>

        <!-- Amount -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="card-icon">
                        <i class="fa fa-rupee-sign"></i>
                    </div>
                    <h5 class="card-title">Total Spent</h5>
                    <h2 class="card-number">
    ₹<?php echo number_format($totalSpent); ?>
</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Orders -->
    <div class="table-container mt-4">

        <h4>Recent Orders</h4>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                    </tr>
                </thead>

<tbody>

<?php

if(mysqli_num_rows($recentOrders) > 0)
{
    while($row = mysqli_fetch_assoc($recentOrders))
    {
?>

<tr>

    <td>
        <?php echo $row['order_number']; ?>
    </td>

    <td>
        <?php echo date('d-m-Y',strtotime($row['order_date'])); ?>
    </td>

    <td>
        ₹<?php echo number_format($row['total_amount']); ?>
    </td>

    <td>
        <?php echo $row['payment_method']; ?>
    </td>

    <td>

<?php

$status = $row['order_status'];

if($status == "Delivered")
{
    echo '<span class="badge bg-success">Delivered</span>';
}
elseif($status == "Processing")
{
    echo '<span class="badge bg-warning text-dark">Processing</span>';
}
elseif($status == "Cancelled")
{
    echo '<span class="badge bg-danger">Cancelled</span>';
}
else
{
    echo '<span class="badge bg-secondary">'.$status.'</span>';
}

?>

    </td>

</tr>

<?php
    }
}
else
{
?>

<tr>
    <td colspan="5" class="text-center">
        No Orders Found
    </td>
</tr>

<?php
}
?>

</tbody>

            </table>

        </div>

    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">

        <div class="col-md-4 mb-3">
            <a href="collections.php" class="btn btn-lg w-100 text-white"
               style="background:#5A0F2E;">
                <i class="fa fa-gem me-2"></i>
                Browse Jewellery
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="wishlist.php" class="btn btn-lg w-100 text-white"
               style="background:#B88646;">
                <i class="fa fa-heart me-2"></i>
                My Wishlist
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="orders.php" class="btn btn-lg w-100 text-white"
               style="background:#5A0F2E;">
                <i class="fa fa-box me-2"></i>
                View Orders
            </a>
        </div>

    </div>
</div>
<?php
include("includes/footer.php");
?>