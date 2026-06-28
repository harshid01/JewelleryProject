<?php

include '../config/db.php';

$id = $_POST['id'];

mysqli_query(
    $conn,
    "DELETE FROM orders
     WHERE id='$id'"
);

echo "success";