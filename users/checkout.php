<?php

session_start();
include("../config/db.php");

if(!isset($_SESSION['buy_now_product']))
{
    header("Location: collections.php");
    exit();
}

$product_id = $_SESSION['buy_now_product'];

$query = mysqli_query($conn,"
SELECT *
FROM products
WHERE id='$product_id'
");

$product = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <h2 class="mb-4">Checkout</h2>

    <div class="card p-4">

        <h4><?php echo $product['product_name']; ?></h4>

        <p>
            Price:
            <strong>
                ₹ <?php echo number_format($product['product_price']); ?>
            </strong>
        </p>

<form action="place-order.php"
      method="POST">

    <input type="hidden"
           name="product_id"
           value="<?php echo $product['id']; ?>">

    <button type="submit"
            class="btn btn-success">

        Confirm Order

    </button>

</form>

    </div>

</div>

</body>
</html>