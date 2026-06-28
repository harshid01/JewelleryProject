<?php
include("includes/master-top.php");
include("includes/sidebar.php");
include("includes/header.php");

/* User Orders */

$orderQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE user_id='$user_id'
     ORDER BY id DESC"
);
?>

<div class="content-wrapper">

<div class="table-container">

<h4>My Orders</h4>

<div class="table-responsive">

<table class="table align-middle">

<thead>

<tr>
    <th>Order No</th>
    <th>Date</th>
    <th>Amount</th>
    <th>Payment</th>
    <th>Status</th>
    <th>View</th>
    <th>Action's</th>
</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($orderQuery) > 0)
{
    while($row = mysqli_fetch_assoc($orderQuery))
    {
?>

<tr>

    <td>
        <?php echo $row['order_number']; ?>
    </td>

    <td>
        <?php echo date(
            "d-m-Y",
            strtotime($row['order_date'])
        ); ?>
    </td>

    <td>
        ₹<?php echo number_format(
            $row['total_amount']
        ); ?>
    </td>

    <td>

<?php

if($row['payment_status'] == "Paid")
{
    echo '<span class="badge bg-success">Paid</span>';
}
else
{
    echo '<span class="badge bg-warning text-dark">Pending</span>';
}

?>

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
    echo '<span class="badge bg-primary">Processing</span>';
}
elseif($status == "Cancelled")
{
    echo '<span class="badge bg-danger">Cancelled</span>';
}
elseif($status == "Shipped")
{
    echo '<span class="badge bg-info">Shipped</span>';
}
else
{
    echo '<span class="badge bg-secondary">'.$status.'</span>';
}

?>

    </td>
<td>

<button
class="btn btn-sm btn-warning viewOrderBtn"
data-id="<?php echo $row['id']; ?>">
Details
</button>
</td>
<td>
<?php
if(
    $row['order_status'] != 'Delivered'
    &&
    $row['order_status'] != 'Cancelled'
)
{
?>
<a href="cancel-order.php?id=<?php echo $row['id']; ?>"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Are you sure you want to cancel this order?')">
    Cancel Order
</a>

<button
class="btn btn-sm btn-info editAddressBtn"
data-id="<?php echo $row['id']; ?>"
data-address="<?php echo htmlspecialchars($row['shipping_address']); ?>">
Edit
</button>
<?php
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

    <td colspan="6" class="text-center">

        <div class="py-4">

            <h5>No Orders Found</h5>

            <a href="collections.php"
               class="btn mt-2 text-white"
               style="background:#5A0F2E;">

                Shop Now

            </a>

        </div>

    </td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>
<div class="modal fade"
     id="orderModal"
     tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Order Details
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body"
                 id="orderDetails">

                Loading...

            </div>

        </div>

    </div>

</div>

<div class="modal fade"
     id="addressModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Edit Shipping Address
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form action="update-order-address.php"
                  method="POST">

                <div class="modal-body">

                    <input type="hidden"
                           name="order_id"
                           id="order_id">

                    <textarea
                        name="shipping_address"
                        id="shipping_address"
                        class="form-control"
                        rows="4"
                        required></textarea>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-success">
                        Update Address
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

$(document).ready(function(){

    $(".viewOrderBtn").click(function(){

        var order_id = $(this).data("id");

        $("#orderDetails").html("Loading...");

        $("#orderModal").modal("show");

        $.ajax({

            url:"ajax-order-details.php",
            type:"POST",
            data:{
                order_id:order_id
            },

            success:function(response)
            {
                $("#orderDetails").html(response);
            }

        });

    });

});

$(document).on('click','.editAddressBtn',function(){

    var order_id = $(this).data('id');
    var address = $(this).data('address');

    $('#order_id').val(order_id);
    $('#shipping_address').val(address);

    var modal = new bootstrap.Modal(
        document.getElementById('addressModal')
    );

    modal.show();

});

</script>

<?php
include("includes/footer.php");
?>