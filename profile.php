<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['student_id']) && isset($_SESSION['s_id']) && ($_SESSION['full_name']) ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Student - STII NSTP</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/s.png" type="image/x-icon">
</head>
<body>
    <div id="app">
        <?php include 'Include/sidebar.php'; ?>
        <div id="main">
            <?php include 'Include/header.php'; ?>
            
			<div class="main-content container-fluid">
			    <div class="page-title">
			        <h3>Profile</h3>
			    </div>
			    <section class="section">
			        <div class="row">
			            <center>
			            	<div class="col-lg-8">
				                <div class="col-lg-12">
				                	<div class="row">
				                		<div class="card widget-todo">
						                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
						                        <h4 class="card-title d-flex">
						                            <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Profile Information
						                        </h4>
						                    </div>
						                    <div class="card-body px-0 py-1">
						                    	<div class="col-lg-12">
						                    		<div class="row">
						                    			<div class="col-lg-6">
														    <label>
														        <?php
														        include 'conn.php';

														        if (isset($_SESSION['student_id'])) {
														            $student_id = $_SESSION['student_id'];

														            // Query to fetch student details with joins
														            $query = "
														                SELECT s.student_id, s.full_name, s.section, s.address, s.gender, 
														                       s.birthdate, s.age, s.civil_status, s.profile_picture, 
														                       s.valid_id, s.contact_number, 
														                       d.department_name, 
														                       c.course_name, 
														                       n.nstp_name
														                FROM students s
														                LEFT JOIN departments d ON s.d_id = d.d_id
														                LEFT JOIN course c ON s.c_id = c.c_id
														                LEFT JOIN nstp n ON s.n_id = n.n_id
														                WHERE s.student_id = '$student_id'";

														            $result = mysqli_query($conn, $query);

														            if ($result && mysqli_num_rows($result) > 0) {
														                $row = mysqli_fetch_assoc($result);

														                echo "<strong>Student ID:</strong> " . htmlspecialchars($row['student_id']) . "<br>";
														                echo "<strong>Full Name:</strong> " . htmlspecialchars($row['full_name']) . "<br>";
														                echo "<strong>Department:</strong> " . htmlspecialchars($row['department_name']) . "<br>";
														                echo "<strong>Course:</strong> " . htmlspecialchars($row['course_name']) . "<br>";
														                echo "<strong>Section:</strong> " . htmlspecialchars($row['section']) . "<br>";
														                echo "<strong>Address:</strong> " . htmlspecialchars($row['address']) . "<br>";
														                echo "<strong>NSTP Name:</strong> " . htmlspecialchars($row['nstp_name']) . "<br>";
														                echo "<strong>Gender:</strong> " . htmlspecialchars($row['gender']) . "<br>";
														                echo "<strong>Birthdate:</strong> " . htmlspecialchars($row['birthdate']) . "<br>";
														                echo "<strong>Age:</strong> " . htmlspecialchars($row['age']) . "<br>";
														                echo "<strong>Civil Status:</strong> " . htmlspecialchars($row['civil_status']) . "<br>";
														                echo "<strong>Contact Number:</strong> " . htmlspecialchars($row['contact_number']) . "<br>";

														                // Display profile picture
														                if (!empty($row['profile_picture'])) {
														                    echo "<strong>Profile Picture:</strong><br> 
														                          <img src='uploads/" . htmlspecialchars($row['profile_picture']) . "' width='100' height='100'><br>";
														                } else {
														                    echo "<strong>Profile Picture:</strong> Not uploaded<br>";
														                }

														                // Display valid ID
														                if (!empty($row['valid_id'])) {
														                    echo "<strong>Valid ID:</strong><br> 
														                          <img src='uploads/" . htmlspecialchars($row['valid_id']) . "' width='100' height='100'><br>";
														                } else {
														                    echo "<strong>Valid ID:</strong> Not uploaded<br>";
														                }
														            } else {
														                echo "Student data not found.";
														            }
														        } else {
														            echo "No student is signed in.";
														        }
														        ?>
														    </label>
														</div>
						                    		</div>
						                    	</div>
						                    </div>
						                </div>
				                	</div>
				                </div>
				            </div>
			            </center>
			        </div>
			    </section>
			</div>

            <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>STII NSTP</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by : <a href="#">Unknown</a>
    </div>
  </footer>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>
</html>
<?php 
}else{
    header("Location: login.php");
    exit();
}

?>