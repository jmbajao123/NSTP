<?php
include "conn.php"; // Include your database connection

session_start(); // Start the session to access the logged-in user's data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $staff_full_name = mysqli_real_escape_string($conn, $_POST['staff_full_name']);
    $staff_email = mysqli_real_escape_string($conn, $_POST['staff_email']);
    $staff_password = mysqli_real_escape_string($conn, $_POST['staff_password']);
    $staff_confirm_password = mysqli_real_escape_string($conn, $_POST['staff_confirm_password']);
    
    // Get the currently logged-in user's co_id
    $co_id = isset($_SESSION['co_id']) ? $_SESSION['co_id'] : null;

    // Initialize error message
    $error_message = "";

    // Validate email format
    if (!filter_var($staff_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    }

    // Check if passwords match
    if ($staff_password !== $staff_confirm_password) {
        $error_message = "Passwords do not match.";
    }

    // Check if co_id is available
    if (empty($co_id)) {
        $error_message = "Logged-in user's co_id is missing.";
    }

    // If no errors, proceed with insertion
    if (empty($error_message)) {
        // Hash the password for security
        $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);

        // Insert data into the database
        $query = "INSERT INTO staff (staff_full_name, staff_email, staff_password, staff_confirm_password, co_id) 
                  VALUES ('$staff_full_name', '$staff_email', '$hashed_password', '$staff_confirm_password', '$co_id')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Staff successfully added!');
                    window.location.href = 'staff_list.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error adding staff: " . mysqli_error($conn) . "');
                    window.location.href = 'add_teachers.php';
                  </script>";
            exit();
        }
    } else {
        // Display validation errors and navigate to `add_teachers.php`
        echo "<script>
                alert('$error_message');
                window.location.href = 'add_teachers.php';
              </script>";
        exit();
    }
}
?>
