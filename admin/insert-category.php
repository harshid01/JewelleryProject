<?php

include '../config/db.php';

if(isset($_POST['category_name']))
{
    $category_name = mysqli_real_escape_string(
        $conn,
        $_POST['category_name']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    $image_name = '';

    if(isset($_FILES['category_image']))
    {
        $image_name =
        time().'_'.$_FILES['category_image']['name'];

        move_uploaded_file(
            $_FILES['category_image']['tmp_name'],
            'uploads/categories/'.$image_name
        );
    }

    $sql = "INSERT INTO categories
            (
                category_name,
                category_image,
                status
            )
            VALUES
            (
                '$category_name',
                '$image_name',
                '$status'
            )";

    mysqli_query($conn,$sql);

    echo "success";
}
?>