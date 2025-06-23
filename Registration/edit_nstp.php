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
                <h3>Program</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Program</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
	<!-- Table head options start -->
	    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Program Details</h4>
            </div>
            <div class="card-body">
            	<?php
// Include the database connection
include "conn.php";

// Check if the n_id is set in the URL (edit mode)
if (isset($_GET['n_id'])) {
    $n_id = intval($_GET['n_id']);  // Ensure the n_id is an integer to avoid SQL injection.

    // Fetch the department data based on n_id
    $sql = "SELECT * FROM nstp WHERE n_id = $n_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);  // Fetch the department data.
        $nstp_name = $row['nstp_name'];
        $status = $row['status'];
    } else {
        // Handle case if no department is found with the provided n_id.
        echo "Department not found.";
        exit;
    }
} else {
    // Handle case if n_id is not provided (invalid access).
    echo "Invalid department ID.";
    exit;
}
?>
			<!-- Form to update department -->
			<form method="post" action="update_nstp.php">
			    <div class="row">
			        <div class="col-lg-6">
			            <div class="form-group">
			                <label for="nstp_name">Program Name</label>
			                <input type="text" class="form-control" id="nstp_name" placeholder="Enter the Program Name" name="nstp_name" value="<?php echo htmlspecialchars($nstp_name); ?>" required>
			            </div>
			        </div>
			        <div class="col-lg-6">
			            <div class="form-group">
			                <label for="status">Status</label>
			                <select class="form-select" name="status" id="status" required>
			                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Available</option>
			                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Unavailable</option>
			                </select>
			            </div>
			        </div>
			        <div class="col-lg-12"><br>
			            <button style="float: right;" class="btn btn-outline-success" type="submit">
			                Update
			            </button>
			        </div>
			    </div>
			    <input type="hidden" name="n_id" value="<?php echo $n_id; ?>"> <!-- Hidden field to pass the course ID -->
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