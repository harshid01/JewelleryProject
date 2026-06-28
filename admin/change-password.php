<?php

include '../config/db.php';

$id = $_POST['id'];

$current_password = $_POST['current_password'];

$new_password = $_POST['new_password'];

$confirm_password = $_POST['confirm_password'];

$query = mysqli_query($conn,"
SELECT password
FROM users
WHERE id='$id'
");

$row = mysqli_fetch_assoc($query);

if(!password_verify($current_password,$row['password']))
{
    echo "Current Password Incorrect";
    exit;
}

if($new_password != $confirm_password)
{
    echo "New Password and Confirm Password Not Match";
    exit;
}

$new_hash = password_hash(
    $new_password,
    PASSWORD_DEFAULT
);

mysqli_query($conn,"
UPDATE users
SET password='$new_hash'
WHERE id='$id'
");

echo "success";

?>