<?php
// Include the database connection
include "conn.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $course_name = isset($_POST['course_name']) ? htmlspecialchars(trim($_POST['course_name'])) : '';
    $d_id = isset($_POST['department_name']) ? htmlspecialchars(trim($_POST['department_name'])) : '';
    $status = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : '';

    // Check if the inputs are not empty
    if (!empty($course_name) && !empty($d_id) && !empty($status)) {
        // Insert query to add the course
        $sql = "INSERT INTO course (course_name, d_id, status) VALUES ('$course_name', '$d_id', '$status')";

        if (mysqli_query($conn, $sql)) {
            // Success message
            echo "<script>alert('Course added successfully!');</script>";
            echo "<script>window.location='add_course.php';</script>"; // Redirect to the courses page
        } else {
            // Error message
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            echo "<script>window.history.back();</script>"; // Redirect back to the form
        }
    } else {
        // Validation error message
        echo "<script>alert('All fields are required. Please fill out the form correctly.');</script>";
        echo "<script>window.history.back();</script>"; // Redirect back to the form
    }
}

// Close the database connection
mysqli_close($conn);
?>
