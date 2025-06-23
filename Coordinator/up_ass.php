<?php
session_start();
include 'conn.php'; // Include database connection

// Ensure user is logged in
if (!isset($_SESSION['co_id'])) {
    die("<script>alert('Access Denied. Please log in.'); window.location.href='login.php';</script>");
}

$co_id = $_SESSION['co_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assign_off_id = isset($_POST['assign_off_id']) ? intval($_POST['assign_off_id']) : 0;
    $area_id = isset($_POST['area_id']) ? intval($_POST['area_id']) : 0;
    $o_id = isset($_POST['o_id']) ? intval($_POST['o_id']) : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // Validate inputs
    if ($area_id == 0 || $o_id == 0 || empty($status)) {
        echo "<script>alert('Invalid input. Please fill in all fields.'); window.location.href='ass_student.php';</script>";
        exit();
    }

    if ($assign_off_id > 0) {
        // Update existing record
        $query = "UPDATE assign_off SET area_id = ?, o_id = ?, status = ? WHERE assign_off_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisi", $area_id, $o_id, $status, $assign_off_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Area successfully updated!'); window.location.href='ass_student.php';</script>";
        } else {
            echo "<script>alert('Error updating record: " . $stmt->error . "'); window.location.href='ass_student.php';</script>";
        }
    } else {
        // Insert new record
        $query = "INSERT INTO assign_off (area_id, o_id, status) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iis", $area_id, $o_id, $status);
        
        if ($stmt->execute()) {
            echo "<script>alert('Area successfully assigned to Officer!'); window.location.href='ass_student.php';</script>";
        } else {
            echo "<script>alert('Error inserting record: " . $stmt->error . "'); window.location.href='ass_student.php';</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>
