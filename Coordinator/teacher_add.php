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
      <h1>Assign Teacher</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Assign Teacher</li>
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
              		<h5 class="card-title">Assign Teacher
                  </h5>
              	</div>
              </div>
              <div class="col-lg-12">
                <form method="post" action="t_assign.php">
                  <div class="row">
                      <?php
                      include "conn.php"; // Include database connection once

                      // Fetch active teachers
                      $teacherQuery = "SELECT t_id, full_name FROM teacher WHERE status = 'active'";
                      $teacherResult = mysqli_query($conn, $teacherQuery);
                      ?>

                      <center>
                          <div class="col-lg-6">
                              <center>
                                  <label><h4>Teacher Name</h4></label>
                              </center>
                              <select class="form-select" name="t_id" required>
                                  <option value="" selected disabled>Choose a Teacher</option>
                                  <?php while ($row = mysqli_fetch_assoc($teacherResult)) : ?>
                                      <option value="<?= htmlspecialchars($row['t_id']); ?>"><?= htmlspecialchars($row['full_name']); ?></option>
                                  <?php endwhile; ?>
                              </select>
                          </div>
                      </center>

                      <div class="col-lg-12"><br></div>

                      <!-- Department Selection -->
                      <div class="col-lg-6">
                          <center>
                              <label><h4>Department Name</h4></label>
                          </center>
                          <?php
                          // Fetch available departments
                          $deptQuery = "SELECT d_id, department_name FROM departments WHERE status = 'Available'";
                          $deptResult = mysqli_query($conn, $deptQuery);

                          if (mysqli_num_rows($deptResult) > 0):
                              while ($row = mysqli_fetch_assoc($deptResult)): ?>
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="d_id[]" value="<?= htmlspecialchars($row['d_id']); ?>" id="dept_<?= htmlspecialchars($row['d_id']); ?>">
                                      <label class="form-check-label" for="dept_<?= htmlspecialchars($row['d_id']); ?>">
                                          <?= htmlspecialchars($row['department_name']); ?>
                                      </label>
                                  </div>
                              <?php endwhile;
                          else: ?>
                              <p>No available departments.</p>
                          <?php endif; ?>
                      </div>

                      <!-- Course Selection -->
                      <div class="col-lg-6">
                          <center>
                              <label><h4>Course Name</h4></label>
                          </center>
                          <?php
                          // Fetch available courses
                          $courseQuery = "SELECT c_id, course_name FROM course WHERE status = 'Available'";
                          $courseResult = mysqli_query($conn, $courseQuery);

                          if (mysqli_num_rows($courseResult) > 0):
                              while ($row = mysqli_fetch_assoc($courseResult)): ?>
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="c_id[]" value="<?= htmlspecialchars($row['c_id']); ?>" id="course_<?= htmlspecialchars($row['c_id']); ?>">
                                      <label class="form-check-label" for="course_<?= htmlspecialchars($row['c_id']); ?>">
                                          <?= htmlspecialchars($row['course_name']); ?>
                                      </label>
                                  </div>
                              <?php endwhile;
                          else: ?>
                              <p>No available courses.</p>
                          <?php endif; ?>
                      </div>

                      <div class="col-lg-12"><br></div>

                      <!-- Section Selection -->
                      <div class="col-lg-6">
                          <center>
                              <label><h4>Section</h4></label>
                          </center>
                          <?php
                          // Fetch enrolled sections
                          $sectionQuery = "SELECT DISTINCT section FROM students WHERE status = 'Enrolled'";
                          $sectionResult = mysqli_query($conn, $sectionQuery);

                          if (mysqli_num_rows($sectionResult) > 0):
                              while ($row = mysqli_fetch_assoc($sectionResult)): ?>
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="sections[]" value="<?= htmlspecialchars($row['section']); ?>" id="section_<?= htmlspecialchars($row['section']); ?>">
                                      <label class="form-check-label" for="section_<?= htmlspecialchars($row['section']); ?>">
                                          <?= htmlspecialchars($row['section']); ?>
                                      </label>
                                  </div>
                              <?php endwhile;
                          else: ?>
                              <p>No enrolled sections found.</p>
                          <?php endif; ?>
                      </div>

                      <div class="col-lg-12"><br><br><br></div>

                      <!-- Submit Buttons -->
                      <div class="col-lg-12">
                          <a href="teacher_list.php" class="btn btn-primary">Back</a>
                          <button type="submit" class="btn btn-outline-success" style="float: right;">Submit</button>
                      </div>
                  </div>
              </form>

              <?php mysqli_close($conn); ?> <!-- Close the database connection after usage -->

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