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
                    <a href="teacher_add.php" style="float: right;" class="btn btn-outline-primary">
                      Add Teacher
                    </a>
                  </h5><br>
              	</div><br>
              </div>
              <table class="table table-bordered border-primary">
                <thead>
                  <tr>
                    <th scope="col">Teacher Name</th>
                    <th scope="col">Deparments</th>
                    <th scope="col">Courses</th>
                    <th scope="col">Section</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
// Database connection
include 'conn.php';

// Fetch data with JOIN and GROUP_CONCAT to avoid repeating full_name
$query = "
    SELECT 
        t_assign.t_id, t_assign.status, t_assign.t_assign_id, teacher.full_name, 
        GROUP_CONCAT(DISTINCT departments.department_name SEPARATOR '| ') AS department_name, 
        GROUP_CONCAT(DISTINCT course.course_name SEPARATOR '| ') AS course_name, 
        GROUP_CONCAT(DISTINCT t_assign.section SEPARATOR '| ') AS section
    FROM t_assign
    LEFT JOIN teacher ON t_assign.t_id = teacher.t_id
    LEFT JOIN departments ON t_assign.d_id = departments.d_id
    LEFT JOIN course ON t_assign.c_id = course.c_id
    GROUP BY t_assign.t_id, t_assign.status
";
$result = mysqli_query($conn, $query);
?>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['full_name']; ?></td>
        <td><?php echo $row['department_name']; ?></td>
        <td><?php echo $row['course_name']; ?></td>
        <td><?php echo $row['section']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
          <a href="t_assign_info.php?t_assign_id=<?php echo $row['t_assign_id']; ?>" class="btn btn-outline-info">More</a>
        </td>
    </tr>
<?php endwhile; ?>

<?php
// Close connection
mysqli_close($conn);
?>



                </tbody>
              </table>
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