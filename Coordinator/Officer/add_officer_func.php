<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['t_id'])) {
    die("User not logged in.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $t_id = $_SESSION['t_id'];
    $d_id = isset($_POST['department_name']) ? $_POST['department_name'] : '';
    $c_id = isset($_POST['course_name']) ? $_POST['course_name'] : '';
    $section = isset($_POST['section']) ? $_POST['section'] : '';
    $s_id = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    
    // Validate inputs
    if (empty($d_id) || empty($c_id) || empty($section) || empty($s_id)) {
        die("All fields are required.");
    }
    
    // Check if s_id already exists
    $checkQuery = "SELECT s_id FROM officer WHERE s_id = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);
    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "i", $s_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);
        
        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            echo "<script>alert('Error: This officer already exists.'); window.history.back();</script>";
            mysqli_stmt_close($checkStmt);
            exit;
        }
        mysqli_stmt_close($checkStmt);
    }
    
    // Insert data into the officers table
    $insertQuery = "INSERT INTO officer (t_id, d_id, c_id, section, s_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiisi", $t_id, $d_id, $c_id, $section, $s_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Officer added successfully!'); window.location.href='officer_list.php';</script>";
        } else {
            echo "<script>alert('Error adding officer.'); window.history.back();</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Database error.'); window.history.back();</script>";
    }
}

mysqli_close($conn);
?>