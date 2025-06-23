<?php
session_start();
include "conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    
    // Use prepared statements for security
    $sql = "SELECT * FROM teacher WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['t_id'] = $row['t_id'];
            $_SESSION['password'] = $row['password'];

            // Check for missing data fields
            $t_id = $row['t_id'];
            $check_data_sql = "SELECT address, gender, age, birthdate, civil_status, profile_picture, valid_id FROM teacher WHERE t_id = '$t_id'";
            $check_result = mysqli_query($conn, $check_data_sql);
            $data_row = mysqli_fetch_assoc($check_result);

            // If any required data is missing, redirect to complete_profile.php
            if (empty($data_row['address']) || empty($data_row['gender']) || empty($data_row['age']) || empty($data_row['birthdate']) || empty($data_row['civil_status']) || empty($data_row['profile_picture']) || empty($data_row['valid_id'])) {
                echo "<script>alert('Please complete your profile.');</script>";
                echo "<script>window.location='complete_profile.php'</script>";
                exit;
            } else {
                // If all data is complete, redirect to dashboard.php
                echo "<script>alert('Sign In Successfully Welcome back.');</script>";
                echo "<script>window.location='dashboard.php'</script>";
                exit;
            }
        } else {
            echo "<script>alert('Incorrect email or password!')</script>";
            echo "<script>window.location='sign_in.php'</script>";
            exit;
        }
    } else {
        echo "<script>alert('Incorrect email or password!')</script>";
        echo "<script>window.location='sign_in.php'</script>";
        exit;
    }
} else {
    header("Location: sign_in.php");
}
?>
