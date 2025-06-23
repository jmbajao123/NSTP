<?php
session_start();
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        return htmlspecialchars(trim(stripslashes($data)));
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // Use prepared statements to fetch user details
    $stmt = $conn->prepare("SELECT o_id, email, password FROM officer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify the password using password_hash()
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['o_id'] = $row['o_id'];
            $_SESSION['password'] = $row['password'];

            echo "<script>alert('Sign In Success. Welcome to STII NSTP Officer');</script>";
            echo "<script>window.location='Officer/dashboard.php';</script>";
        } else {
            echo "<script>alert('Incorrect Email or Password!');</script>";
            echo "<script>window.location='officer_sign_in.php';</script>";
        }
    } else {
        echo "<script>alert('Incorrect Email or Password!');</script>";
        echo "<script>window.location='officer_sign_in.php';</script>";
    }
    
    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
?>
