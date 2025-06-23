<?php
include "conn.php"; // Include database connection

// Validate if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate `t_assign_id`
    if (!isset($_GET['t_assign_id']) || !is_numeric($_GET['t_assign_id'])) {
        echo "<script>alert('Invalid Assignment ID'); window.location.href='teacher_list.php';</script>";
        exit();
    }
    
    $t_assign_id = intval($_GET['t_assign_id']); // Convert to integer
    $t_id = isset($_POST['t_id']) ? intval($_POST['t_id']) : 0;
    
    // Ensure arrays are set before using implode
    $d_id = isset($_POST['d_id']) ? implode(",", $_POST['d_id']) : "";
    $c_id = isset($_POST['c_id']) ? implode(",", $_POST['c_id']) : "";
    $section = isset($_POST['section']) ? implode(",", $_POST['section']) : "";
    
    // Update query
    $query = "UPDATE t_assign SET t_id = ?, d_id = ?, c_id = ?, section = ? WHERE t_assign_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssi", $t_id, $d_id, $c_id, $section, $t_assign_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Assignment updated successfully'); window.location.href='teacher_list.php';</script>";
    } else {
        echo "<script>alert('Error updating assignment'); window.location.href='teacher_list.php';</script>";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href='teacher_list.php';</script>";
    exit();
}
?>
