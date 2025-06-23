<?php
session_start();
// Database connection
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $et = isset($_POST['et']) ? intval($_POST['et']) : 0;
    $s_id = isset($_SESSION['s_id']) ? intval($_SESSION['s_id']) : 0; // Assuming s_id is stored in session
    
    if ($et > 0 && $s_id > 0) {
        // Check if the value exists in render_time table
        $check_query = "SELECT rt_id, assign_off_id, area_id, o_id FROM render_time WHERE et = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("i", $et);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $rt_id = $row['rt_id'];
            $assign_off_id = $row['assign_off_id'];
            $area_id = $row['area_id'];
            $o_id = $row['o_id'];
            
            // Check if the et and s_id combination already exists in st_render
            $duplicate_check = "SELECT * FROM end_code WHERE et = ? AND s_id = ?";
            $stmt = $conn->prepare($duplicate_check);
            $stmt->bind_param("ii", $et, $s_id);
            $stmt->execute();
            $dup_result = $stmt->get_result();
            
            if ($dup_result->num_rows > 0) {
                echo "<script>alert('You have already completed the End Time Code Attendance.'); window.location.href = 'dashboard.php';</script>";
            } else {
                // Insert the values into st_render table
                $insert_query = "INSERT INTO end_code (et, s_id, rt_id, assign_off_id, area_id, o_id) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("iiiiii", $et, $s_id, $rt_id, $assign_off_id, $area_id, $o_id);
                
                if ($stmt->execute()) {
                    echo "<script>alert('End Time Code Attendance Successfully.'); window.location.href = 'dashboard.php';</script>";
                } else {
                    echo "<script>alert('Error inserting data: " . $conn->error . "'); window.location.href = 'dashboard.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Invalid End Time Code.'); window.location.href = 'dashboard.php';</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Invalid End Time Code or Session ID.'); window.location.href = 'dashboard.php';</script>";
    }
}

$conn->close();
?>