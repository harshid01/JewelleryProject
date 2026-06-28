<?php

include 'config/db.php';

$full_name       = mysqli_real_escape_string($conn,$_POST['full_name']);
$business_name   = mysqli_real_escape_string($conn,$_POST['business_name']);
$business_email  = mysqli_real_escape_string($conn,$_POST['business_email']);
$phone           = mysqli_real_escape_string($conn,$_POST['phone']);
$city            = mysqli_real_escape_string($conn,$_POST['city']);
$monthly_volume  = mysqli_real_escape_string($conn,$_POST['monthly_volume']);
$social_media    = mysqli_real_escape_string($conn,$_POST['social_media']);
$business_goals  = mysqli_real_escape_string($conn,$_POST['business_goals']);

$sql = "INSERT INTO wholesale_applications
(
full_name,
business_name,
business_email,
phone,
city,
monthly_volume,
social_media,
business_goals
)
VALUES
(
'$full_name',
'$business_name',
'$business_email',
'$phone',
'$city',
'$monthly_volume',
'$social_media',
'$business_goals'
)";

$result = mysqli_query($conn,$sql);

if($result)
{
    echo "SUCCESS";
}
else
{
    echo mysqli_error($conn);
}

?>