<?php
// Include the database connection
include "conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the inputs
    $full_name = isset($_POST['full_name']) ? htmlspecialchars(trim($_POST['full_name'])) : '';
    $student_id = isset($_POST['student_id']) ? htmlspecialchars(trim($_POST['student_id'])) : '';
    $d_id = isset($_POST['department_name']) ? htmlspecialchars(trim($_POST['department_name'])) : '';
    $c_id = isset($_POST['course_name']) ? htmlspecialchars(trim($_POST['course_name'])) : '';
    $section = isset($_POST['section']) ? htmlspecialchars(trim($_POST['section'])) : '';
    $n_id = isset($_POST['nstp']) ? htmlspecialchars(trim($_POST['nstp'])) : ''; // Changed to 'nstp'
    $status = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : '';

    // Check if all required fields are filled
    if (!empty($full_name) && !empty($student_id) && !empty($d_id) && !empty($c_id) && !empty($section) && !empty($n_id) && !empty($status)) {
        // Prepare the SQL query to insert the student data using prepared statements
        $stmt = $conn->prepare("INSERT INTO students (full_name, student_id, d_id, c_id, section, n_id, status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $full_name, $student_id, $d_id, $c_id, $section, $n_id, $status);

        // Execute the query
        if ($stmt->execute()) {
            // Success message
            echo "<script>alert('Student added successfully!');</script>";
            echo "<script>window.location = 'student_list.php';</script>"; // Redirect to the form page
        } else {
            // Error message
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
            echo "<script>window.history.back();</script>"; // Redirect back to the form
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Validation error message
        echo "<script>alert('All fields are required. Please fill out the form correctly.');</script>";
        echo "<script>window.history.back();</script>"; // Redirect back to the form
    }
}

// Close the database connection
mysqli_close($conn);
?>
