<?php
session_start();
require_once '../config/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
    $password  = $_POST['password'];
    $confirm   = $_POST['confirm_password'];
    // /* Image Upload */
$image = "";

if(isset($_FILES['passport']) && $_FILES['passport']['error'] == 0){

    $upload_dir = "Uploads/users/";

    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0777, true);
    }

    $image = time() . "_" . basename($_FILES['passport']['name']);

    move_uploaded_file(
        $_FILES['passport']['tmp_name'],
        $upload_dir . $image
    );
}

    if ($password != $confirm) {

        $message = "<div class='alert alert-danger'>Passwords do not match!</div>";

    } else {

        $check = mysqli_query(
            $conn,
            "SELECT * FROM users WHERE email='$email'"
        );

        if (mysqli_num_rows($check) > 0) {

            $message = "<div class='alert alert-warning'>Email already exists!</div>";

        } else {

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $sql = "INSERT INTO users
                    (image,full_name,email,phone,password)
                    VALUES
                    ('$image','$full_name','$email','$phone','$hashed_password')";

            if (mysqli_query($conn, $sql)) {

                $message = "<div class='alert alert-success'>
                                Registration Successful!
                            </div>";

            } else {

                $message = "<div class='alert alert-danger'>
                                Registration Failed!
                            </div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="images/logo.png">
  <title>Register | AJP'Sons</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../CSS/reg.css"/> <!-- Same CSS as login page -->
</head>
<body>

  <div class="container-fluid g-0">
    <div class="row g-0 min-vh-100">

      <!-- Left: Image + Welcome Text -->
      <div class="col-md-6 d-flex flex-column justify-content-center align-items-start left-section">
        <div class="overlay"></div>
        <img src="../images/bg/bg-3.jpg" alt="Jewellery" class="bg-img"/>
        <div class="welcome-text text-white px-5">
          <h1 class="fw-bold animate-text" style="font-family: Sofia, sans-serif;">
            Register With<br/> Ashokbhai Jagjivandas Panchal & Son's
          </h1>
        </div>
      </div>

      <!-- Right: Registration Form -->
      <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
<div class="col-md-6 d-flex align-items-center justify-content-center bg-white">


<div class="login-box px-4 px-md-5 py-5">

    <h2 class="mb-4 fw-bold text-center"
        style="font-family:Sofia,sans-serif;">
        Create Account
    </h2>

    <?= $message ?>

    <form method="POST" action="" enctype="multipart/form-data">

        <!-- Full Name -->
        <div class="form-group mb-3">
            <label class="form-label">Full Name</label>

            <input
                type="text"
                class="form-control"
                name="full_name"
                placeholder="Enter your full name"
                required>
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label class="form-label">Email Address</label>

            <input
                type="email"
                class="form-control"
                name="email"
                placeholder="Enter your email"
                required>
        </div>

        <!-- Mobile Number -->
        <div class="form-group mb-3">
            <label class="form-label">Mobile Number</label>

            <input
                type="text"
                class="form-control"
                name="phone"
                placeholder="Enter your mobile number"
                required>
        </div>

        <!-- Password -->
        <div class="form-group mb-3">
            <label class="form-label">Password</label>

            <input
                type="password"
                class="form-control"
                name="password"
                placeholder="Create password"
                required>
        </div>

        <!-- Confirm Password -->
        <div class="form-group mb-3">
            <label class="form-label">Confirm Password</label>

            <input
                type="password"
                class="form-control"
                name="confirm_password"
                placeholder="Confirm password"
                required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Your Image</label>
            <input type="file" name="passport" class="form-control" required>
        </div>

        <!-- Terms -->
        <div class="form-check mb-3">

            <input
                class="form-check-input"
                type="checkbox"
                id="terms"
                required>

<label class="form-check-label">

    I agree to the

    <a href="#" id="termsLink">
        Terms & Conditions
    </a>

</label>

        </div>

        <!-- Register Button -->
        <button
            type="submit"
            class="btn btn-primary w-100 mb-3"
            style="font-family:Sofia,sans-serif;">

            Register

        </button>

        <p class="text-center mt-3">

            Already have an account?

            <a href="login.php">
                Login
            </a>

        </p>

    </form>

</div>


</div>

      </div>

    </div>
  </div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Terms & Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
<h5 class="modal-title">
    Terms & Conditions
</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <h5>Welcome to AJP'Sons Jewellery</h5>

                <p>
                    By creating an account on our website, you agree to the following
                    terms and conditions.
                </p>

                <hr>

                <h6>1. Account Registration</h6>

                <p>
                    You must provide accurate and complete information during
                    registration.
                </p>

                <h6>2. Password Security</h6>

                <p>
                    You are responsible for maintaining the confidentiality of
                    your password.
                </p>

                <h6>3. Orders</h6>

                <p>
                    Orders are subject to product availability and confirmation
                    by AJP'Sons Jewellery.
                </p>

                <h6>4. Payments</h6>

                <p>
                    All payments must be completed before product dispatch unless
                    otherwise agreed.
                </p>

                <h6>5. Privacy</h6>

                <p>
                    Your personal information will only be used for processing
                    orders and improving our services.
                </p>

                <h6>6. Returns</h6>

                <p>
                    Return or replacement requests are accepted only according to
                    our return policy.
                </p>

                <h6>7. Acceptance</h6>

                <p>
                    By checking the "I agree to the Terms & Conditions" checkbox,
                    you confirm that you have read and accepted these terms.
                </p>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
document.getElementById("termsLink").addEventListener("click", function(e){

    e.preventDefault();

    var modal = new bootstrap.Modal(document.getElementById("termsModal"));

    modal.show();

});
</script>
</body>
</html>
