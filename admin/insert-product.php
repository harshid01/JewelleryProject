<?php

include '../config/db.php';

$product_name        = mysqli_real_escape_string($conn,$_POST['product_name']);
$product_description = mysqli_real_escape_string($conn,$_POST['product_description']);
$category_id         = mysqli_real_escape_string($conn,$_POST['category_id']);
$product_weight      = mysqli_real_escape_string($conn,$_POST['product_weight']);
$product_price       = mysqli_real_escape_string($conn,$_POST['product_price']);
$stock_quantity      = mysqli_real_escape_string($conn,$_POST['stock_quantity']);
$status              = mysqli_real_escape_string($conn,$_POST['status']);

$image = '';

if(isset($_FILES['product_image']) && $_FILES['product_image']['name'] != '')
{
    $image = time().'_'.$_FILES['product_image']['name'];

    move_uploaded_file(
        $_FILES['product_image']['tmp_name'],
        'uploads/products/'.$image
    );
}

$sql = "INSERT INTO products
( category_id,
product_name,
product_description,
product_weight,
product_price,
stock_quantity,
product_image,
status )
VALUES
( '$category_id',
'$product_name',
'$product_description',
'$product_weight',
'$product_price',
'$stock_quantity',
'$image',
'$status' )";

$result = mysqli_query($conn,$sql);

if($result)
{
    echo "SUCCESS";
}
else
{
    echo mysqli_error($conn);
}