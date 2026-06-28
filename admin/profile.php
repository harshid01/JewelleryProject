<?php
session_start();

include 'includes/master-top.php';
include 'includes/sidebar.php';
include 'includes/header.php';
include '../config/db.php';
?>
<?php

$id = $_SESSION['user_id'];

$query = mysqli_query($conn,"
SELECT * FROM users
WHERE id='$id'
");

$row = mysqli_fetch_assoc($query);

?>
<div class="content-box">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-body text-center">

                    <?php if(!empty($row['image'])){ ?>

                        <img
                        src="../Indexactivity/Uploads/users/<?= $row['image']; ?>"
                        width="120"
                        height="120"
                        class="rounded-circle mb-3">

                    <?php } else { ?>

                        <img
                        src="https://via.placeholder.com/120"
                        width="120"
                        height="120"
                        class="rounded-circle mb-3">

                    <?php } ?>

                    <h3><?= $row['full_name']; ?></h3>

                    <span class="badge bg-primary">
                        <?= ucfirst($row['role']); ?>
                    </span>

                    <hr>

                    <table class="table">

                        <tr>
                            <th>Email</th>
                            <td><?= $row['email']; ?></td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td><?= $row['phone']; ?></td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td><?= $row['address']; ?></td>
                        </tr>

                        <tr>
                            <th>Created Date</th>
                            <td>
                                <?= date('d-m-Y',strtotime($row['created_at'])); ?>
                            </td>
                        </tr>

                    </table>

                    <div class="mt-4">

                        <button
                        class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#updateProfileModal">

                            <i class="fas fa-user-edit"></i>
                            Update Profile

                        </button>

                        <button
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">

                            <i class="fas fa-key"></i>
                            Change Password

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- <button
class="btn btn-warning"
data-bs-toggle="modal"
data-bs-target="#updateProfileModal">

    <i class="fas fa-user-edit"></i>
    Update Profile

</button>

                        <button
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">

                            <i class="fas fa-key"></i>
                            Change Password

                        </button> -->

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="modal fade"
     id="updateProfileModal">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Update Profile
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form id="updateProfileForm"
                  enctype="multipart/form-data">

                <input type="hidden"
                       name="id"
                       value="<?= $row['id']; ?>">

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Full Name</label>

                        <input
                        type="text"
                        name="full_name"
                        value="<?= $row['full_name']; ?>"
                        class="form-control"
                        required>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input
                        type="email"
                        name="email"
                        value="<?= $row['email']; ?>"
                        class="form-control"
                        required>

                    </div>

                    <div class="mb-3">

                        <label>Phone</label>

                        <input
                        type="text"
                        name="phone"
                        value="<?= $row['phone']; ?>"
                        class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Address</label>

                        <textarea
                        name="address"
                        class="form-control"><?= $row['address']; ?></textarea>

                    </div>

                    <div class="mb-3">

                        <label>Change Photo</label>

                        <input
                        type="file"
                        name="image"
                        class="form-control">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-success">

                        Update Profile

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<div class="modal fade" id="changePasswordModal">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Change Password
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form id="changePasswordForm">

                <input type="hidden"
                       name="id"
                       value="<?= $row['id']; ?>">

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Current Password</label>
                        <input type="password"
                               name="current_password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password"
                               name="new_password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password"
                               name="confirm_password"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-danger">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

$('#updateProfileForm').submit(function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({

        url:'update-profile.php',

        type:'POST',

        data:formData,

        contentType:false,

        processData:false,

        success:function(response){

            if(response.trim()=='success')
            {
                alert('Profile Updated Successfully');
                location.reload();
            }
            else
            {
                alert(response);
            }

        }

    });

});

</script>
<script>

$('#changePasswordForm').submit(function(e){

    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({

        url:'change-password.php',

        type:'POST',

        data:formData,

        success:function(response){

            alert(response);

            if(response.trim()=='success')
            {
                alert('Password Changed Successfully');
                location.reload();
            }

        }

    });

});

</script>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/master-bottom.php'; ?>