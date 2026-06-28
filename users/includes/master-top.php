<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../../Indexactivity/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$userQuery = mysqli_query($conn,
"SELECT * FROM users WHERE id='$user_id'");

$userData = mysqli_fetch_assoc($userQuery);

$user_name  = $userData['full_name'];
$user_image = $userData['image'];
$user_role  = $userData['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png">


<title>Harshid Jewellery</title>

<meta name="description"
    content="Premium Jewellery Collection - Rings, Necklaces, Earrings, Diamond Jewellery and Custom Designs">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="../users/assets/css/style.css">
<!-- <link rel="stylesheet" href="../CSS/style.css"> -->
<!-- <link rel="stylesheet" href="../CSS/responsive-style.css"> -->
</head>

<body>

<div class="wrapper">