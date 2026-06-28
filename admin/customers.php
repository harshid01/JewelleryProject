<?php include 'includes/master-top.php'; ?>

<?php include 'includes/sidebar.php'; ?>

<?php include 'includes/header.php'; ?>

<div class="content-box">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            <i class="fas fa-users"></i>
            Customers Management
        </h3>

        <button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#addCustomerModal">
    <i class="fas fa-user-plus"></i>
    Add Customer
</button>
            
        </button>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Total Orders</th>
                    <th>Created Date</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody>

<?php
include '../config/db.php';

$query = mysqli_query($conn,"
SELECT * FROM users
WHERE role='customer'
ORDER BY id DESC
");

$sr = 1;

while($row = mysqli_fetch_assoc($query))
{
?>
<tr>

<td><?= $sr++; ?></td>

<td>
<?php if(!empty($row['image'])){ ?>
    <img src="../Indexactivity/Uploads/users/<?= $row['image']; ?>"
         width="60"
         height="60"
         class="rounded-circle">
<?php } else { ?>
    <img src="https://via.placeholder.com/60"
         width="60"
         height="60"
         class="rounded-circle">
<?php } ?>
</td>

<td><?= $row['full_name']; ?></td>
<td><?= $row['email']; ?></td>
<td><?= $row['phone']; ?></td>

<!-- ========== ORDER SECTION ===============-->
<td>

<?php

$orderCountQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) as total_orders
     FROM orders
     WHERE user_id='".$row['id']."'"
);

$orderCountData = mysqli_fetch_assoc($orderCountQuery);

$totalOrders = $orderCountData['total_orders'];

if($totalOrders > 0)
{
?>
    <span class="badge bg-success">
        <?= $totalOrders; ?> Order<?= $totalOrders > 1 ? 's' : ''; ?>
    </span>
<?php
}
else
{
?>
    <span class="badge bg-danger">
        No Orders
    </span>
<?php
}
?>

</td>
<!-- ========================================= -->

<td>
    <?= date('d-m-Y', strtotime($row['created_at'])); ?>
</td>


<td>
<?php

$orderQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) as total_orders
     FROM orders
     WHERE user_id='".$row['id']."'"
);

$orderData = mysqli_fetch_assoc($orderQuery);

$totalOrders = $orderData['total_orders'];

?>
<button
class="btn btn-info btn-sm viewBtn"

data-name="<?= $row['full_name']; ?>"
data-email="<?= $row['email']; ?>"
data-phone="<?= $row['phone']; ?>"
data-image="<?= $row['image']; ?>"
data-address="<?= $row['address']; ?>"
data-orders="<?= $totalOrders; ?>"
data-date="<?= date('d-m-Y',strtotime($row['created_at'])); ?>"

data-bs-toggle="modal"
data-bs-target="#viewCustomerModal">

<i class="fas fa-eye"></i>

</button>

<button
class="btn btn-warning btn-sm editBtn"

data-id="<?= $row['id']; ?>"
data-name="<?= $row['full_name']; ?>"
data-email="<?= $row['email']; ?>"
data-phone="<?= $row['phone']; ?>"
data-address="<?= $row['address']; ?>"

data-bs-toggle="modal"
data-bs-target="#editCustomerModal">

<i class="fas fa-edit"></i>

</button>

<a
href="delete-customer.php?id=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Customer?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>
<?php
}
?>
            </tbody>

        </table>

    </div>

</div>

<div class="modal fade" id="addCustomerModal">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Add Customer</h5>

<button type="button"
        class="btn-close"
        data-bs-dismiss="modal">
</button>

</div>

<form id="addCustomerForm"
      method="post"
      enctype="multipart/form-data">

<div class="modal-body">

<div class="mb-3">
<label>Full Name</label>
<input type="text"
       name="full_name"
       class="form-control"
       required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
       name="email"
       class="form-control"
       required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text"
       name="phone"
       class="form-control"
       required>
</div>

<div class="mb-3">
<label>Address</label>
<input type="text"
       name="address"
       class="form-control"
       required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password"
       name="password"
       class="form-control"
       required>
