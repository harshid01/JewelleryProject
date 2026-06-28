<!-- Main catagorires -->
<?php
include 'includes/master-top.php';
include 'includes/sidebar.php';
include 'includes/header.php';
include '../config/db.php';
?>

<div class="content-box">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Categories Management</h3>

        <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addCategoryModal">

            <i class="fas fa-plus"></i>
            Add Category

        </button>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php

            $query = mysqli_query(
                $conn,
                "SELECT * FROM categories ORDER BY id DESC"
            );

            $sr = 1;

            while($row = mysqli_fetch_assoc($query))
            {
            ?>

                <tr>

                    <td><?= $sr++; ?></td>

                    <td><?= $row['category_name']; ?></td>

                    <td>

                        <?php if(!empty($row['category_image'])) { ?>

                            <img
                                src="uploads/categories/<?= $row['category_image']; ?>"
                                width="60"
                                height="60"
                                class="rounded"
                                style="object-fit:cover;"
                            >

                        <?php } ?>

                    </td>

                    <td>

                        <?php if($row['status']=='Active') { ?>

                            <span class="badge bg-success">
                                Active
                            </span>

                        <?php } else { ?>

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                        <?php } ?>

                    </td>

                    <td>

                        <button
                            class="btn btn-warning btn-sm editBtn"

                            data-id="<?= $row['id']; ?>"
                            data-name="<?= $row['category_name']; ?>"
                            data-status="<?= $row['status']; ?>"

                            data-bs-toggle="modal"
                            data-bs-target="#editCategoryModal">

                            <i class="fas fa-edit"></i>

                        </button>

                        <a
                            href="delete-category.php?id=<?= $row['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete Category?')">

                            <i class="fas fa-trash"></i>

                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<!-- ADD CATEGORY MODAL -->

<div class="modal fade"
     id="addCategoryModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Add Category
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form
                id="addCategoryForm"
                enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="mb-3">

                        <label>
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="category_name"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>
                            Category Image
                        </label>

                        <input
                            type="file"
                            name="category_image"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="active">
                                Active
                            </option>

                            <option value="inactive">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Save Category

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- EDIT CATEGORY MODAL -->

<div class="modal fade"
     id="editCategoryModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Edit Category
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form
                id="editCategoryForm"
                enctype="multipart/form-data">

                <input
                    type="hidden"
                    name="id"
                    id="edit_id">

                <div class="modal-body">

                    <div class="mb-3">

                        <label>
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="category_name"
                            id="edit_name"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>
                            Change Image
                        </label>

                        <input
                            type="file"
                            name="category_image"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
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

                </div>

                <div class="modal-footer">

                    <button
                        type="submit"
                        class="btn btn-success">

                        Update Category

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$('.editBtn').click(function(){

    $('#edit_id').val($(this).data('id'));

    $('#edit_name').val($(this).data('name'));

    $('#edit_status').val($(this).data('status'));

});


$('#addCategoryForm').submit(function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({

        url:'insert-category.php',

        type:'POST',

        data:formData,

        contentType:false,

        processData:false,

        success:function(){

            location.reload();

        }

    });

});


$('#editCategoryForm').submit(function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({

        url:'update-category.php',

        type:'POST',

        data:formData,

        contentType:false,

        processData:false,

        success:function(){

            location.reload();

        }

    });

});

</script>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/master-bottom.php'; ?>
