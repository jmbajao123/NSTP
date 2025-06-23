<?php
include 'conn.php';

if(isset($_POST['t_id'])){
    $t_id = $_POST['t_id'];
    $query = "SELECT email, password, contact_number FROM teacher WHERE t_id = '$t_id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    echo json_encode($data);
}
?>
