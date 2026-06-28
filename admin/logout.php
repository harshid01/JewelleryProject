<?php
session_start();
session_destroy();

header("Location: ../Indexactivity/login.php");
exit();
?>