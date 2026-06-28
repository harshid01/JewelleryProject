<?php
include("includes/master-top.php");
include("includes/sidebar.php");
include("includes/header.php");

$userQuery = mysqli_query($conn,
"SELECT *
FROM users
WHERE id='$user_id'");

$userData = mysqli_fetch_assoc($userQuery);
?>

<div class="content-wrapper">
<div class="container-fluid">

<div class="row">

<!-- Profile Card -->
<div class="col-lg-4">

    <div class="dashboard-card">

        <div class="card-body text-center">

            <?php
            $profileImage = !empty($userData['image'])
            ? "../Indexactivity/Uploads/users/".$userData['image']
            : "../images/default-user.png";
            ?>

            <img src="<?php echo $profileImage; ?>"
                 class="rounded-circle border border-3 mb-3"
                 width="150"
                 height="150"
                 style="object-fit:cover;">

            <h3><?php echo $userData['full_name']; ?></h3>

            <p class="text-muted text-capitalize">
                <?php echo $userData['role']; ?>
            </p>
        </div>

    </div>

</div>

<!-- Profile Details -->
<div class="col-lg-8">

    <div class="dashboard-card">

        <div class="card-body">

            <h4 class="mb-4">
                Personal Information
            </h4>

        <?php
        if(isset($_GET['success']))
        {
        ?>
        <div class="alert alert-success">
        Profile Updated Successfully
        </div>
        <?php
        }
        ?>

            <form action="update-profile.php"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Profile Image
                    </label>

                    <input type="file"
                           name="image"
                           class="form-control">

                    <small class="text-muted">
                        JPG, PNG, JPEG only
                    </small>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Full Name
                        </label>

                        <input type="text"
                               name="full_name"
                               class="form-control"
                               value="<?php echo $userData['full_name']; ?>"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?php echo $userData['email']; ?>"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Mobile Number
                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="<?php echo $userData['phone']; ?>">

                    </div>

                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Address
                        </label>

                        <textarea
                            name="address"
                            class="form-control"
                            rows="4"><?php echo $userData['address']; ?></textarea>

                    </div>

                </div>

                <button type="submit"
                        class="btn btn-lg text-white"
                        style="background:#5A0F2E;">

                    <i class="fa fa-save"></i>
                    Update Profile

                </button>

            </form>

        </div>

    </div>

</div>
<div class="modal fade" id="photoModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="update-photo.php"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Update Profile Photo
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body text-center">

                    <img src="<?php echo $profileImage; ?>"
                         width="120"
                         height="120"
                         class="rounded-circle border mb-3"
                         style="object-fit:cover;">

                    <input type="file"
                           name="image"
                           class="form-control"
                           required>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn text-white"
                            style="background:#5A0F2E;">
                        Update Photo
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<?php
include("includes/footer.php");
?>