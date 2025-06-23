<?php
// Include the database connection
include('conn.php'); // Replace with your actual database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $d_id = mysqli_real_escape_string($conn, $_POST['department_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $course_id = mysqli_real_escape_string($conn, $_POST['c_id']);

    // Validate form data
    if (empty($course_name) || empty($d_id) || empty($status)) {
        echo "All fields are required!";
        exit;
    }

    // Prepare the SQL query to update the course data
    $query = "UPDATE course SET 
                course_name = '$course_name', 
                d_id = '$d_id', 
                status = '$status' 
              WHERE c_id = '$course_id'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Course Updated successfully!');</script>";
            echo "<script>window.location='add_course.php';</script>"; // Redirect to a department listing page
            exit;
        // Redirect to another page, like a confirmation or listing page (optional)
        // header("Location: course_list.php");
    } else {
        // If the query failed, show an error message and redirect
        $error_message = mysqli_error($conn); // Capture the error message
        echo "<script>alert('Error updating department: $error_message');</script>";
        echo "<script>window.location='edit_course.php';</script>"; // Redirect to the department list page
        exit;
    }
}

// Close the database connection
mysqli_close($conn);
?>
