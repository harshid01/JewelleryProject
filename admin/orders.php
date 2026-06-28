<?php include 'includes/master-top.php'; ?>

<?php include 'includes/sidebar.php'; ?>

<?php include 'includes/header.php'; ?>

<div class="content-box">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            <i class="fas fa-shopping-cart"></i>
            Orders Management
        </h3>

<a href="export-orders.php"
   class="btn text-white"
   style="
   background:linear-gradient(135deg,#5A0F2E,#8B1E4D);
   border:none;
   border-radius:10px;
   ">

   <i class="fas fa-download"></i>
   Export Orders CSV

</a>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

<tbody>

<?php

include '../config/db.php';

$query = mysqli_query($conn, "
SELECT
    orders.id,
    users.full_name,
    products.product_name,
    orders.total_amount,
    orders.payment_method,
    orders.order_status,
    orders.order_date

FROM orders

LEFT JOIN users
ON users.id = orders.user_id

LEFT JOIN order_items
ON order_items.order_id = orders.id

LEFT JOIN products
ON products.id = order_items.product_id

ORDER BY orders.id DESC
");

$sr = 1;

while($row = mysqli_fetch_assoc($query))
{
?>

<tr>

<td><?= $sr++; ?></td>

<td><?= $row['full_name']; ?></td>

<td><?= $row['product_name']; ?></td>

<td><?= date('d-m-Y', strtotime($row['order_date'])); ?></td>

<td>₹<?= number_format($row['total_amount'],2); ?></td>

<td><?= $row['payment_method']; ?></td>

<td><?= $row['order_status']; ?></td>

<td>

<button
class="btn btn-info btn-sm viewOrder"
data-id="<?= $row['id']; ?>">
    <i class="fas fa-eye"></i>
</button>

<button
class="btn btn-warning btn-sm editOrder"
data-id="<?= $row['id']; ?>">
    <i class="fas fa-edit"></i>
</button>

<button
class="btn btn-danger btn-sm deleteOrder"
data-id="<?= $row['id']; ?>">
    <i class="fas fa-trash"></i>
</button>

</td>

</tr>

<?php
}
?>

</tbody>

        </table>

    </div>

</div>

<div class="modal fade" id="viewOrderModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Order Details</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body"
                 id="viewOrderContent">

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="editOrderModal">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5>Update Order</h5>

<button type="button"
        class="btn-close"
        data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body"
     id="editOrderContent">

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/master-bottom.php'; ?>
<script>

$(document).on('click','.viewOrder',function(){

    var id = $(this).data('id');

    $.post(
        'ajax-view-order.php',
        {
            id:id
        },
        function(data){

            $('#viewOrderContent').html(data);

            new bootstrap.Modal(
                document.getElementById(
                    'viewOrderModal'
                )
            ).show();

        }
    );

});

$(document).on('click','.editOrder',function(){

    var id = $(this).data('id');

    $.post(
        'ajax-edit-order.php',
        {
            id:id
        },
        function(data){

            $('#editOrderContent').html(data);

            new bootstrap.Modal(
                document.getElementById(
                    'editOrderModal'
                )
            ).show();

        }
    );

});

$(document).on('click','.deleteOrder',function(){

    var id = $(this).data('id');

    Swal.fire({

        title:'Delete Order?',
        text:'This action cannot be undone.',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#dc3545'

    }).then((result)=>{

        if(result.isConfirmed){

            $.ajax({

                url:'ajax-delete-order.php',
                type:'POST',
                data:{id:id},

                success:function(response){

                    Swal.fire(
                        'Deleted!',
                        'Order deleted successfully.',
                        'success'
                    ).then(()=>{

                        location.reload();

                    });

                }

            });

        }

    });

});

</script>


