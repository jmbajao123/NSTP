<?php
session_start(); // Start the session to get the logged-in user's session

// Check if the user is logged in by checking if r_id exists in session
if (!isset($_SESSION['r_id'])) {
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location='login.php';</script>"; // Redirect to login page
    exit();
}

include 'conn.php';

// Get the logged-in user's r_id from the session
$r_id = $_SESSION['r_id'];

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['contact_number']) && isset($_POST['status']) && isset($_POST['confirm_password'])) {
    // Sanitize and validate inputs
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $confirm_password = mysqli_real_escape_string($conn, trim($_POST['confirm_password']));
    $contact_number = mysqli_real_escape_string($conn, trim($_POST['contact_number']));
    $status = mysqli_real_escape_string($conn, trim($_POST['status']));
    $date = date("Y-m-d H:i:s"); // Current timestamp

    // Check if the inputs are not empty
    if (!empty($full_name) && !empty($email) && !empty($password) && !empty($confirm_password) && !empty($contact_number) && !empty($status)) {
        // Ensure password and confirm password match
        if ($password !== $confirm_password) {
            echo "<script>alert('Password and Confirm Password do not match.');</script>";
            echo "<script>window.location='add_teacher.php';</script>";
            exit;
        }

        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists in the database
        $email_check_sql = "SELECT * FROM teacher WHERE email = '$email'";
        $email_check_result = mysqli_query($conn, $email_check_sql);

        if (mysqli_num_rows($email_check_result) > 0) {
            echo "<script>alert('Email already exists!');</script>";
            echo "<script>window.location='add_teacher.php';</script>";
            exit();
        }

        // Prepare the SQL query to insert data into the `teacher` table
        $sql_teacher = "INSERT INTO teacher (full_name, email, password, confirm_password, contact_number, status, date, r_id) 
                        VALUES ('$full_name', '$email', '$hashed_password', '$confirm_password', '$contact_number', '$status', '$date', '$r_id')";

        // Execute the query for the teacher table
        if (mysqli_query($conn, $sql_teacher)) {
            // Get the last inserted teacher ID to use in the users table
            $teacher_id = mysqli_insert_id($conn);

            // Prepare the SQL query to insert data into the `users` table with user_type as 'Teacher'
            $sql_users = "INSERT INTO users (t_id, full_name, email, password, confirm_password, status, user_type, date) 
                          VALUES ('$teacher_id', '$full_name', '$email', '$hashed_password', '$confirm_password', '$status', 'Teacher', '$date')";

            // Execute the query for the users table
            if (mysqli_query($conn, $sql_users)) {
                // If both queries are successful, redirect with a success message
                echo "<script>alert('New Teacher added successfully!');</script>";
                echo "<script>window.location='add_teacher.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error: Could not add teacher to users table.');</script>";
                echo "<script>window.location='add_teacher.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Error: Could not add teacher.');</script>";
            echo "<script>window.location='add_teacher.php';</script>";
            exit();
        }
    } else {
        // If any field is empty, show an alert
        echo "<script>alert('Please fill in all fields.');</script>";
        echo "<script>window.location='add_teacher.php';</script>";
        exit();
    }
} else {
    // If accessed directly, redirect to the form
    header("Location: add_teacher.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
