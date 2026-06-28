<?php

// session_start();

include("../config/db.php");
include("index-master/master-top.php");

$user_id = $_SESSION['user_id'];

$userQuery = mysqli_query($conn,"
SELECT *
FROM users
WHERE id='$user_id'
");

$userData = mysqli_fetch_assoc($userQuery);

$profileImage = !empty($userData['image'])
    ? "../Indexactivity/Uploads/users/".$userData['image']
    : "../images/default-user.png";

$productQuery = mysqli_query($conn,"
SELECT p.*, c.category_name
FROM products p
LEFT JOIN categories c
ON p.category_id = c.id
WHERE p.status='active'
ORDER BY p.id DESC
");

$categoryQuery = mysqli_query($conn,"
SELECT *
FROM categories
WHERE status='Active'
");
?>
<div class="collection-header">

    <div class="back-section">

        <a href="index.php" class="back-btn">
            <i class="fa fa-arrow-left"></i>
            Back
        </a>

    </div>

    <div class="logo-section">

        <img src="../images/logo.png"
             alt="AJP'Sons">

    </div>

    <div class="profile-section">

        <div class="dropdown">

            <a href="#"
               data-bs-toggle="dropdown">

<img src="<?php echo $profileImage; ?>"
     class="profile-img"
     alt="Profile">

            </a>
<ul class="dropdown-menu dropdown-menu-end">

    <li>
        <a class="dropdown-item" href="dashboard.php">
            <i class="fa fa-home"></i>
            Dashboard
        </a>
    </li>

    <li>
        <a class="dropdown-item" href="profile.php">
            <i class="fa fa-user"></i>
            Profile
        </a>
    </li>

    <li>
        <a class="dropdown-item" href="users/orders.php">
            <i class="fa fa-box"></i>
            Orders
        </a>
    </li>

    <li><hr class="dropdown-divider"></li>

    <li>
        <a class="dropdown-item text-danger" href="logout.php">
            <i class="fa fa-sign-out-alt"></i>
            Logout
        </a>
    </li>

</ul>

        </div>

    </div>

</div>
<section class="collection-page py-5">

    <div class="container-fluid">

        <!-- Search Area -->
        <div class="collection-top mb-4">

            <div class="row g-3">

                <div class="col-lg-6">

                    <div class="search-box">

                        <i class="fa fa-search"></i>

                        <input type="text"
                               id="searchProduct"
                               class="form-control"
                               placeholder="Search Jewellery...">

                    </div>

                </div>

                <div class="col-lg-3">

                    <select class="form-select" id="categoryFilter">

<option value="">All Categories</option>

<?php
while($cat=mysqli_fetch_assoc($categoryQuery))
{
?>
<option value="<?php echo $cat['id']; ?>">
    <?php echo $cat['category_name']; ?>
</option>
<?php
}
?>

                    </select>

                </div>

                <div class="col-lg-3">

<select class="form-select" id="sortProducts">

<option value="">Sort By</option>
<option value="newest">Newest First</option>
<option value="popular">Most Popular</option>
<option value="low">Price: Low to High</option>
<option value="high">Price: High to Low</option>

                    </select>

                </div>

            </div>

        </div>

        <div class="row">

            <!-- Left Filter -->
            <div class="col-lg-3">

                <div class="filter-card">

                    <h5>Filters</h5>

                    <hr>

                    <h6>Jewellery Type</h6>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label>Gold Ring</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label>Diamond Ring</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label>Necklace</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label>Earrings</label>
                    </div>

                </div>

            </div>

            <!-- Product Grid -->
            <div class="col-lg-9">

                <div class="row g-4">

<?php
while($product=mysqli_fetch_assoc($productQuery))
{
?>

<div class="col-xl-3 col-lg-4 col-md-6 product-item"
     data-category="<?php echo $product['category_id']; ?>">

    <div class="product-card">

        <div class="product-img">

            <img src="../admin/uploads/products/<?php echo $product['product_image']; ?>"
                 class="img-fluid">

        </div>

        <div class="product-content">

            <h6>
                <?php echo $product['product_name']; ?>
            </h6>

            <div class="rating">
                ★★★★★
            </div>

            <h5>
                ₹ <?php echo number_format($product['product_price']); ?>
            </h5>

            <div class="product-btns">

                <a href="add-wishlist.php?id=<?php echo $product['id']; ?>"
                   class="wishlist-btn">

                    <i class="fa fa-heart"></i>

                </a>

                <a href="add-cart.php?id=<?php echo $product['id']; ?>"
                   class="cart-btn">

                    <i class="fa fa-shopping-cart"></i>

                </a>
<button
class="view-btn viewProduct"
data-id="<?php echo $product['id']; ?>">
View
</button>

            </div>

        </div>

    </div>

</div>

<?php
}
?>

                </div>

            </div>

        </div>

    </div>
<div class="modal fade"
     id="productModal"
     tabindex="-1">

<div class="modal-dialog modal-lg modal-dialog-centered">

<div class="modal-content">

<div class="modal-body"
     id="productDetails">

Loading...

</div>

</div>

</div>

</div>
</section>
<?php include("index-master/footer.php"); ?>

<?php include("index-master/master-bottom.php"); ?>
<script>
$('#categoryFilter').change(function(){

    var category = $(this).val();

    if(category=="")
    {
        $('.product-item').show();
    }
    else
    {
        $('.product-item').hide();

        $('.product-item[data-category="'+category+'"]')
        .show();
    }

});

$('#searchProduct').on('keyup', function(){

var value = $(this).val().toLowerCase();

$('.product-item').filter(function(){

$(this).toggle(
$(this).text().toLowerCase().indexOf(value) > -1
);

});

});

$('#sortProducts').change(function(){

    let value = $(this).val();

    let products = $('.product-item').get();

    products.sort(function(a,b){

        let priceA = parseInt($(a).find('h5').text().replace(/[₹, ]/g,''));
        let priceB = parseInt($(b).find('h5').text().replace(/[₹, ]/g,''));

        if(value == 'low')
        {
            return priceA - priceB;
        }

        if(value == 'high')
        {
            return priceB - priceA;
        }

        return 0;

    });

    $.each(products,function(index,item){

        $('.row.g-4').append(item);

    });

});
</script>
<script>

$(document).ready(function(){

    console.log("jQuery Loaded");

    $('.viewProduct').click(function(){

        // alert("Button Clicked");

        var product_id = $(this).data('id');

        console.log(product_id);

        $.ajax({

            url:'ajax-product-details.php',

            method:'POST',

            data:{
                product_id:product_id
            },

            success:function(response){

                console.log(response);

                $('#productDetails').html(response);

                var modal = new bootstrap.Modal(
                    document.getElementById('productModal')
                );

                modal.show();

            },

            error:function(xhr){

                console.log(xhr.responseText);

            }

        });

    });

});

</script>
