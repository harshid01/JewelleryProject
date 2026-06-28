<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../Indexactivity/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if(isset($_POST['full_name']))
{

    $full_name = mysqli_real_escape_string(
        $conn,
        $_POST['full_name']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $phone = mysqli_real_escape_string(
        $conn,
        $_POST['phone']
    );

    $address = mysqli_real_escape_string(
        $conn,
        $_POST['address']
    );

    /* Current Image */

    $userQuery = mysqli_query(
        $conn,
        "SELECT image
         FROM users
         WHERE id='$user_id'"
    );

    $userData = mysqli_fetch_assoc($userQuery);

    $imageName = $userData['image'];

    /* New Image Upload */

    if(!empty($_FILES['image']['name']))
    {
        

        $oldImage =
        "../Indexactivity/Uploads/users/" .
        $userData['image'];

        if(file_exists($oldImage))
        {
            unlink($oldImage);
        }

        $ext = pathinfo(
            $_FILES['image']['name'],
            PATHINFO_EXTENSION
        );

        $imageName =
        time().'_'.rand(1000,9999).'.'.$ext;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../Indexactivity/Uploads/users/".$imageName
        );

        $_SESSION['user_image'] = $imageName;
    }

    mysqli_query(
        $conn,
        "UPDATE users SET
        full_name='$full_name',
        email='$email',
        phone='$phone',
        address='$address',
        image='$imageName'
        WHERE id='$user_id'"
    );

    $_SESSION['user_name'] = $full_name;

    header("Location: profile.php?success=1");
    exit();
}
?>