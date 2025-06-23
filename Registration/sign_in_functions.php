<?php
session_start();
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM registration WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['r_id'] = $row['r_id'];
        $_SESSION['password'] = $row['password'];

        echo "<script>alert('Sign In Success. Welcome to STII Registration');</script>";
        echo "<script>window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Incorrect Username or Password!');</script>";
        echo "<script>window.location='sign_in.php';</script>";
    }
    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
?>
