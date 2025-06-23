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
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Student List</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="student_list.php">
              <i class="bi bi-people"></i><span>Student Enrolled List</span>
            </a>
          </li>
          <li>
            <a href="st_cleaning.php">
              <i class="bi bi-people"></i><span>Student Cleaning Time</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Staff Details</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="teacher_list.php">
              <i class="bi bi-people"></i><span>Teacher List</span>
            </a>
          </li>
          <li>
            <a href="officer_list.php">
              <i class="bi bi-people"></i><span>Pending Officer Account</span>
            </a>
          </li>
          <li>
            <a href="app_officer_list.php">
              <i class="bi bi-people"></i><span>Approved Officer Account</span>
            </a>
          </li>
          <li>
            <a href="den_officer_list.php">
              <i class="bi bi-people"></i><span>Denied Officer Account</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-geo-alt"></i><span>Assign Area</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="a_area.php">
              <i class="bi bi-circle"></i><span>Assign Area List</span>
            </a>
          </li>
          <li>
            <a href="ass_student.php">
              <i class="bi bi-circle"></i><span>Assign Student Officer</span>
            </a>
          </li>
        </ul>
      </li>
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
                        <?php 
include "conn.php"; 

// Ensure the session is started and the co_id is available
if (isset($_SESSION['co_id'])) {
    $co_id = $_SESSION['co_id'];  // Get the logged-in user's co_id

    // Query to count students with the same co_id (n_id) who are enrolled
    $query = "
        SELECT COUNT(*) as rowCount 
        FROM students 
        WHERE status = 'Enrolled' 
        AND n_id = $co_id"; // Match the student's n_id with the logged-in co_id

    // Execute the query
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
?>
<!-- Sales Card -->
<div class="col-lg-4">
  <div class="card info-card sales-card">
    <div class="card-body">
      <h5 class="card-title">Student Enrolled</h5>

      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-people"></i>
        </div>
        <div class="ps-3">
          <h6><?php echo $row['rowCount']; ?></h6>
        </div>
      </div>
    </div>
  </div>
</div><!-- End Sales Card -->

<?php 
    } else {
        // Error handling if query fails
        echo "Error: " . $conn->error;
    }
} else {
    // Handle the case where the user is not logged in or co_id is not available
    echo "User not logged in.";
}
?>

            <!-- Revenue Card -->
            <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM departments WHERE status = 'Available'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
            <div class="col-lg-4">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Department </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $row['rowCount']; ?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
                  <?php
include 'conn.php';

// Query to count unique t_id from t_assign table
$sql = "SELECT COUNT(DISTINCT t_id) AS rowCount FROM t_assign";
$result = mysqli_query($conn, $sql);

// Fetch the result
$row = mysqli_fetch_assoc($result);
?>

<div class="col-lg-4">
    <div class="card info-card revenue-card">
        <div class="card-body">
            <h5 class="card-title">Teacher List</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-building"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo $row['rowCount']; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
       
<?php 
include 'conn.php';

// Query to count unique t_id where status is 'Pending'
$sql = "SELECT COUNT(DISTINCT t_id) AS rowCount FROM officer WHERE status = 'Pending'";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    $pendingCount = $row['rowCount'];
} else {
    // Handle query error
    $pendingCount = "Error"; 
    echo "<script>console.error('Error: " . mysqli_error($conn) . "');</script>";
}

// Close database connection
mysqli_close($conn);
?>

<div class="col-lg-4">
    <div class="card info-card -card">
        <div class="card-body">
            <h5 class="card-title">Pending Officer Account</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo htmlspecialchars($pendingCount); ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include 'conn.php';

// Query to count unique t_id where status is 'Pending'
$sql = "SELECT COUNT(DISTINCT t_id) AS rowCount FROM officer WHERE status = 'Approved'";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    $pendingCount = $row['rowCount'];
} else {
    // Handle query error
    $pendingCount = "Error"; 
    echo "<script>console.error('Error: " . mysqli_error($conn) . "');</script>";
}

// Close database connection
mysqli_close($conn);
?>

<div class="col-lg-4">
    <div class="card info-card -card">
        <div class="card-body">
            <h5 class="card-title">Approved Officer Account</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo htmlspecialchars($pendingCount); ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include 'conn.php';

// Query to count unique t_id where status is 'Pending'
$sql = "SELECT COUNT(DISTINCT t_id) AS rowCount FROM officer WHERE status = 'Denied'";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    $pendingCount = $row['rowCount'];
} else {
    // Handle query error
    $pendingCount = "Error"; 
    echo "<script>console.error('Error: " . mysqli_error($conn) . "');</script>";
}

// Close database connection
mysqli_close($conn);
?>

<div class="col-lg-4">
    <div class="card info-card -card">
        <div class="card-body">
            <h5 class="card-title">Denied Officer Account</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo htmlspecialchars($pendingCount); ?></h6>
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