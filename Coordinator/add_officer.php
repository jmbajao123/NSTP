<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['email']) && isset($_SESSION['co_id']) && ($_SESSION['password']) ) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Officer - STII CWTS CLEANING ATTENDANCE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/s.png" rel="icon">
  <link href="assets/img/s.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php include 'Include/header.php'; ?>
<?php include 'Include/sidebar.php'; ?>

   <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Officer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Add Officer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Officer Information</h5>
              	<form action="add_staff.php" method="post" enctype="multipart/form-data">
              		<div class="row">
                    <div class="col-lg-6">
                      <label for="department_name">Department Name</label>
                        <select class="form-select" id="department_name" name="department_name" required>
                          <option value="" disabled selected>Select a Department</option>
                            <?php
                                                            // Include the database connection
                              include "conn.php";

                                                            // Query to fetch department data where status is 'Available'
                              $sql = "SELECT d_id, department_name FROM departments WHERE status = 'Available'";
                              $result = mysqli_query($conn, $sql);

                                                            // Loop through results and populate the dropdown
                              if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='" . htmlspecialchars($row['d_id']) . "'>" . htmlspecialchars($row['department_name']) . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No Available Departments</option>";
                                }

                                                            // Close the database connection
                                mysqli_close($conn);
                              ?>
                        </select>
                    </div>
		                <div class="col-lg-6">
                      <label for="course_name">Course Name</label>
                        <select class="form-select" id="course_name" name="course_name" required>
                          <option value="" disabled selected>Select a Course</option>
                            <?php
                                                            // Include the database connection
                              include "conn.php";

                                                            // Query to fetch department data where status is 'Available'
                              $sql = "SELECT c_id, course_name FROM course WHERE status = 'Available'";
                              $result = mysqli_query($conn, $sql);

                                                            // Loop through results and populate the dropdown
                              if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='" . htmlspecialchars($row['c_id']) . "'>" . htmlspecialchars($row['course_name']) . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No Available Departments</option>";
                                }

                                                            // Close the database connection
                                mysqli_close($conn);
                              ?>
                        </select>
                    </div>
                    <div class="col-lg-12">
                      <br>
                    </div>
                    <div class="col-lg-6">
                      <label for="section">Section</label>
                       <select class="form-select" id="section" name="section" required>
                          <option value="" disabled selected>Select a Section</option>
                          <?php
                          // Include the database connection
                          include "conn.php";

                          // Query to fetch unique sections from students table
                          $sql = "SELECT DISTINCT section FROM students";
                          $result = mysqli_query($conn, $sql);

                          // Loop through results and populate the dropdown
                          if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='" . htmlspecialchars($row['section']) . "'>" . htmlspecialchars($row['section']) . "</option>";
                              }
                          } else {
                              echo "<option value='' disabled>No Available Sections</option>";
                          }

                          // Close the database connection
                          mysqli_close($conn);
                          ?>
                      </select>

                    </div>
                    <div class="col-lg-6">
                      <label for="full_name">Students</label>
                       <select class="form-select" id="full_name" name="Students" required>
                          <option value="" disabled selected>Select a Students</option>
                          <?php
                          // Include the database connection
                          include "conn.php";

                          // Query to fetch unique sections from students table
                          $sql = "SELECT DISTINCT full_name FROM students";
                          $result = mysqli_query($conn, $sql);

                          // Loop through results and populate the dropdown
                          if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='" . htmlspecialchars($row['full_name']) . "'>" . htmlspecialchars($row['full_name']) . "</option>";
                              }
                          } else {
                              echo "<option value='' disabled>No Available Sections</option>";
                          }

                          // Close the database connection
                          mysqli_close($conn);
                          ?>
                      </select>
                    </div>
                    <div class="col-lg-12">
                      <br>
                    </div>
		                <div class="col-lg-6">
		                  <label for="email" > Email</label>
		                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter the Staff Email" required>
		                </div>
		                
		                <div class="col-lg-6">
		                  <label for="password" > Password</label>
		                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter the Staff Password" required>
		                </div>
                    <div class="col-lg-12">
                      <br>
                    </div>
		                <div class="col-lg-6">
		                  <label for="confirm_password" >Confirm Password</label>
		                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter the Staff Confirm Password" required>
		                </div>
                    <div class="col-lg-6">
                      <label for="status" >Status</label>
                      <select class="form-select" name="status" id="status">
                        <option selected disabled>Choose a Status</option>
                        <option value="Active">Active</option>
                        <option value="Inacctive">Inacctive</option>
                      </select>
                    </div>
		                <div class="text-center"><br>
		                  <button type="submit" class="btn btn-outline-primary" style="float: right;">Add Officer</button>
		                </div>
	            	</div>
	            </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php 
}else{
    header("Location: sign_in.php");
    exit();
}

?>