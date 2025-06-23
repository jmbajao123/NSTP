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
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Validate inputs
    if (empty($d_id) || empty($c_id) || empty($section) || empty($s_id) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit;
    }

    // Check password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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
    $insertQuery = "INSERT INTO officer (t_id, d_id, c_id, section, s_id, email, password, confirm_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiisisss", $t_id, $d_id, $c_id, $section, $s_id, $email, $hashed_password, $confirm_password );
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
