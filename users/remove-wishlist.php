<?php

include("includes/master-top.php");

$id = (int)$_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM wishlist
     WHERE id='$id'
     AND user_id='$user_id'"
);

header("Location: wishlist.php?removed=1");
exit();

?>