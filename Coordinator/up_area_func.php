<?php
session_start();
include 'conn.php'; // Include database connection

// Ensure request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $area_id = isset($_POST['area_id']) ? intval($_POST['area_id']) : 0;
    $area_name = isset($_POST['area_name']) ? trim($_POST['area_name']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // Validate input
    if (empty($area_name) || empty($status)) {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit();
    }

    if ($area_id > 0) {
        // Update existing area
        $query = "UPDATE area SET area_name = ?, status = ? WHERE area_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $area_name, $status, $area_id);
        $action = "updated";
    } else {
        // Insert new area
        $query = "INSERT INTO area (area_name, status) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $area_name, $status);
        $action = "added";
    }

    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('Area successfully $action!'); window.location.href='a_area.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
