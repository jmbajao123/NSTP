<?php
// Start session
session_start();

// Include the database connection file
include "conn.php";

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nstp_name']) && isset($_POST['status'])) {
    // Sanitize and validate the input
    $nstp_name = mysqli_real_escape_string($conn, trim($_POST['nstp_name']));
    $status = mysqli_real_escape_string($conn, trim($_POST['status']));
    $date = date("Y-m-d H:i:s"); // Get the current date and time

    // Check if the inputs are not empty
    if (!empty($nstp_name) && !empty($status)) {
        // Prepare the SQL query to insert the NSTP name, status, and date into the database
        $sql = "INSERT INTO nstp (nstp_name, status, date) VALUES ('$nstp_name', '$status', '$date')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // Success message and redirection
            echo "<script>alert('Program added successfully!');</script>";
            echo "<script>window.location = 'add_nstp.php';</script>";
            exit;
        } else {
            // Error message and redirection
            echo "<script>alert('Error: Could not add NSTP.');</script>";
            echo "<script>window.history.back();</script>";
            exit;
        }
    } else {
        // Validation error message and redirection
        echo "<script>alert('Please fill in all required fields.');</script>";
        echo "<script>window.history.back();</script>";
        exit;
    }
} else {
    // Redirect to the form if accessed directly
    header("Location: add_nstp.php");
    exit;
}
?>
