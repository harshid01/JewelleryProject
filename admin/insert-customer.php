<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config/db.php';

$full_name = $_POST['full_name'];
$email     = $_POST['email'];
$phone     = $_POST['phone'];
$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);
$address  = $_POST['address'];
$role      = 'customer';

$image = '';

if(!empty($_FILES['image']['name']))
{
    $image = time().'_'.$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        '../Indexactivity/Uploads/users/'.$image
    );
}

mysqli_query($conn,"
INSERT INTO users
(
full_name,
email,
phone,
password,
image,
role,
address
)
VALUES
(
'$full_name',
'$email',
'$phone',
'$password',
'$image',
'$role',
'$address'
)
");

if($result){
    echo "success";
}else{
    echo mysqli_error($conn);
}
?>