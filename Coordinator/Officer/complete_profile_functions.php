<?php
session_start();
include "conn.php"; // Ensure you have a connection to your database

// Function to validate the data
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and store the form input values
    $birthdate = validate($_POST['birthdate']);
    $age = validate($_POST['age']);
    $gender = validate($_POST['gender']);
    $civil_status = validate($_POST['civil_status']);
    $address = validate($_POST['address']);
    $t_id = $_SESSION['t_id']; // Assuming the coordinator ID is stored in the session
    
    // Handle file uploads (Profile picture and Valid ID)
    $profile_picture = $_FILES['profile_picture'];
    $valid_id = $_FILES['valid_id'];

    // Ensure the files are uploaded successfully
    if ($profile_picture['error'] == 0 && $valid_id['error'] == 0) {
        // Generate unique file names to avoid conflicts
        $profile_picture_name = uniqid() . "_" . basename($profile_picture['name']);
        $valid_id_name = uniqid() . "_" . basename($valid_id['name']);
        
        // Define upload directory (ensure these directories exist or create them)
        $profile_picture_dir = "../Teacher/uploads/";
        $valid_id_dir = "../Teacher/uploads/";

        // Move the uploaded files to the appropriate directories
        if (move_uploaded_file($profile_picture['tmp_name'], $profile_picture_dir . $profile_picture_name) && 
            move_uploaded_file($valid_id['tmp_name'], $valid_id_dir . $valid_id_name)) {
            // Files moved successfully
        } else {
            echo "<script>alert('Error uploading files. Please try again.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error uploading files. Please try again.');</script>";
        exit;
    }

    // Check if the teacher already exists
    $check_sql = "SELECT * FROM teacher WHERE t_id = '$t_id'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        // If record exists, update the profile
        $sql = "UPDATE teacher SET 
                birthdate = '$birthdate', 
                age = '$age', 
                gender = '$gender', 
                civil_status = '$civil_status', 
                address = '$address', 
                profile_picture = '$profile_picture_name', 
                valid_id = '$valid_id_name' 
                WHERE t_id = '$t_id'";
    } else {
        // If no record exists, insert a new record
        $sql = "INSERT INTO teacher (t_id, birthdate, age, gender, civil_status, address, profile_picture, valid_id) 
                VALUES ('$t_id', '$birthdate', '$age', '$gender', '$civil_status', '$address', '$profile_picture_name', '$valid_id_name')";
    }

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Profile updated successfully.');</script>";
        echo "<script>window.location='dashboard.php'</script>"; 
    } else {
        echo "<script>alert('Error updating profile. Please try again.');</script>";
    }
}
?>
