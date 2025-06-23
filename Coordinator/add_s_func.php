<?php
session_start();
include 'conn.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure user is logged in
    if (!isset($_SESSION['co_id'])) {
        die("Access Denied. Please log in.");
    }

    $co_id = $_SESSION['co_id'];
    $area_id = $_POST['area_id'];
    $o_id = $_POST['o_id'];
    $status = $_POST['status'];
    $date = date("Y-m-d H:i:s"); // Current timestamp

    // Validate input
    if (empty($area_id) || empty($o_id) || empty($status)) {
        die("All fields are required.");
    }

    // Get `n_id` of the logged-in coordinator
    $query = "SELECT n_id FROM coordinator WHERE co_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $co_id);
    $stmt->execute();
    $stmt->bind_result($n_id);
    $stmt->fetch();
    $stmt->close();

    if (empty($n_id)) {
        die("Coordinator data not found.");
    }

    // Insert into assign_off table with co_id and date
    $insertQuery = "INSERT INTO assign_off (area_id, o_id, status, n_id, co_id, date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iisiss", $area_id, $o_id, $status, $n_id, $co_id, $date);

    if ($stmt->execute()) {
        echo "<script>alert('Area successfully assigned to Officer!'); window.location.href='ass_student.php';</script>";
    } else {
        echo "<script>alert('Error: Could not assign area.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid Request.";
}
?>
