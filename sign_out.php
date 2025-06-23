<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    echo "<script>alert('Sign Out Success')</script>";
    echo "<script>window.location='login.php'</script>";
    exit;
?>