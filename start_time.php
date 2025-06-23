<?php
session_start();
// Database connection
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $st = isset($_POST['st']) ? intval($_POST['st']) : 0;
    $s_id = isset($_SESSION['s_id']) ? intval($_SESSION['s_id']) : 0; // Assuming s_id is stored in session
    
    if ($st > 0 && $s_id > 0) {
        // Check if the value exists in render_time table
        $check_query = "SELECT rt_id, assign_off_id, area_id, o_id FROM render_time WHERE st = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("i", $st);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $rt_id = $row['rt_id'];
            $assign_off_id = $row['assign_off_id'];
            $area_id = $row['area_id'];
            $o_id = $row['o_id'];
            
            // Check if the st and s_id combination already exists in st_render
            $duplicate_check = "SELECT * FROM start_code WHERE st = ? AND s_id = ?";
            $stmt = $conn->prepare($duplicate_check);
            $stmt->bind_param("ii", $st, $s_id);
            $stmt->execute();
            $dup_result = $stmt->get_result();
            
            if ($dup_result->num_rows > 0) {
                echo "<script>alert('You have already completed the Start Time Code Attendance.'); window.location.href = 'dashboard.php';</script>";
            } else {
                // Insert the values into st_render table
                $insert_query = "INSERT INTO start_code (st, s_id, rt_id, assign_off_id, area_id, o_id) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("iiiiii", $st, $s_id, $rt_id, $assign_off_id, $area_id, $o_id);
                
                if ($stmt->execute()) {
                    echo "<script>alert('Start Time Code Attendance Successfully.'); window.location.href = 'dashboard.php';</script>";
                } else {
                    echo "<script>alert('Error inserting data: " . $conn->error . "'); window.location.href = 'dashboard.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Invalid Start Time Code.'); window.location.href = 'dashboard.php';</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Invalid Start Time Code or Session ID.'); window.location.href = 'dashboard.php';</script>";
    }
}

$conn->close();
?>