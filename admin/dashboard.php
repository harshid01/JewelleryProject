<?php include 'includes/master-top.php'; ?>

<?php include 'includes/sidebar.php'; ?>

<?php include 'includes/header.php'; ?>

<?php
include '../config/db.php';

// Total Products
$productQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM products");
$productData = mysqli_fetch_assoc($productQuery);
$totalProducts = $productData['total'];

// Total Orders
$orderQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM orders");
$orderData = mysqli_fetch_assoc($orderQuery);
$totalOrders = $orderData['total'];

// Total Customers
$customerQuery = mysqli_query($conn,"SELECT COUNT(*) AS total FROM users WHERE role='customer'");
$customerData = mysqli_fetch_assoc($customerQuery);
$totalCustomers = $customerData['total'];

// Total Revenue
$revenueQuery = mysqli_query($conn,"
SELECT IFNULL(SUM(total_amount),0) AS revenue
FROM orders
WHERE order_status='Delivered'
");
$revenueData = mysqli_fetch_assoc($revenueQuery);
$totalRevenue = $revenueData['revenue'];
?>

<div class="row g-4">

    <div class="col-lg-3 col-md-6"> 
        <div class="card dashboard-card">
            <div class="card-body text-center">
                <i class="fas fa-gem card-icon"></i>
                <h6 class="card-title">Products</h6> 
                    <h2 class="card-number"><?= $totalProducts; ?></h2>
            </div> 
        </div> 
    </div> 
    <div class="col-lg-3 col-md-6"> 
        <div class="card dashboard-card"> 
            <div class="card-body text-center"> 
                <i class="fas fa-shopping-cart card-icon"></i> 
                <h6 class="card-title">Orders</h6> 
                <h2 class="card-number"><?= $totalOrders; ?></h2>
            </div> 
        </div> 
    </div> 
    <div class="col-lg-3 col-md-6"> 
        <div class="card dashboard-card"> 
            <div class="card-body text-center"> 
                <i class="fas fa-users card-icon"></i> 
                <h6 class="card-title">Customers</h6> 
                <h2 class="card-number"><?= $totalCustomers; ?></h2>
                <!-- <h2 class="card-number">120</h2>  -->
            </div> 
        </div> 
    </div> 
    <div class="col-lg-3 col-md-6"> 
        <div class="card dashboard-card"> 
            <div class="card-body text-center"> 
                <i class="fas fa-indian-rupee-sign card-icon"></i> 
                <h6 class="card-title">Total Revenue</h6> 
                <h2 class="card-number"> ₹<?= number_format($totalRevenue,2); ?> </h2>
                <!-- <h2 class="card-number">₹85K</h2>  -->
            </div> 
        </div> 
    </div> 
</div>

</div>

<div class="table-container mt-4">

    <div class="table-container mt-4"> 
        <h4 class="mb-3">Recent Orders</h4> 
        <table class="table table-hover"> 
            <thead> 
                <tr> 
                    <th>Order ID</th> 
                    <th>Customer</th> 
                    <th>Amount</th> 
                    <th>Status</th> 
                </tr> 
            </thead> 
<tbody>

<?php

$recentOrders = mysqli_query($conn,"
SELECT
orders.id,
orders.total_amount,
orders.order_status,
users.full_name

FROM orders

LEFT JOIN users
ON users.id=orders.user_id

ORDER BY orders.id DESC
LIMIT 5
");

while($row=mysqli_fetch_assoc($recentOrders))
{
?>

<tr>

<td>#<?= $row['id']; ?></td>

<td><?= $row['full_name']; ?></td>

<td>₹<?= number_format($row['total_amount'],2); ?></td>

<td>

<?php

$status = strtolower($row['order_status']);

if($status=='delivered')
{
    echo '<span class="badge bg-success">Delivered</span>';
}
elseif($status=='pending')
{
    echo '<span class="badge bg-warning">Pending</span>';
}
elseif($status=='cancelled')
{
    echo '<span class="badge bg-danger">Cancelled</span>';
}
else
{
    echo '<span class="badge bg-primary">'.$row['order_status'].'</span>';
}

?>

</td>

</tr>

<?php } ?>

</tbody>
        </table> 
    </div>

</div>
<div>
<?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/master-bottom.php'; ?>