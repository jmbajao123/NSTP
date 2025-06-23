<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['student_id']) && isset($_SESSION['s_id']) && ($_SESSION['full_name']) ) {
?>



<?php 
}else{
    header("Location: login.php");
    exit();
}

?>