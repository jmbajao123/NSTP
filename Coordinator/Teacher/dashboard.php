<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['email']) && isset($_SESSION['t_id']) && ($_SESSION['password']) ) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - STII CWTS CLEANING ATTENDANCE</title>
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
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="schedule.php">
          <i class="bi bi-calendar"></i>
          <span>Schedule</span>
        </a>
      </li> -->
      <!-- End Contact Page Nav -->

      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-square"></i><span>Department & Course</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="d_assign.php">
              <i class="bi bi-circle"></i><span>Department Assign</span>
            </a>
          </li>
          <li>
            <a href="c_assign.php">
              <i class="bi bi-circle"></i><span>Course Assign</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Student List</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="student_list.php">
              <i class="bi bi-people"></i><span>Student List</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Officer Details</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <!-- <li>
            <a href="add_off.php">
              <i class="bi bi-people"></i><span>Add Officer Account</span>
            </a>
          </li> -->
          <li>
            <a href="officer_list.php">
              <i class="bi bi-people"></i><span>Officers List</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-heading">
        <center>Reports</center>
      </li>
    </ul>

  </aside><!-- End Sidebar-->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
          <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
                        
          <!-- Sales Card -->
          <?php
include 'conn.php';

// Get the currently logged-in teacher ID
$t_id = $_SESSION['t_id']; // Assuming t_id is stored in session

// Fetch department names and course names assigned to the logged-in teacher
$sql = "SELECT DISTINCT d.department_name, c.course_name 
        FROM t_assign ta
        INNER JOIN departments d ON ta.d_id = d.d_id
        INNER JOIN course c ON ta.c_id = c.c_id
        WHERE ta.t_id = '$t_id'";

$result = mysqli_query($conn, $sql);
$departments = [];
$courses = [];

while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row['department_name'];
    $courses[] = $row['course_name'];
}

// Convert arrays to comma-separated strings for SQL query
$departments_str = "'" . implode("','", $departments) . "'";
$courses_str = "'" . implode("','", $courses) . "'";

// Fetch the total number of enrolled students based on assigned departments and courses
$sql = "SELECT COUNT(*) AS rowcount 
        FROM students s
        LEFT JOIN departments d ON s.d_id = d.d_id
        LEFT JOIN course c ON s.c_id = c.c_id
        WHERE s.status = 'Enrolled'
        AND d.department_name IN ($departments_str)
        AND c.course_name IN ($courses_str)";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_students = $row['rowcount'];
?>

<div class="col-lg-4">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Students Enrolled</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo $total_students; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>





          <!-- End Sales Card -->

          <?php
include 'conn.php';

// Get the currently logged-in t_id
$t_id = $_SESSION['t_id']; // Assuming t_id is stored in session

// Fetch the count of unique d_id assigned to the logged-in t_id
$sql = "SELECT COUNT(DISTINCT d_id) AS rowcount FROM t_assign WHERE t_id = '$t_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_assigned = $row['rowcount']; // Corrected key

?>

<div class="col-lg-4">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Department Assign</h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo $total_assigned; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>



          <?php
include 'conn.php';

// Get the currently logged-in t_id
$t_id = $_SESSION['t_id']; // Assuming t_id is stored in session

// Fetch the count of unique c_id assigned to the logged-in t_id
$sql = "SELECT COUNT(DISTINCT c_id) AS rowcount FROM t_assign WHERE t_id = '$t_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_assigned = $row['rowcount']; // Corrected key

?>

<div class="col-lg-4">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Course Assign</h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo $total_assigned; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>

          <?php
include 'conn.php';

// Get the currently logged-in t_id
$t_id = $_SESSION['t_id']; // Assuming t_id is stored in session

// Fetch the count of unique section assigned to the logged-in t_id
$sql = "SELECT COUNT(DISTINCT section) AS rowcount FROM t_assign WHERE t_id = '$t_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_assigned = $row['rowcount']; // Corrected key

?>

<div class="col-lg-4">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Section Assign</h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo $total_assigned; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
                    <!-- Sales Card -->
                    <?php
include 'conn.php';

// Fetch the count of rows from the officer table
$sql = "SELECT COUNT(*) AS rowcount FROM officer";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_officers = $row['rowcount']; // Get the count
?>

<div class="col-lg-4">
  <div class="card info-card sales-card">
    <div class="card-body">
      <h5 class="card-title">Officer List</h5>

      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-people"></i>
        </div>
        <div class="ps-3">
          <h6><?php echo $total_officers; ?></h6> <!-- Display the count -->
        </div>
      </div>
    </div>
  </div>
</div>


            
                        

            


          </div>
        </div><!-- End Left side columns -->

        

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