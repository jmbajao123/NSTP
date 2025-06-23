<?php
session_start();
include 'conn.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $et = isset($_POST['et']) ? intval($_POST['et']) : 0;
    $s_id = isset($_SESSION['s_id']) ? intval($_SESSION['s_id']) : 0; 

    if ($et > 0 && $s_id > 0) {
        // Check if the End Time (et) exists in the render_time table
        $check_query = "SELECT rt_id, assign_off_id, area_id, o_id FROM render_time WHERE et = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("i", $et);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            echo "<script>alert('End Time Code does not exist.'); window.location.href = 'dashboard.php';</script>";
            exit();
        }

        // Ensure the user has an associated Start Time record
        $st_check_query = "SELECT st_r_id FROM st_render WHERE s_id = ? LIMIT 1";
        $stmt = $conn->prepare($st_check_query);
        $stmt->bind_param("i", $s_id);
        $stmt->execute();
        $st_result = $stmt->get_result();

        if ($st_result->num_rows === 0) {
            echo "<script>alert('Cannot insert End Time Code. You must insert a Start Time Code first.'); window.location.href = 'dashboard.php';</script>";
            exit();
        }

        $st_row = $st_result->fetch_assoc();
        $st_r_id = $st_row['st_r_id'];

        // Update only the et column for the existing st_r_id
        $update_query = "UPDATE st_render SET et = ? WHERE st_r_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $et, $st_r_id);

        if ($stmt->execute()) {
            echo "<script>alert('End Time Code successfully updated.'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Error updating data: " . $stmt->error . "'); window.location.href = 'dashboard.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid End Time Code or Session ID.'); window.location.href = 'dashboard.php';</script>";
    }
}

$conn->close();
?>