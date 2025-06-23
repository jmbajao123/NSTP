<?php
session_start();
include "conn.php";  // Assuming you have the database connection file

if (isset($_POST['student_id'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate student_id
    $student_id = validate($_POST['student_id']);

    // Use prepared statements for security
    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind the student_id parameter
    mysqli_stmt_bind_param($stmt, "s", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the status (status) is 'Enrolled'
        if ($row['status'] == 'Enrolled') {
            // Regenerate session ID for security
            session_regenerate_id(true);

            // Set session variables
            $_SESSION['student_id'] = $row['student_id'];
            $_SESSION['s_id'] = $row['s_id'];
            $_SESSION['full_name'] = $row['full_name'];  // Optional if you want to store the full name

            // Check for missing data fields in the user's profile
            $s_id = $row['s_id'];
            $check_data_sql = "SELECT address, gender, age, birthdate, civil_status, profile_picture, valid_id FROM students WHERE s_id = ?";
            $check_stmt = mysqli_prepare($conn, $check_data_sql);
            mysqli_stmt_bind_param($check_stmt, "s", $s_id);
            mysqli_stmt_execute($check_stmt);
            $check_result = mysqli_stmt_get_result($check_stmt);
            $data_row = mysqli_fetch_assoc($check_result);

            // If any required data is missing, redirect to complete_profile.php
            if (empty($data_row['address']) || empty($data_row['gender']) || empty($data_row['age']) || empty($data_row['birthdate']) || empty($data_row['civil_status']) || empty($data_row['profile_picture']) || empty($data_row['valid_id'])) {
                echo "<script>alert('Please complete your profile.');</script>";
                echo "<script>window.location='complete_profile.php'</script>";
                exit;
            } else {
                // If all data is complete, redirect to dashboard.php
                echo "<script>alert('Sign In Successfully. Welcome back.');</script>";
                echo "<script>window.location='dashboard.php'</script>";
                exit;
            }
        } else {
            echo "<script>alert('You are not Enrolled. Access Denied.');</script>";
            echo "<script>window.location='login.php'</script>";
            exit;
        }
    } else {
        echo "<script>alert('Student ID not found.');</script>";
        echo "<script>window.location='login.php'</script>";
        exit;
    }
} else {
    // If no student_id is provided, redirect to the sign-in page
    header("Location: login.php");
    exit;
}
?>
