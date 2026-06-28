<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

```
<title><?= $page_title ?? 'Harshid Jewellery'; ?></title>

<meta name="description" content="Premium Jewellery Collection - Rings, Necklaces, Earrings & Custom Designs">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive-style.css">

<!-- Favicon -->
<link rel="icon" type="image/png" href="assets/images/favicon.png">
```

</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navigation-wrap fixed-top">
        <div class="container">

```
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/logo.png" alt="Harshid Jewellery" height="60">
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarText">

            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>

                <li class="nav-item ms-2">
                    <a href="login.php" class="btn btn-outline-dark">
                        Login
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>
```

</header>

<main>
