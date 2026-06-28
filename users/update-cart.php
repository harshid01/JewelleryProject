<?php

include("includes/master-top.php");

if(isset($_POST['cart_id']) && isset($_POST['quantity']))
{
    $cart_id = (int)$_POST['cart_id'];
    $quantity = (int)$_POST['quantity'];

    // Minimum quantity 1
    if($quantity < 1)
    {
        $quantity = 1;
    }

    $updateQuery = mysqli_query(
        $conn,
        "UPDATE cart
         SET quantity='$quantity'
         WHERE id='$cart_id'
         AND user_id='$user_id'"
    );

    if($updateQuery)
    {
        header("Location: cart.php?updated=1");
        exit();
    }
    else
    {
        echo "Error : " . mysqli_error($conn);
    }
}
else
{
    header("Location: cart.php");
    exit();
}

?>