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
                <h3>Course</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
	<!-- Table head options start -->
	    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Course Details</h4>
            </div>
            <div class="card-body">
<?php
// Assuming the database connection is already established
// Fetch the course data for the specific course
$c_id = $_GET['c_id']; // Get c_id from query parameter or set it according to your requirement

// Example query to fetch the course details
$sql = "SELECT c.course_name, c.d_id, c.status, c.c_id 
        FROM course c
        WHERE c.c_id = '$c_id'";

$result = mysqli_query($conn, $sql);

// Check if a result is returned
if ($row = mysqli_fetch_assoc($result)) {
    // Fetch the course data
    $course_name = $row['course_name'];
    $d_id = $row['d_id']; // Get the department ID of the current course
    $status = $row['status'];
    $c_id = $row['c_id'];
} else {
    // Handle error when no data is found, like redirecting or showing an error message
    echo "No data found for the specified course.";
    exit;
}

// Query to fetch all departments
$departments_sql = "SELECT d_id, department_name FROM departments";
$departments_result = mysqli_query($conn, $departments_sql);
?>

<!-- Form to update department -->
<form method="post" action="update_course.php">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" class="form-control" id="course_name" placeholder="Enter the Course Name" name="course_name" value="<?php echo htmlspecialchars($course_name); ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="department_name">Department Name</label>
                <select class="form-select" name="department_name" id="department_name" required>
                    <option value="">Select Department</option>
                    <?php
                    // Loop through all departments and create an option for each
                    while ($department = mysqli_fetch_assoc($departments_result)) {
                        $selected = ($d_id == $department['d_id']) ? 'selected' : '';
                        echo "<option value=\"" . $department['d_id'] . "\" $selected>" . htmlspecialchars($department['department_name']) . "</option>";
                    }
                    ?>
                </select>
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
    <input type="hidden" name="c_id" value="<?php echo $c_id; ?>"> <!-- Hidden field to pass the course ID -->
</form>






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