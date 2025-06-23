<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['o_id'], $_POST['action'], $_POST['co_id'])) {
    $o_id = intval($_POST['o_id']);
    $co_id = intval($_POST['co_id']); // Get the currently logged-in officer ID
    $action = $_POST['action'];

    // Determine new status and redirect page
    if ($action === "approved") {
        $new_status = "Approved";
        $redirect_page = "app_officer_list.php";
        $message = "Officer account has been approved successfully!";
    } elseif ($action === "denied") {
        $new_status = "Denied";
        $redirect_page = "den_officer_list.php";
        $message = "Officer account has been denied.";
    } else {
        exit("Invalid action.");
    }

    // Prepare the update query to include co_id
    $sql = "UPDATE officer SET status = ?, co_id = ? WHERE o_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $new_status, $co_id, $o_id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Show alert and redirect to the correct page
        echo "<script>alert('$message');</script>";
        echo "<script>window.location='$redirect_page';</script>";
        exit();
    } else {
        // Show alert for error and redirect
        echo "<script>alert('Error updating status.');</script>";
        echo "<script>window.location='officer_list.php';</script>";
        exit();
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn);
?>
