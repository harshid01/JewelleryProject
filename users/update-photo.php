<?php

session_start();
include("../config/db.php");

if(isset($_POST['full_name']))
{
    $user_id = $_SESSION['user_id'];

    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email     = mysqli_real_escape_string($conn,$_POST['email']);
    $phone     = mysqli_real_escape_string($conn,$_POST['phone']);
    $address   = mysqli_real_escape_string($conn,$_POST['address']);

    /* Current User */

    $userQuery = mysqli_query(
        $conn,
        "SELECT image
         FROM users
         WHERE id='$user_id'"
    );

    $userData = mysqli_fetch_assoc($userQuery);

    $imageName = $userData['image'];

    /* New Image Upload */

    if(isset($_FILES['image']) &&
       $_FILES['image']['error'] == 0)
    {
        $uploadDir = "../Indexactivity/Uploads/users/";

        /* Delete Old Image */

        if(!empty($userData['image']))
        {
            $oldImage = $uploadDir.$userData['image'];

            if(file_exists($oldImage))
            {
                unlink($oldImage);
            }
        }

        $ext = strtolower(
            pathinfo(
                $_FILES['image']['name'],
                PATHINFO_EXTENSION
            )
        );

        $allowed = ['jpg','jpeg','png','webp'];

        if(in_array($ext,$allowed))
        {
            $imageName =
            time().'_'.$_FILES['image']['name'];

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $uploadDir.$imageName
            );

            $_SESSION['user_image'] = $imageName;
        }
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