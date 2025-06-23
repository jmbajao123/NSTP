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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['t_id']) && isset($_POST['email']) && isset($_POST['contact_number']) && isset($_POST['n_id']) && isset($_POST['status'])) {
    // Sanitize and validate inputs
    $t_id = mysqli_real_escape_string($conn, trim($_POST['t_id']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $contact_number = mysqli_real_escape_string($conn, trim($_POST['contact_number']));
    $n_id = mysqli_real_escape_string($conn, trim($_POST['n_id']));
    $status = mysqli_real_escape_string($conn, trim($_POST['status']));
    $date = date("Y-m-d H:i:s"); // Current timestamp
    
    // Fetch teacher's full_name, password, and confirm_password from the teacher table
    $query = "SELECT full_name, password, confirm_password FROM teacher WHERE t_id = '$t_id'";
    $result = mysqli_query($conn, $query);
    $teacher = mysqli_fetch_assoc($result);
    
    if ($teacher) {
        $full_name = $teacher['full_name'];
        $password = $teacher['password'];
        $confirm_password = $teacher['confirm_password'];
        
        // Insert data into coordinator table
        $insert_query = "INSERT INTO coordinator (t_id, full_name, email, contact_number, password, confirm_password, n_id, status) 
                         VALUES ('$t_id', '$full_name', '$email', '$contact_number', '$password', '$confirm_password', '$n_id', '$status')";
        
        if (mysqli_query($conn, $insert_query)) {
            // Get the last inserted coordinator ID
            $co_id = mysqli_insert_id($conn);
            
            // Insert into users table with user_type as 'Coordinator'
            $insert_user_query = "INSERT INTO users (co_id, full_name, email, password, confirm_password, status, user_type, date) 
                                 VALUES ('$co_id', '$full_name', '$email', '$password', '$confirm_password', '$status', 'Coordinator', '$date')";
            
            if (mysqli_query($conn, $insert_user_query)) {
                echo "<script>alert('Coordinator added successfully!'); window.location.href='add_coordinator.php';</script>";
            } else {
                echo "<script>alert('Error adding user: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error adding coordinator: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error fetching teacher data.');</script>";
    }
} else {
    echo "<script>alert('Please fill in all fields.');</script>";
    echo "<script>window.location='add_coordinator.php';</script>";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
