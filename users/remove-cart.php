<?php

include("includes/master-top.php");

if(isset($_GET['id']))
{
    $cart_id = (int)$_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM cart
         WHERE id='$cart_id'
         AND user_id='$user_id'"
    );

    header("Location: cart.php?deleted=1");
    exit();
}
else
{
    header("Location: cart.php");
    exit();
}
?>