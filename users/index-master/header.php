<!-- Navigation -->
<header>
    <nav class="navbar navbar-expand-lg navigation-wrap">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                <img src="../../images/logo.png"
                    alt="Harshid Jewellery"
                    class="img-fluid">
            </a>

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarText">

                <i class="fas fa-bars"></i>

            </button>

            <div class="collapse navbar-collapse"
                id="navbarText">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active"
                            href="#home">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="#about">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="collections.php">
                            Collections
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="#founders">
                            Founders
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="#faq">
                            FAQ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="../conttect.php">
                            Contact Us
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link"
                            href="logout.php">
                            LogOut
                        </a>
                    </li>
<?php
$userQuery = mysqli_query($conn,
"SELECT image
FROM users
WHERE id='$user_id'");

$userData = mysqli_fetch_assoc($userQuery);

$profileImage = !empty($userData['image'])
? "../Indexactivity/Uploads/users/".$userData['image']
: "../images/default-user.png";
?>

<li class="nav-item dropdown ms-2">

    <a class="nav-link p-0"
       href="#"
       data-bs-toggle="dropdown">

        <img src="<?php echo $profileImage; ?>"
             alt="Profile"
             class="rounded-circle"
             width="50"
             height="50"
             style="
             object-fit:cover;
             border:3px solid #4a0d26;
             cursor:pointer;">
    </a>

<ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-0 overflow-hidden"
    style="width:280px;border-radius:20px;">

    <!-- Header -->
    <li class="text-center text-white p-4"
        style="background:linear-gradient(135deg,#5A0F2E,#B88646);">

        <img src="<?php echo $profileImage; ?>"
             width="90"
             height="90"
             class="rounded-circle border border-4 border-white shadow"
             style="object-fit:cover;">

        <h5 class="mt-3 mb-1">
            <?php echo $_SESSION['user_name']; ?>
        </h5>

        <small>
            Jewellery Customer
        </small>

    </li>

    <!-- Menu -->
    <li>
        <a class="dropdown-item py-3"
           href="dashboard.php">

            <i class="fa-solid fa-chart-line me-3 text-warning"></i>
            Dashboard

        </a>
    </li>

    <li>
        <a class="dropdown-item py-3"
           href="profile.php">

            <i class="fa-solid fa-user me-3 text-primary"></i>
            My Profile

        </a>
    </li>

    <li><hr class="dropdown-divider m-0"></li>

    <li>
        <a class="dropdown-item py-3"
           href="javascript:history.back()">

            <i class="fa-solid fa-arrow-left me-3"></i>
            Back

        </a>
    </li>

    <li>
        <a class="dropdown-item py-3 text-danger fw-bold"
           href="logout.php">

            <i class="fa-solid fa-right-from-bracket me-3"></i>
            Logout

        </a>
    </li>

</ul>

                  <!-- <a href="Indexactivity/contact.php"><li><button class="main-btn">CONNECT ME</button></li></a> -->

                </ul>

            </div>

        </div>
    </nav>
</header>