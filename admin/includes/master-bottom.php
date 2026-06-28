</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

    const menuBtn = document.getElementById("menuToggle");
    const sidebar = document.querySelector(".sidebar");
    const overlay = document.querySelector(".sidebar-overlay");

    console.log("Button:", menuBtn);
    console.log("Sidebar:", sidebar);

    menuBtn.addEventListener("click", function() {

        console.log("Menu Clicked");

        sidebar.classList.toggle("active");
        overlay.classList.toggle("active");

    });

    overlay.addEventListener("click", function() {

        sidebar.classList.remove("active");
        overlay.classList.remove("active");

    });

});
</script>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>