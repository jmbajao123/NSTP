<?php
// Start session
session_start();

// Include the database connection file
include "conn.php";

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['department_name']) && isset($_POST['status'])) {
    // Sanitize and validate the input
    $department_name = mysqli_real_escape_string($conn, trim($_POST['department_name']));
    $status = mysqli_real_escape_string($conn, trim($_POST['status']));

    // Check if the inputs are not empty
    if (!empty($department_name) && !empty($status)) {
        // Prepare an SQL query to insert the department name and status into the database
        $sql = "INSERT INTO departments (department_name, status) VALUES ('$department_name', '$status')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // If successful, redirect with a success message
            echo "<script>alert('Department added successfully!');</script>";
            echo "<script>window.location='add_department.php';</script>"; // Redirect to a department listing page
            exit;
        } else {
            // If an error occurs, show an error message
            echo "<script>alert('Error: Could not add department.');</script>";
            echo "<script>window.location='add_department.php';</script>"; // Redirect back to the form
            exit;
        }
    } else {
        // If the inputs are empty, show an alert
        echo "<script>alert('Please fill in all fields.');</script>";
        echo "<script>window.location='add_department.php';</script>"; // Redirect back to the form
        exit;
    }
} else {
    // If accessed directly, redirect to the form
    header("Location: add_department.php");
    exit;
}
?>
