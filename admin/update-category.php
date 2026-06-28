<?php

include '../config/db.php';

if(isset($_POST['id']))
{
    $id = intval($_POST['id']);

    $category_name =
    mysqli_real_escape_string(
        $conn,
        $_POST['category_name']
    );

    $status =
    mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    if($_FILES['category_image']['name']!='')
    {
        $image_name =
        time().'_'.$_FILES['category_image']['name'];

        move_uploaded_file(
            $_FILES['category_image']['tmp_name'],
            'uploads/categories/'.$image_name
        );

        mysqli_query(
            $conn,
            "UPDATE categories
             SET
             category_name='$category_name',
             category_image='$image_name',
             status='$status'
             WHERE id='$id'"
        );
    }
    else
    {
        mysqli_query(
            $conn,
            "UPDATE categories
             SET
             category_name='$category_name',
             status='$status'
             WHERE id='$id'"
        );
    }

    echo "success";
}
?>