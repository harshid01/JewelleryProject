<?php

include("includes/master-top.php");

$id = (int)$_GET['id'];

$wishQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM wishlist
     WHERE id='$id'
     AND user_id='$user_id'"
);

if(mysqli_num_rows($wishQuery) > 0)
{
    $wishData = mysqli_fetch_assoc($wishQuery);

    $product_id = $wishData['product_id'];

    $checkCart = mysqli_query(
        $conn,
        "SELECT *
         FROM cart
         WHERE user_id='$user_id'
         AND product_id='$product_id'"
    );

    if(mysqli_num_rows($checkCart) == 0)
    {
        mysqli_query(
            $conn,
            "INSERT INTO cart
            (user_id,product_id,quantity)
            VALUES
            ('$user_id','$product_id','1')"
        );
    }

    mysqli_query(
        $conn,
        "DELETE FROM wishlist
         WHERE id='$id'"
    );
}

header("Location: wishlist.php?cart=1");
exit();

?>