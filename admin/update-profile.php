<?php

include '../config/db.php';

$id        = $_POST['id'];
$full_name = $_POST['full_name'];
$email     = $_POST['email'];
$phone     = $_POST['phone'];
$address   = $_POST['address'];

$sql = "
UPDATE users SET

full_name='$full_name',
email='$email',
phone='$phone',
address='$address'
";

if(!empty($_FILES['image']['name']))
{
    $image = time().'_'.$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        '../Indexactivity/Uploads/users/'.$image
    );

    $sql .= ", image='$image'";
}

$sql .= " WHERE id='$id'";

$result = mysqli_query($conn,$sql);

if($result)
{
    echo "success";
}
else
{
    echo mysqli_error($conn);
}