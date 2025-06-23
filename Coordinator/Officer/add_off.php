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
      <h1>Add Officer Account</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Add Officer Account</li>
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
              		<h5 class="card-title">Officer Name
                  </h5>
              	</div>
              </div>
              <div class="col-lg-12">
                <form method="post" action="add_officer_func.php">
                  <div class="row">
                  	<?php
include 'conn.php';

// Ensure session variable exists
if (!isset($_SESSION['t_id'])) {
    die("User not logged in.");
}

$t_id = $_SESSION['t_id'];

// Fetch departments assigned to the logged-in teacher
$departmentsQuery = "SELECT DISTINCT d.d_id, d.department_name 
                     FROM t_assign ta
                     INNER JOIN departments d ON ta.d_id = d.d_id
                     WHERE ta.t_id = ?";
$stmt = mysqli_prepare($conn, $departmentsQuery);
mysqli_stmt_bind_param($stmt, "i", $t_id);
mysqli_stmt_execute($stmt);
$departmentsResult = mysqli_stmt_get_result($stmt);

$departmentsData = [];
while ($row = mysqli_fetch_assoc($departmentsResult)) {
    $departmentsData[$row['d_id']] = $row['department_name'];
}

// Fetch courses based on department (ensuring the d_id is from the course table)
$coursesQuery = "SELECT DISTINCT c.c_id, c.course_name, c.d_id 
                 FROM t_assign ta
                 INNER JOIN course c ON ta.c_id = c.c_id
                 WHERE ta.t_id = ?";
$stmt = mysqli_prepare($conn, $coursesQuery);
mysqli_stmt_bind_param($stmt, "i", $t_id);
mysqli_stmt_execute($stmt);
$coursesResult = mysqli_stmt_get_result($stmt);

$coursesData = [];
while ($row = mysqli_fetch_assoc($coursesResult)) {
    $coursesData[$row['d_id']][] = [
        'c_id' => $row['c_id'],
        'course_name' => $row['course_name']
    ];
}

// Fetch enrolled sections
$sectionQuery = "SELECT DISTINCT section FROM students WHERE status = 'Enrolled'";
$sectionResult = mysqli_query($conn, $sectionQuery);
$sections = [];
while ($row = mysqli_fetch_assoc($sectionResult)) {
    $sections[] = $row['section'];
}

// Fetch students based on assigned department & courses
$studentsQuery = "SELECT DISTINCT s.s_id, s.full_name, s.d_id, s.c_id 
                  FROM students s
                  INNER JOIN t_assign ta ON s.d_id = ta.d_id AND s.c_id = ta.c_id
                  WHERE s.status = 'Enrolled' AND ta.t_id = ?";
$stmt = mysqli_prepare($conn, $studentsQuery);
mysqli_stmt_bind_param($stmt, "i", $t_id);
mysqli_stmt_execute($stmt);
$studentsResult = mysqli_stmt_get_result($stmt);

$studentsData = [];
while ($row = mysqli_fetch_assoc($studentsResult)) {
    $studentsData[$row['d_id']][$row['c_id']][] = [
        's_id' => $row['s_id'],
        'full_name' => $row['full_name']
    ];
}
?>

<div class="col-lg-6">
    <center>
        <label><h4>Department Name</h4></label>
    </center>
    <select class="form-select" name="department_name" id="department_name">
        <option value="">Choose a Department</option>
        <?php foreach ($departmentsData as $d_id => $department_name) : ?>
            <option value="<?php echo htmlspecialchars($d_id); ?>">
                <?php echo htmlspecialchars($department_name); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="col-lg-6">
    <center>
        <label><h4>Course Name</h4></label>
    </center>
    <select class="form-select" name="course_name" id="course_name">
        <option value="">Choose a Course</option>
    </select>
</div>

<div class="col-lg-6">
    <center>
        <label><h4>Section</h4></label>
    </center>
    <select class="form-select" name="section" required>
        <option value="" selected disabled>Select a Section</option>
        <?php if (!empty($sections)) : ?>
            <?php foreach ($sections as $section) : ?>
                <option value="<?= htmlspecialchars($section); ?>">
                    <?= htmlspecialchars($section); ?>
                </option>
            <?php endforeach; ?>
        <?php else : ?>
            <option disabled>No enrolled sections found</option>
        <?php endif; ?>
    </select>
</div>

<div class="col-lg-6">
    <center>
        <label><h4>Student Name</h4></label>
    </center>
    <select class="form-select" id="full_name" name="full_name" required>
        <option value="" selected disabled>Choose a Student</option>
    </select>
</div>

<div class="col-lg-12">
    <br>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var coursesData = <?php echo json_encode($coursesData); ?>;
    var studentsData = <?php echo json_encode($studentsData); ?>;
    var departmentSelect = document.getElementById("department_name");
    var courseSelect = document.getElementById("course_name");
    var studentSelect = document.getElementById("full_name");

    departmentSelect.addEventListener("change", function () {
        var d_id = this.value;
        courseSelect.innerHTML = '<option value="">Choose a Course</option>'; // Reset courses dropdown
        studentSelect.innerHTML = '<option value="">Choose a Student</option>'; // Reset students dropdown

        if (coursesData.hasOwnProperty(d_id)) {
            coursesData[d_id].forEach(function (course) {
                var option = document.createElement("option");
                option.value = course.c_id;
                option.textContent = course.course_name;
                courseSelect.appendChild(option);
            });
        }
    });

    courseSelect.addEventListener("change", function () {
        var d_id = departmentSelect.value;
        var c_id = this.value;
        studentSelect.innerHTML = '<option value="">Choose a Student</option>'; // Reset students dropdown

        if (studentsData.hasOwnProperty(d_id) && studentsData[d_id].hasOwnProperty(c_id)) {
            studentsData[d_id][c_id].forEach(function (student) {
                var option = document.createElement("option");
                option.value = student.s_id;
                option.textContent = student.full_name;
                studentSelect.appendChild(option);
            });
        }
    });
});
</script>




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