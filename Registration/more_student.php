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
                <h3>Student</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
	<!-- Table head options start -->
	    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Student Informations</h4>
            </div>
            <div class="card-body">
                <?php
// Include the database connection
include "conn.php";

// Check if the s_id is set in the URL (edit mode)
if (isset($_GET['s_id'])) {
    $s_id = intval($_GET['s_id']);  // Ensure the s_id is an integer to avoid SQL injection.

    // Fetch the student data based on s_id
    $sql = "SELECT * FROM students WHERE s_id = $s_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);  // Fetch the student data.
        $full_name = $row['full_name'];
        $student_id = $row['student_id'];
        $status = $row['status'];
        $section = $row['section'];
        $n_id = $row['n_id']; // Program ID of the student
        $d_id = $row['d_id']; // Department ID
        $c_id = $row['c_id']; // Course ID of the student
    } else {
        // Handle case if no student is found with the provided s_id.
        echo "Student not found.";
        exit;
    }
} else {
    // Handle case if s_id is not provided (invalid access).
    echo "Invalid Student ID.";
    exit;
}

// Fetch the program name from the nstp table based on n_id
$program_sql = "SELECT nstp_name FROM nstp WHERE n_id = $n_id";
$program_result = mysqli_query($conn, $program_sql);
$program_name = "";

if ($program_result && mysqli_num_rows($program_result) > 0) {
    $program_row = mysqli_fetch_assoc($program_result);
    $program_name = $program_row['nstp_name'];
}

// Fetch the department name from the departments table based on d_id
$department_sql = "SELECT department_name FROM departments WHERE d_id = $d_id";
$department_result = mysqli_query($conn, $department_sql);
$department_name = "";

if ($department_result && mysqli_num_rows($department_result) > 0) {
    $department_row = mysqli_fetch_assoc($department_result);
    $department_name = $department_row['department_name'];
}

// Fetch the course name from the course table based on c_id
$course_sql = "SELECT course_name FROM course WHERE c_id = $c_id";
$course_result = mysqli_query($conn, $course_sql);
$course_name = "";

if ($course_result && mysqli_num_rows($course_result) > 0) {
    $course_row = mysqli_fetch_assoc($course_result);
    $course_name = $course_row['course_name'];
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Form to view student details -->
<form method="post" action="update_coordinator.php">
    <div class="row">
        <div class="col-lg-12"><br></div>
        
        <!-- Display Student Details -->
        <div class="col-lg-4">
            <div class="form-group">
                <label for="student_full_name">Student Name</label>
                <input type="text" class="form-control" id="student_full_name" placeholder="Enter the Student Name" name="student_full_name" value="<?= htmlspecialchars($full_name); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" class="form-control" id="student_id" placeholder="Enter the Student ID" name="student_id" value="<?= htmlspecialchars($student_id); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="department_name">Department</label>
                <input type="text" class="form-control" id="department_name" placeholder="Department" name="department_name" value="<?= htmlspecialchars($department_name); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        
        <div class="col-lg-4">
            <div class="form-group">
                <label for="course">Course</label>
                <input type="text" class="form-control" id="course" placeholder="Enter the Course" name="course" value="<?= htmlspecialchars($course_name); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="section">Section</label>
                <input type="text" class="form-control" id="section" placeholder="Enter the Section" name="section" value="<?= htmlspecialchars($section); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="n_d">Program Enrolled</label>
                <input type="text" class="form-control" id="n_d" placeholder="Program" name="n_d" value="<?= htmlspecialchars($program_name); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>

        <div class="col-lg-12"><br>
            <a href="add_coordinator.php" class="btn btn-outline-dark">Back</a>
        </div>
    </div>

    <!-- Hidden field to pass the student ID -->
    <input type="hidden" name="s_id" value="<?= $s_id; ?>">
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

?>Student