</div>

<div class="mb-3">
<label>Image</label>
<input type="file"
       name="image"
       class="form-control">
</div>

</div>

<div class="modal-footer">

<button type="submit"
        class="btn btn-primary">

Save Customer

</button>

</div>

</form>

</div>

</div>

</div>
<div class="modal fade" id="editCustomerModal">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
Edit Customer
</h5>

<button type="button"
        class="btn-close"
        data-bs-dismiss="modal">
</button>

</div>

<form id="editCustomerForm"
      enctype="multipart/form-data">

<input type="hidden"
       name="id"
       id="edit_id">

<div class="modal-body">

<div class="mb-3">
<label>Full Name</label>
<input type="text"
       name="full_name"
       id="edit_name"
       class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
       name="email"
       id="edit_email"
       class="form-control">
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text"
       name="phone"
       id="edit_phone"
       class="form-control">
</div>

<div class="mb-3">
<label>Address</label>
<input type="text"
       name="address"
       id="edit_address"
       class="form-control">
</div>

<div class="mb-3">
<label>Change Image</label>
<input type="file"
       name="image"
       class="form-control">
</div>

</div>

<div class="modal-footer">

<button type="submit" class="btn btn-success">Update Customer</button>

</div>

</form>

</div>

</div>

</div>
<div class="modal fade"
     id="viewCustomerModal">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Customer Details
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img
                    id="view_image"
                    src=""
                    width="100"
                    height="100"
                    class="rounded-circle mb-3">

                <table class="table">

                    <tr>
                        <th>Name</th>
                        <td id="view_name"></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td id="view_email"></td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td id="view_phone"></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td id="view_address"></td>
                    </tr>
                    <tr>
                        <th>Total Orders</th>
                        <td id="view_orders"></td>
                    </tr>

                    <tr>
                        <th>Created Date</th>
                        <td id="view_date"></td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function(){

    // Edit Button
    $('.editBtn').click(function(){

        $('#edit_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_email').val($(this).data('email'));
        $('#edit_phone').val($(this).data('phone'));
        $('#edit_address').val($(this).data('address'));

    });

    // View Button
$('.viewBtn').click(function(){

    $('#view_name').text($(this).data('name'));
    $('#view_email').text($(this).data('email'));
    $('#view_phone').text($(this).data('phone'));
    $('#view_address').text($(this).data('address'));
    $('#view_date').text($(this).data('date'));

    let orders = $(this).data('orders');

    if(orders > 0)
    {
        $('#view_orders').html(
            '<span class="badge bg-success">'+
            orders+' Order'+(orders > 1 ? 's' : '')+
            '</span>'
        );
    }
    else
    {
        $('#view_orders').html(
            '<span class="badge bg-danger">No Orders</span>'
        );
    }

    let image = $(this).data('image');

    if(image != '')
    {
        $('#view_image').attr(
            'src',
            '../Indexactivity/Uploads/users/' + image
        );
    }
    else
    {
        $('#view_image').attr(
            'src',
            'https://via.placeholder.com/100'
        );
    }

});

    // Add Customer
    $('#addCustomerForm').on('submit', function(e){

        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({

            url:'insert-customer.php',
            type:'POST',
            data:formData,
            contentType:false,
            processData:false,

success:function(){

    location.reload();

},

            error:function(xhr){

                alert('Insert Error');

                console.log(xhr.responseText);

            }

        });

    });

    // Update Customer
    $('#editCustomerForm').on('submit', function(e){

        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({

            url:'update-customer.php',
            type:'POST',
            data:formData,
            contentType:false,
            processData:false,

            success:function(response){

                console.log(response);

                if(response.trim() == 'success')
                {
                    alert('Customer Updated Successfully');
                    location.reload();
                }
                else
                {
                    alert(response);
                }

            },

            error:function(xhr){

                alert('Update Error');

                console.log(xhr.responseText);

            }

        });

    });

});

</script>
<?php include 'includes/footer.php'; ?>

<?php include 'includes/master-bottom.php'; ?>