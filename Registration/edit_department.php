<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['username']) && isset($_SESSION['r_id']) && ($_SESSION['password']) ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department - STII REGISTRATION</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/s.png" >
</head>
<body>
    <div id="app">
        <?php include 'Include/sidebar.php'; ?>
        <div id="main">
            <?php include 'Include/header.php'; ?>
            
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DEPARTMENT</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Department</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
	<!-- Table head options start -->
	    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Department Details</h4>
            </div>
            <div class="card-body">
                <?php
// Include the database connection
include "conn.php";

// Check if the d_id is set in the URL (edit mode)
if (isset($_GET['d_id'])) {
    $d_id = intval($_GET['d_id']);  // Ensure the d_id is an integer to avoid SQL injection.

    // Fetch the department data based on d_id
    $sql = "SELECT * FROM departments WHERE d_id = $d_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);  // Fetch the department data.
        $department_name = $row['department_name'];
        $status = $row['status'];
    } else {
        // Handle case if no department is found with the provided d_id.
        echo "Department not found.";
        exit;
    }
} else {
    // Handle case if d_id is not provided (invalid access).
    echo "Invalid department ID.";
    exit;
}
?>

<!-- Form to update department -->
<form method="post" action="update_department.php">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="department_name">Department Name</label>
                <input type="text" class="form-control" id="department_name" placeholder="Enter the Department Name" name="department_name" value="<?php echo htmlspecialchars($department_name); ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="available" <?php echo ($status == 'available') ? 'selected' : ''; ?>>Available</option>
                    <option value="unavailable" <?php echo ($status == 'unavailable') ? 'selected' : ''; ?>>Unavailable</option>
                </select>
            </div>
        </div>
        <div class="col-lg-12"><br>
            <button style="float: right;" class="btn btn-outline-success" type="submit">
                Update
            </button>
        </div>
    </div>
    <input type="hidden" name="d_id" value="<?php echo $d_id; ?>"> <!-- Hidden field to pass the department ID -->
</form>

<?php
// Close the database connection
mysqli_close($conn);
?>

            </div>
        </div>
    </div>
	<!-- Table head options end -->
	<?php include 'Include/footer.php'; ?>
            
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>
</html>

<?php 
}else{
    header("Location: sign_in.php");
    exit();
}

?>