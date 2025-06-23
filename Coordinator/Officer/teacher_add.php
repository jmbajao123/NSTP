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

  <title>Teacher List - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1>Teacher List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Teacher List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              	<div class="col-lg-12">
              		<h5 class="card-title">Teacher List
                  </h5>
              	</div>
              </div>
              <div class="col-lg-12">
                <form>
                  <div class="row">
                    <?php
                      // Include database connection
                      include "conn.php"; // Make sure you have a connection to your database

                      // Query to get active teachers
                      $query = "SELECT t_id, full_name FROM teacher WHERE status = 'active'";
                      $result = mysqli_query($conn, $query);

                      // Check for query execution success
                      if (!$result) {
                          die("Error fetching teachers: " . mysqli_error($conn));
                      }
                      ?>

                      <div class="col-lg-6">
                          <center>
                            <label>
                            <h4>Teacher Name</h4>
                          </label>
                          </center>
                          <select class="form-select" name="t_id">
                              <option value="" selected disabled>Choose a Teacher</option>
                              <?php
                              // Populate the dropdown with teachers from the database
                              while ($row = mysqli_fetch_assoc($result)) {
                                  $t_id = $row['t_id'];  // Teacher ID (can be used to store the value)
                                  $full_name = $row['full_name'];  // Teacher's name to display
                                  echo "<option value='$t_id'>$full_name</option>";
                              }
                              ?>
                          </select>
                      </div>

                      <?php
                      // Close the database connection
                      mysqli_close($conn);
                    ?>
                    <?php
                      // Include database connection
                      include "conn.php"; // Ensure you have a connection to your database

                      // Query to get available departments
                      $query = "SELECT d_id, department_name FROM departments WHERE status = 'available'";
                      $result = mysqli_query($conn, $query);

                      // Check for query execution success
                      if (!$result) {
                          die("Error fetching departments: " . mysqli_error($conn));
                      }
                      ?>

                      <div class="col-lg-6">
                          <center>
                              <label>
                                  <h4>Department Name</h4>
                              </label>
                          </center>
                          <select class="form-select" name="d_id">
                              <option value="" selected disabled>Choose a Department</option>
                              <?php
                              // Populate the dropdown with departments from the database
                              while ($row = mysqli_fetch_assoc($result)) {
                                  $d_id = $row['d_id'];  // Department ID (to be used in the value attribute)
                                  $department_name = $row['department_name'];  // Department name to display
                                  echo "<option value='$d_id'>$department_name</option>";
                              }
                              ?>
                          </select>
                      </div>

                      <?php
                      // Close the database connection
                      mysqli_close($conn);
                    ?>
                    <div class="col-lg-12">
                      <br>
                    </div>
                      <?php
                        // Include database connection
                        include "conn.php"; // Ensure you have a connection to your database

                        // Query to get all courses with status 'Available'
                        $query = "SELECT c_id, course_name FROM course WHERE status = 'Available'"; // Filter by status = 'Available'
                        $result = mysqli_query($conn, $query);

                        // Check for query execution success
                        if (!$result) {
                            die("Error fetching courses: " . mysqli_error($conn));
                        }
                        ?>

                        <div class="col-lg-6">
                            <center>
                                <label>
                                    <h4>Course Name</h4>
                                </label>
                            </center>
                            <select class="form-select" name="c_id">
                                <option value="">Choose a Course Name</option>
                                <?php
                                // Populate the dropdown with courses from the database
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $c_id = $row['c_id'];  // Course ID (to be used in the value attribute)
                                    $course_name = $row['course_name'];  // Course name to display
                                    echo "<option value='$c_id'>$course_name</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <?php
                        // Close the database connection
                        mysqli_close($conn);
                      ?>
                  </div>
                </form>
              </div>
              <!-- End Primary Color Bordered Table -->

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