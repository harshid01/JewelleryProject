<?php
include("includes/master-top.php");
include("includes/sidebar.php");
include ("includes/header.php");
?>
<div class="content-wrapper">
    <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold" style="color:#5A0F2E;">
            Jewellery Collection
        </h2>

    </div>

    <!-- Search & Filter -->
    <div class="dashboard-card mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-8 mb-3">

                    <input type="text"
                        class="form-control"
                        placeholder="Search Jewellery...">

                </div>

                <div class="col-md-4 mb-3">

                    <select class="form-select">

                        <option>All Categories</option>
                        <option>Gold Ring</option>
                        <option>Necklace</option>
                        <option>Bracelet</option>
                        <option>Earrings</option>

                    </select>

                </div>

            </div>

        </div>

    </div>

    <!-- Product Grid -->
    <div class="row">

        <!-- Product 1 -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <div class="product-card">

                <div class="product-image">

                    <img src="../../images/product1.jpg"
                        alt="Product">

                </div>

                <div class="product-content">

                    <h5>Gold Ring</h5>

                    <p class="product-price">
                        ₹12,500
                    </p>

                    <div class="d-flex gap-2">

                        <button class="btn btn-cart w-100">
                            <i class="fa fa-shopping-cart"></i>
                        </button>

                        <button class="btn btn-wishlist">
                            <i class="fa fa-heart"></i>
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- Product 2 -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <div class="product-card">

                <div class="product-image">

                    <img src="../../images/product2.jpg"
                        alt="Product">

                </div>

                <div class="product-content">

                    <h5>Diamond Necklace</h5>

                    <p class="product-price">
                        ₹45,000
                    </p>

                    <div class="d-flex gap-2">

                        <button class="btn btn-cart w-100">
                            <i class="fa fa-shopping-cart"></i>
                        </button>

                        <button class="btn btn-wishlist">
                            <i class="fa fa-heart"></i>
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- Product 3 -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <div class="product-card">

                <div class="product-image">

                    <img src="../../images/product3.jpg"
                        alt="Product">

                </div>

                <div class="product-content">

                    <h5>Gold Bracelet</h5>

                    <p class="product-price">
                        ₹22,000
                    </p>

                    <div class="d-flex gap-2">

                        <button class="btn btn-cart w-100">
                            <i class="fa fa-shopping-cart"></i>
                        </button>

                        <button class="btn btn-wishlist">
                            <i class="fa fa-heart"></i>
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- Product 4 -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <div class="product-card">

                <div class="product-image">

                    <img src="../../images/product4.jpg"
                        alt="Product">

                </div>

                <div class="product-content">

                    <h5>Diamond Earrings</h5>

                    <p class="product-price">
                        ₹18,000
                    </p>

                    <div class="d-flex gap-2">

                        <button class="btn btn-cart w-100">
                            <i class="fa fa-shopping-cart"></i>
                        </button>

                        <button class="btn btn-wishlist">
                            <i class="fa fa-heart"></i>
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
</div>
<?php
include("includes/footer.php");
?>