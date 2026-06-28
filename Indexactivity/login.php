<!-- Login to admin email: panchalharshid01@gmail.com password: Gp001@ -->
 <!-- Login to customer email: gp01@gmail.com password: Gp001@ -->
<?php
session_start();
require_once '../config/db.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {

                header("Location: ../admin/dashboard.php");
                exit();

            } elseif ($user['role'] == 'customer') {

                header("Location: ../users/index.php");
                exit();

            } else {

                $error = "Invalid User Role";

            }

        } else {

            $error = "Invalid Password";

        }

    } else {

        $error = "Email Not Found";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login To AJP'Sons</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../CSS/login.css"/>
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
            Welcome To<br/> Ashokbhai Jagjivandas Panchal & Son's
          </h1>
        </div>
      </div>

      <!-- Right: Login Form -->
      <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
        <div class="login-box px-4 px-md-5 py-5">
          <h2 class="mb-4 fw-bold text-center" style="font-family: Sofia, sans-serif;">Login</h2>
          
<?php if(!empty($error)) { ?>

<div class="alert alert-danger">
    <?php echo $error; ?>
</div>
<?php } ?>

<form method="POST" action="">
<div class="form-group mb-3">
    <label class="form-label">Email</label>
    <input type="email"
           class="form-control"
           name="email"
           placeholder="Your email"
           required>
</div>

<div class="form-group mb-3">
    <label class="form-label">
        Password
        <a href="#" class="float-end small">
            Forgot password?
        </a>
    </label>

    <input type="password"
           class="form-control"
           name="password"
           placeholder="Your password"
           required>
</div>

<button type="submit"
        class="btn btn-primary w-100 mb-3"
        style="font-family:Sofia,sans-serif;">
    Login
</button>

<p class="text-center mt-4">
    No account?
    <a href="registraton.php">Sign up</a>
</p>
</form>

        </div>
      </div>

    </div>
  </div>

</body>
</html>
