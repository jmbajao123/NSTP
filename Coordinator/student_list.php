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

  <title>Student List - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1>Student</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Student</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              	<div class="col-lg-3">
              		<h5 class="card-title">Student List</h5>
              	</div>
              	<!-- <div class="col-lg-3"><br>
				    <select class="form-select" name="department_name" id="department_name">
				        <option>Choose a Department</option>
				        <?php
				        include "conn.php";

				        $query = "SELECT * FROM departments";
				        $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

				        if (mysqli_num_rows($result) > 0) {
				            while ($row = mysqli_fetch_assoc($result)) {
				                $department_id = htmlspecialchars($row['d_id']);
				                $department_name = htmlspecialchars($row['department_name']);
				                ?>
				                <option value="<?php echo $department_id; ?>"><?php echo $department_name; ?></option>
				                <?php
				            }
				        } else {
				            echo '<option>No Departments Available</option>';
				        }
				        ?>
				    </select>
				    <br>
				</div> -->
                <!-- <div class="col-lg-3"><br>
                    <select class="form-select" name="course_name" id="course_name">
                        <option>Choose a Course</option>
                        <?php
                        include "conn.php";

                        $query = "SELECT * FROM course";
                        $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $course_id = htmlspecialchars($row['c_id']);
                                $course_name = htmlspecialchars($row['course_name']);
                                ?>
                                <option value="<?php echo $course_id; ?>"><?php echo $course_name; ?></option>
                                <?php
                            }
                        } else {
                            echo '<option>No Course Available</option>';
                        }
                        ?>
                    </select>
                    <br>
                </div> -->
				<!-- <div class="col-lg-3"><br>
				    <select class="form-select" name="section" id="section">
				        <option>Choose a Section</option>
				        <?php
				        include "conn.php";

				        $query = "SELECT DISTINCT section FROM students WHERE section IS NOT NULL";
				        $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

				        if (mysqli_num_rows($result) > 0) {
				            while ($row = mysqli_fetch_assoc($result)) {
				                $section = htmlspecialchars($row['section']);
				                ?>
				                <option value="<?php echo $section; ?>"><?php echo $section; ?></option>
				                <?php
				            }
				        } else {
				            echo '<option>No Sections Available</option>';
				        }
				        ?>
				    </select>
				    <br>
				</div>
              </div> -->
              <table class="table table-bordered border-primary">
                <thead>
                  <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Department</th>
                    <th scope="col">Course</th>
                    <th scope="col">Section</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
include 'conn.php';

// Check if the session contains valid login credentials
if (isset($_SESSION['email']) && isset($_SESSION['co_id']) && isset($_SESSION['password'])) {
    $co_id = $_SESSION['co_id']; // Get the current user's co_id from the session

    // Query to fetch students with their department names, section, status, course_id, and course_name
    $query = "
        SELECT 
            students.s_id, 
            students.student_id, 
            students.full_name, 
            students.status, 
            students.section, 
            departments.department_name, 
            students.c_id, 
            course.course_name, 
            students.n_id  -- Assuming n_id is the column identifying the student who corresponds to the co_id
        FROM 
            students 
        LEFT JOIN 
            departments ON students.d_id = departments.d_id 
        LEFT JOIN 
            course ON students.c_id = course.c_id 
        WHERE 
            students.status = 'Enrolled' 
            AND students.n_id = $co_id"; // Filter by n_id matching the logged-in co_id

    $results = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

    // Check if there are any rows returned
    if (mysqli_num_rows($results) > 0) {
        // Loop through each row
        while ($row = mysqli_fetch_assoc($results)) {
            // Sanitize output
            $s_id = htmlspecialchars($row['s_id']);
            $full_name = htmlspecialchars($row['full_name']);
            $department_name = htmlspecialchars($row['department_name'] ?? 'N/A'); // Default to 'N/A' if null
            $section = htmlspecialchars($row['section'] ?? 'N/A'); // Default to 'N/A' if null
            $status = htmlspecialchars($row['status'] ?? 'N/A'); // Default to 'N/A' if null
            $student_id = htmlspecialchars($row['student_id'] ?? 'N/A'); // Default to 'N/A' if null
            $course_name = htmlspecialchars($row['course_name'] ?? 'N/A'); // Default to 'N/A' if null
            ?>
            <tr>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $student_id; ?></td>
                <td><?php echo $department_name; ?></td>
                <td><?php echo $course_name; ?></td>
                <td><?php echo $section; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                  <a href="more_student_info.php" class="btn btn-outline-primary">More</a>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="8">
                <center>No Approved Account of Client Data</center>
            </td>
        </tr>
        <?php
    }
} else {
    echo "Please log in to view the data.";
}
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