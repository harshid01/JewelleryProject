<?php
$profileImage = !empty($user_image)
    ? $user_image
    : 'default.png';
?>
<div class="main-content">

<div class="header">

    <div class="header-content">
<button id="menuToggle" class="mobile-menu-btn">
            <i class="fa fa-bars"></i>
        </button>
        <h4>Welcome, <?php echo $user_name; ?></h4>
        <div class="user-box">
<a href="#"
   data-bs-toggle="modal"
   data-bs-target="#profilePreviewModal">

    <img src="../Indexactivity/Uploads/users/<?php echo $user_image; ?>"
         alt="Profile"
         class="rounded-circle border border-3"
         width="80"
         height="80"
         style="object-fit:cover; cursor:pointer;">
</a>
        </div>

    </div>

</div>
<?php

$userQuery = mysqli_query($conn,
"SELECT *
FROM users
WHERE id='$user_id'");

$userData = mysqli_fetch_assoc($userQuery);

$profileImage = !empty($userData['image'])
? "../Indexactivity/Uploads/users/".$userData['image']
: "../images/default-user.png";

?>

<div class="modal fade"
     id="profilePreviewModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    My Profile
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img src="<?php echo $profileImage; ?>"
                     class="rounded-circle border border-3 mb-3"
                     width="130"
                     height="130"
                     style="object-fit:cover;">

                <h4>
                    <?php echo $userData['full_name']; ?>
                </h4>

                <p class="text-muted">
                    <?php echo ucfirst($userData['role']); ?>
                </p>

                <hr>

                <div class="text-start">

                    <p>
                        <strong>Email :</strong>
                        <?php echo $userData['email']; ?>
                    </p>

                    <p>
                        <strong>Phone :</strong>
                        <?php echo $userData['phone']; ?>
                    </p>

                    <p>
                        <strong>Address :</strong>
                        <?php echo $userData['address']; ?>
                    </p>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Back

                </button>

            </div>

        </div>

    </div>

</div>
<div class="page-content">