<?php include 'includes/master-top.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
include '../config/db.php';
?>

<div class="content-box">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            <i class="fas fa-gem"></i>
            Products Management
        </h3>

        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addProductModal">

            <i class="fas fa-plus"></i>
            Add Product

        </button>

    </div>

    <!-- Filters -->

    <div class="row mb-4">

        <div class="col-md-4 mb-2">

            <input
                type="text"
                id="searchProduct"
                class="form-control"
                placeholder="Search Product">

        </div>

        <div class="col-md-4 mb-2">

            <select
                id="categoryFilter"
                class="form-select">

                <option value="">
                    All Categories
                </option>

                <?php

                $catQuery =
                mysqli_query(
                    $conn,
                    "SELECT * FROM categories"
                );
                    
                while($cat =
                    mysqli_fetch_assoc($catQuery))
                {
                ?>

                <option>
                    <?= $cat['category_name']; ?>
                </option>

                <?php } ?>

            </select>

        </div>

        <div class="col-md-4 mb-2">

            <select
                id="statusFilter"
                class="form-select">

                <option value="">
                    All Status
                </option>

                <option>
                    active
                </option>

                <option>
                    inactive
                </option>

            </select>

        </div>

    </div>

    <!-- Product Table -->

    <div class="table-responsive">

        <table
            class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>Sr. No.</th>

                    <th>Image</th>

                    <th>Product Name</th>

                    <th>Category</th>

                    <th>Weight</th>

                    <th>Price</th>

                    <th>Stock</th>

                    <th>Status</th>

                    <th width="180">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody id="productTable">

                <?php

                $query =
                mysqli_query(
                    $conn,
                    "SELECT
                    products.*,
                    categories.category_name

                    FROM products

                    LEFT JOIN categories

                    ON categories.id =
                    products.category_id

                    ORDER BY products.id DESC"
                );
                    $sr = 1;
                while(
                    $row =
                    mysqli_fetch_assoc($query)
                )
                {
                ?>

                <tr>

                    <td>
                         <?= $sr++; ?>
                    </td>

                    <td>

                        <img
                        src="uploads/products/<?= $row['product_image']; ?>"
                        width="70"
                        height="70"
                        class="rounded shadow-sm"
                        style="object-fit:cover;">

                    </td>

                    <td>
                        <?= $row['product_name']; ?>
                    </td>

                    <td>
                        <?= $row['category_name']; ?>
                    </td>

                    <td>
                        <?= $row['product_weight']; ?> gm
                    </td>

                    <td>
                        ₹<?= $row['product_price']; ?>
                    </td>

                    <td>

                        <?php
                        if(
                        $row['stock_quantity'] > 0
                        )
                        {
                        ?>

                        <span class="badge bg-success">

                            <?= $row['stock_quantity']; ?>
                            Available

                        </span>

                        <?php
                        }
                        else
                        {
                        ?>

                        <span class="badge bg-danger">

                            Out Of Stock

                        </span>

                        <?php } ?>

                    </td>

                    <td>

                        <?php
                        if(
                        $row['status']
                        ==
                        'active'
                        )
                        {
                        ?>

                        <span class="badge bg-primary">
                            Active
                        </span>

                        <?php
                        }
                        else
                        {
                        ?>

                        <span class="badge bg-secondary">
                            Inactive
                        </span>

                        <?php } ?>

                    </td>

                    <td>

<button
class="btn btn-warning btn-sm editBtn"

data-id="<?= $row['id']; ?>"
data-name="<?= $row['product_name']; ?>"
data-category="<?= $row['category_id']; ?>"
data-description="<?= $row['product_description']; ?>"
data-weight="<?= $row['product_weight']; ?>"
data-price="<?= $row['product_price']; ?>"
data-stock="<?= $row['stock_quantity']; ?>"
data-status="<?= $row['status']; ?>"

data-bs-toggle="modal"
data-bs-target="#editProductModal">

<i class="fas fa-edit"></i>

</button>

<a href="delete-product.php?id=<?= $row['id']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Delete Product?')">

<i class="fas fa-trash"></i>

</a>

                    </td>

                </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <form id="addProductForm"
                  enctype="multipart/form-data">

                <div class="modal-body">

                    <input type="text"
                           name="product_name"
                           class="form-control mb-3"
                           placeholder="Product Name"
                           required>

                    <textarea
                           name="product_description"
                           class="form-control mb-3"
                           placeholder="Description"></textarea>

                    <input type="number"
                           step="0.01"
                           name="product_weight"
                           class="form-control mb-3"
                           placeholder="Weight">

                    <input type="number"
                           step="0.01"
                           name="product_price"
                           class="form-control mb-3"
                           placeholder="Price">

                    <input type="number"
                           name="stock_quantity"
                           class="form-control mb-3"
                           placeholder="Stock">

                    <select name="category_id"
                            class="form-select mb-3">

                        <?php
                        $cat =
                        mysqli_query(
                            $conn,
                            "SELECT * FROM categories"
                        );

                        while(
                        $c =
                        mysqli_fetch_assoc($cat))
                        {
                        ?>

                        <option value="<?= $c['id']; ?>">
                            <?= $c['category_name']; ?>
                        </option>

                        <?php } ?>

                    </select>

                    <input type="file"
                           name="product_image"
                           class="form-control mb-3">

                    <select name="status"
                            class="form-select">

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-primary">

                        Save Product

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="editProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Edit Product
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <form id="editProductForm"
                  enctype="multipart/form-data">

                <input type="hidden"
                       name="id"
                       id="edit_id">

                <div class="modal-body">

                    <input type="text"
                           name="product_name"
                           id="edit_name"
                           class="form-control mb-3">

                    <textarea
                           name="product_description"
                           id="edit_description"
                           class="form-control mb-3"></textarea>

                    <input type="number"
                           step="0.01"
                           name="product_weight"
                           id="edit_weight"
                           class="form-control mb-3">

                    <input type="number"
                           step="0.01"
                           name="product_price"
                           id="edit_price"
                           class="form-control mb-3">

                    <input type="number"
                           name="stock_quantity"
                           id="edit_stock"
                           class="form-control mb-3">

                    <select name="category_id"
                            id="edit_category"
                            class="form-select mb-3">

                        <?php
                        $cat =
                        mysqli_query(
                            $conn,
                            "SELECT * FROM categories"
                        );

                        while(
                        $c =
                        mysqli_fetch_assoc($cat))
                        {
                        ?>

                        <option value="<?= $c['id']; ?>">
                            <?= $c['category_name']; ?>
                        </option>

                        <?php } ?>

                    </select>

                    <input type="file"
                           name="product_image"
                           class="form-control mb-3">

                    <select name="status"
                            id="edit_status"
                            class="form-select">

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-success">

                        Update Product

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script>

document
.getElementById('searchProduct')
.addEventListener(
'keyup',
filterProducts
);

document
.getElementById('categoryFilter')
.addEventListener(
'change',
filterProducts
);

document
.getElementById('statusFilter')
.addEventListener(
'change',
filterProducts
);

function filterProducts()
{
    let search =
    document
    .getElementById(
    'searchProduct'
    )
    .value
    .toLowerCase();

    let category =
    document
    .getElementById(
    'categoryFilter'
    )
    .value
    .toLowerCase();

    let status =
    document
    .getElementById(
    'statusFilter'
    )
    .value
    .toLowerCase();

    let rows =
    document
    .querySelectorAll(
    '#productTable tr'
    );

    rows.forEach(row => {

        let product =
        row.cells[2]
        .innerText
        .toLowerCase();

        let cat =
        row.cells[3]
        .innerText
        .toLowerCase();

        let stat =
        row.cells[7]
        .innerText
        .toLowerCase();

        let show = true;

        if(
        search &&
        !product.includes(search)
        )
        {
            show = false;
        }

        if(
        category &&
        cat !== category
        )
        {
            show = false;
        }

        if(
        status &&
        !stat.includes(status)
        )
        {
            show = false;
        }

        row.style.display =
        show
        ? ''
        : 'none';

    });
}

</script>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/master-bottom.php'; ?>
<script>

$('.editBtn').click(function(){

    $('#edit_id').val($(this).data('id'));
    $('#edit_name').val($(this).data('name'));
    $('#edit_description').val($(this).data('description'));
    $('#edit_category').val($(this).data('category'));
    $('#edit_weight').val($(this).data('weight'));
    $('#edit_price').val($(this).data('price'));
    $('#edit_stock').val($(this).data('stock'));
    $('#edit_status').val($(this).data('status'));

});

</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

/* ===========================
   EDIT BUTTON DATA LOAD
=========================== */

$('.editBtn').click(function(){

    $('#edit_id').val($(this).data('id'));

    $('#edit_name').val($(this).data('name'));

    $('#edit_description').val(
        $(this).data('description')
    );

    $('#edit_weight').val(
        $(this).data('weight')
    );

    $('#edit_price').val(
        $(this).data('price')
    );

    $('#edit_stock').val(
        $(this).data('stock')
    );

    $('#edit_category').val(
        $(this).data('category')
    );

    $('#edit_status').val(
        $(this).data('status')
    );

});


/* ===========================
   ADD PRODUCT
=========================== */

$('#addProductForm').submit(function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({

        url:'insert-product.php',

        type:'POST',

        data:formData,

        contentType:false,

        processData:false,

        success:function(response){

            // alert(response);

            $('#addProductModal').modal('hide');

            // alert("Form Submitted");

            location.reload();


        }

    });

});


/* ===========================
   UPDATE PRODUCT
=========================== */

$('#editProductForm').submit(function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({

        url:'update-product.php',

        type:'POST',

        data:formData,

        contentType:false,

        processData:false,

        success:function(response){

            $('#editProductModal').modal('hide');

            location.reload();

        }

    });

});

</script>