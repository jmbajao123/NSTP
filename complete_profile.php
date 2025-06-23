<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['student_id']) && isset($_SESSION['s_id'])  && isset($_SESSION['full_name'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Complete Profile - STII NSTP</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/s.png" type="image/x-icon">
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
			    <div class="col-lg-12">
			    	<div class="row">
			    		<div class="col-lg-6">
			    			<br><br><br><br><br><br><br><br><br>
			    		</div>
			    		<center>
			    			<img src="assets/images/s.png" alt="" height="260">
			    		</center>
			    	</div>
			    </div>
			    
			    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
			</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar mr-1">
                                    <!-- <img src="assets/images/avatar/avatar-s-1.png" alt="" srcset=""> -->
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $_SESSION['full_name'] ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- <a class="dropdown-item" href="#"><i data-feather="user"></i> Profile</a> -->
                                <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
			<div class="main-content container-fluid">
			    <div class="page-title">
			        <div class="row">
			            <div class="col-12 col-md-6 order-md-1 order-last">
			                <h3>Complete Profile</h3>
			                <p class="text-subtitle text-muted">Please fill up the form to continue.</p>
			            </div>
			            <div class="col-12 col-md-6 order-md-2 order-first">
			                <nav aria-label="breadcrumb" class='breadcrumb-header'>
			                    <ol class="breadcrumb">
			                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
			                        <li class="breadcrumb-item active" aria-current="page">Complete Profile </li>
			                    </ol>
			                </nav>
			            </div>
			        </div>

			    </div>
			    <!-- Basic Horizontal form layout section start -->
			    <section id="basic-horizontal-layouts">
				    <div class="row match-height">
				        <div class="col-lg-12 col-12">
					        <div class="card">
					            <div class="card-header">
					            <center>
					            	<h4 class="card-title">Student Informations</h4>
					            </center>
					            </div>
					            	<?php
// Start session (if not already started)

// Check if s_id (student ID) is stored in session
if (isset($_SESSION['s_id'])) {
    $s_id = $_SESSION['s_id'];

    // Include database connection
    include "conn.php";

    // Fetch student data along with department, course, and NSTP based on s_id
    $query = "
        SELECT students.*, departments.department_name, course.course_name, nstp.nstp_name 
        FROM students
        LEFT JOIN departments ON students.d_id = departments.d_id
        LEFT JOIN course ON students.c_id = course.c_id
        LEFT JOIN nstp ON students.n_id = nstp.n_id
        WHERE students.s_id = $s_id
    ";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Display student data and associated department, course, and NSTP information
        $full_name = $row['full_name'];
        $student_id = $row['student_id'];
        $address = $row['address'];
        $email = $row['email'];
        $gender = $row['gender'];
        $section = $row['section'];
        $contact_number = $row['contact_number'];
        $age = $row['age'];
        $status = $row['status'];
        $birthdate = $row['birthdate'];
        $civil_status = $row['civil_status'];
        $date = $row['date'];
        $profile_picture = $row['profile_picture'];
        $valid_id = $row['valid_id'];
        $department_name = $row['department_name'];
        $course_name = $row['course_name'];
        $nstp_name = $row['nstp_name'];

        ?>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="complete_functions.php" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-4 form-group">
                                <label>Full Name</label>
                                <input type="text" id="full_name" class="form-control" name="full_name" placeholder="Full Name" value="<?php echo $full_name; ?>" readonly>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Student ID</label>
                                <input type="text" id="student_id" class="form-control" name="student_id" placeholder="Student ID" value="<?php echo $student_id; ?>" readonly>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Department Name</label>
                                <input type="text" id="d_id" class="form-control" name="d_id" placeholder="Department Name" value="<?php echo $department_name; ?>" readonly>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-4 form-group">
                                <label>Course Name</label>
                                <input type="text" id="c_id" class="form-control" name="c_id" placeholder="Course Name" value="<?php echo $course_name; ?>" readonly>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Section</label>
                                <input type="text" id="section" class="form-control" name="section" placeholder="Section" value="<?php echo $section; ?>" readonly>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Program</label>
                                <input type="text" id="n_id" class="form-control" name="n_id" placeholder="Program" value="<?php echo $nstp_name; ?>" readonly>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-4 form-group">
                                <label>Birthdate</label>
                                <input type="date" id="birthdate" class="form-control" name="birthdate" placeholder="Birthdate" value="<?php echo $birthdate; ?>" required>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Age</label>
                                <input type="number" id="age" class="form-control" name="age" placeholder="Age" value="<?php echo $age; ?>" readonly>
                            </div>
                            <?php include 'date_age.php'; ?>
                            <div class="col-lg-4 form-group">
                                <label>Gender</label>
                                <select class="form-select" name="gender" id="gender" required>
                                    <option selected disabled>Choose a Gender</option>
                                    <option value="Male" <?php echo ($gender == "Male" ? "selected" : ""); ?>>Male</option>
                                    <option value="Female" <?php echo ($gender == "Female" ? "selected" : ""); ?>>Female</option>
                                    <option value="Other" <?php echo ($gender == "Other" ? "selected" : ""); ?>>Other</option>
                                </select>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-4 form-group">
                                <label>Civil Status</label>
                                <select class="form-select" name="civil_status" id="civil_status" required>
                                    <option selected disabled>Choose a Civil Status</option>
                                    <option value="Married" <?php echo ($civil_status == "Married" ? "selected" : ""); ?>>Married</option>
                                    <option value="Single" <?php echo ($civil_status == "Single" ? "selected" : ""); ?>>Single</option>
                                    <option value="Divorced" <?php echo ($civil_status == "Divorced" ? "selected" : ""); ?>>Divorced</option>
                                    <option value="Widowed" <?php echo ($civil_status == "Widowed" ? "selected" : ""); ?>>Widowed</option>
                                </select>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Email</label>
                                <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Contact Number</label>
                                <input type="number" id="contact_number" class="form-control" name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>" required>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-4 form-group">
                                <label>Address</label>
                                <input type="text" id="address" class="form-control" name="address" placeholder="Address" value="<?php echo $address; ?>" required>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Profile Picture</label>
                                <input type="file" id="profile_picture" class="form-control" name="profile_picture" value="" required>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>School ID</label>
                                <input type="file" id="valid_id" class="form-control" name="valid_id" value="" required>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        echo "<center>No data available for this student ID</center>";
    }
} else {
    echo "<center>No student ID found in session. Please log in.</center>";
}
?>
					            </div>
					        </div>
				        </div>
				    </div>
			    </section>
			    <!-- // Basic Horizontal form layout section end -->
			</div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-left">
                        <p>2025  &copy; STII NSTP CLEANING ATTENDANCE</p>
                    </div>
                    <div class="float-right">
                        <p>Develop <span class='text-danger'><i data-feather="heart"></i></span> by : <a href="#">Unknown</a></p>
                    </div>
                </div>
            </footer>
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
    header("Location: login.php");
    exit();
}

?>