<?php
include '../config/db.php';

$query = mysqli_query($conn, "
SELECT image,full_name FROM users
WHERE role='admin'
LIMIT 1
");

$row = mysqli_fetch_assoc($query);
?>

<div class="main-content">

<div class="header">

    <div class="header-content">
        <button id="menuToggle" class="mobile-menu-btn">
            <i class="fa fa-bars"></i>
        </button>

        <h4>Welcome, <?= $row['full_name']; ?></h4>

        <div class="user-box">

            <?php if(!empty($row['image'])){ ?>
                <a href="profile.php">
                    <img src="../Indexactivity/Uploads/users/<?= $row['image']; ?>"
                         alt="Profile"
                         class="rounded-circle border border-3"
                         width="80"
                         height="80"
                         style="object-fit:cover;">
                </a>
            <?php } else { ?>
                <img src="https://via.placeholder.com/120"
                     width="80"
                     height="80"
                     class="rounded-circle mb-3">
            <?php } ?>

        </div>

    </div>

</div>

<div class="page-content">