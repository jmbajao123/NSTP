<?php
// Include the database connection
include "conn.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data and sanitize it
    $department_name = mysqli_real_escape_string($conn, $_POST['department_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $d_id = intval($_POST['d_id']);  // Ensure the d_id is an integer to prevent SQL injection

    // Check if the data is valid
    if (empty($department_name) || empty($status) || !$d_id) {
        echo "All fields are required.";
        exit;
    }

    // Update the department in the database
    $sql = "UPDATE departments SET department_name = '$department_name', status = '$status' WHERE d_id = $d_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Department updated successfully!');</script>";
        echo "<script>window.location='add_department.php';</script>"; // Redirect to the department list page
        exit;
    } else {
        // If the query failed, show an error message and redirect
        $error_message = mysqli_error($conn); // Capture the error message
        echo "<script>alert('Error updating department: $error_message');</script>";
        echo "<script>window.location='edit_deparment.php';</script>"; // Redirect to the department list page
        exit;
    }
}

// Close the database connection
mysqli_close($conn);
?>
