<?php
session_start(); // Start the session to get co_id
include 'conn.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the co_id of the currently signed-in user
    if (!isset($_SESSION['co_id'])) {
        echo "<script>alert('Error: User not signed in.');</script>";
        echo "<script>window.location='index.php';</script>"; // Redirect to login page
        exit();
    }
    $co_id = $_SESSION['co_id'];

    // Get form data
    $area_name = $conn->real_escape_string($_POST['area_name']);
    $status = $conn->real_escape_string($_POST['status']);

    // Insert data into the area table
    $sql = "INSERT INTO area (area_name, status, co_id) VALUES ('$area_name', '$status', '$co_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New area added successfully.');</script>";
        echo "<script>window.location='a_area.php';</script>"; // Redirect to area list
        exit();
    } else {
        echo "<script>alert('Error adding area.');</script>";
        echo "<script>window.location='add_a_area.php';</script>"; // Redirect back to form
        exit();
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request.');</script>";
    echo "<script>window.location='add_a_area.php';</script>";
    exit();
}
?>
