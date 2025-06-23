<?php
// Include the database connection file
include('conn.php'); // Make sure to include your database connection here

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $nstp_name = mysqli_real_escape_string($conn, $_POST['nstp_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $n_id = mysqli_real_escape_string($conn, $_POST['n_id']); // Hidden field for program ID

    // Validate input (check if required fields are empty)
    if (empty($nstp_name) || empty($status)) {
        echo "Program Name and Status are required!";
        exit;
    }

    // SQL query to update the program details
    $query = "UPDATE nstp SET 
                nstp_name = '$nstp_name', 
                status = '$status' 
              WHERE n_id = '$n_id'";

    // Execute the query and check if the update was successful
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Program Updated successfully!');</script>";
            echo "<script>window.location='add_nstp.php';</script>"; // Redirect to a department listing page
            exit;
        // Optionally redirect after success
        // header("Location: program_list.php"); // Redirect to a listing page
    } else {
        // If the query failed, show an error message and redirect
        $error_message = mysqli_error($conn); // Capture the error message
        echo "<script>alert('Error updating department: $error_message');</script>";
        echo "<script>window.location='edit_nstp.php';</script>"; // Redirect to the department list page
        exit;
    }
}

// Close the database connection
mysqli_close($conn);
?>
