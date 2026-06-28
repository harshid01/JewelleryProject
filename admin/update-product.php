<?php

include '../config/db.php';

$id                  = $_POST['id'];
$product_name        = $_POST['product_name'];
$category_id         = $_POST['category_id'];
$product_description = $_POST['product_description'];
$product_weight      = $_POST['product_weight'];
$product_price       = $_POST['product_price'];
$stock_quantity      = $_POST['stock_quantity'];
$status              = $_POST['status'];

$sql = "UPDATE products SET

category_id='$category_id',
product_name='$product_name',
product_description='$product_description',
product_weight='$product_weight',
product_price='$product_price',
stock_quantity='$stock_quantity',
status='$status'";

if(isset($_FILES['product_image']) &&
   !empty($_FILES['product_image']['name']))
{
    $image = time().'_'.$_FILES['product_image']['name'];

    move_uploaded_file(
        $_FILES['product_image']['tmp_name'],
        'uploads/products/'.$image
    );

    $sql .= ", product_image='$image'";
}

$sql .= " WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    echo "success";
}
else
{
    echo mysqli_error($conn);
}