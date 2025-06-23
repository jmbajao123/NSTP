<?php
session_start();
include "conn.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve teacher ID
    $t_id = isset($_POST['t_id']) ? mysqli_real_escape_string($conn, $_POST['t_id']) : null;
    
    // Retrieve selected d_id, c_id, and sections
    $d_ids = isset($_POST['d_id']) ? $_POST['d_id'] : [];
    $c_ids = isset($_POST['c_id']) ? $_POST['c_id'] : [];
    $sections = isset($_POST['sections']) ? $_POST['sections'] : [];
    
    // Retrieve the currently signed-in co_id
    $co_id = isset($_SESSION['co_id']) ? mysqli_real_escape_string($conn, $_SESSION['co_id']) : null;
    
    if (!$t_id || !$co_id) {
        die("Error: Missing teacher or coordinator ID.");
    }
    
    if (empty($d_ids) || empty($c_ids) || empty($sections)) {
        die("Error: Please select at least one d_id, c_id, and section.");
    }
    
    // Insert data into t_assign table
    foreach ($d_ids as $d_id) {
        foreach ($c_ids as $c_id) {
            foreach ($sections as $section) {
                $d_id = mysqli_real_escape_string($conn, $d_id);
                $c_id = mysqli_real_escape_string($conn, $c_id);
                $section = mysqli_real_escape_string($conn, $section);
                
                $query = "INSERT INTO t_assign (t_id, d_id, c_id, section, co_id) VALUES ('$t_id', '$d_id', '$c_id', '$section', '$co_id')";
                
                if (!mysqli_query($conn, $query)) {
                    echo "Error inserting data: " . mysqli_error($conn);
                }
            }
        }
    }
    
    echo "<script>alert('Teacher successfully assigned!'); window.location.href='teacher_list.php';</script>";
}

mysqli_close($conn);
?>