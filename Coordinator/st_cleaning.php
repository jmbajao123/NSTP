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
                    <th scope="col">Department Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Total Time</th>
                    <!-- <th scope="col">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
include 'conn.php';

if (isset($_SESSION['email'], $_SESSION['co_id'], $_SESSION['password'])) {
    $co_id = $_SESSION['co_id'];

    // Fetch enrolled students under this coordinator
    $query = "
        SELECT 
            s.s_id, s.student_id, s.full_name, s.status, s.section, 
            d.department_name, s.c_id, c.course_name, s.n_id  
        FROM students s
        LEFT JOIN departments d ON s.d_id = d.d_id 
        LEFT JOIN course c ON s.c_id = c.c_id 
        WHERE s.status = 'Enrolled' AND s.n_id = '$co_id'
    ";

    $results = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

    if (mysqli_num_rows($results) > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            $s_id = $row['s_id'];
            $full_name = htmlspecialchars($row['full_name']);
            $department_name = htmlspecialchars($row['department_name'] ?? 'N/A');
            $course_name = htmlspecialchars($row['course_name'] ?? 'N/A');
            $section = htmlspecialchars($row['section'] ?? 'N/A');
            $status = htmlspecialchars($row['status'] ?? 'N/A');
            $student_id = htmlspecialchars($row['student_id'] ?? 'N/A');

            // Initialize time tracking variables
            $start_date = $end_date = $area_name_start = $area_name_end = '';
            $hours = $minutes = 0;
            $has_time = false;
            $total_time_hours = 0;
            $display_date = '';

            // Fetch Start Time based on s_id
            $sql_start = "
                SELECT sc.date, a.area_name 
                FROM start_code sc
                INNER JOIN area a ON sc.area_id = a.area_id 
                WHERE sc.s_id = ?
                ORDER BY sc.date ASC LIMIT 1
            ";
            $stmt_start = $conn->prepare($sql_start);
            $stmt_start->bind_param("i", $s_id);
            $stmt_start->execute();
            $stmt_start->bind_result($start_date, $area_name_start);
            $stmt_start->fetch();
            $stmt_start->close();

            // Fetch End Time based on s_id
            $sql_end = "
                SELECT ec.date, a.area_name 
                FROM end_code ec
                INNER JOIN area a ON ec.area_id = a.area_id 
                WHERE ec.s_id = ?
                ORDER BY ec.date DESC LIMIT 1
            ";
            $stmt_end = $conn->prepare($sql_end);
            $stmt_end->bind_param("i", $s_id);
            $stmt_end->execute();
            $stmt_end->bind_result($end_date, $area_name_end);
            $stmt_end->fetch();
            $stmt_end->close();

            // Calculate total time if both start and end are found
            if (!empty($start_date) && !empty($end_date)) {
                $start_ts = strtotime($start_date);
                $end_ts = strtotime($end_date);

                $total_seconds = $end_ts - $start_ts;
                if ($total_seconds > 0 && $total_seconds <= 86400) {
                    $hours = floor($total_seconds / 3600);
                    $minutes = floor(($total_seconds % 3600) / 60);
                    $total_time_hours = $hours + ($minutes / 60);
                    $has_time = true;
                }

                // Format date(s) for display
                if (date("Y-m-d", $start_ts) === date("Y-m-d", $end_ts)) {
                    $display_date = date("F j, Y", $start_ts);
                } else {
                    $display_date = "Start: " . date("F j, Y", $start_ts) . " / End: " . date("F j, Y", $end_ts);
                }
            }

            $remaining_hours = max(0, number_format(54 - $total_time_hours, 2));
            $total_time_display = number_format($total_time_hours, 2);
            ?>

            <tr>
                <td><?= $full_name ?></td>
                <td><?= $department_name ?></td>
                <td><?= $course_name ?></td>
                <td>
                    <?php if ($has_time): ?>
                        <p>Total Time: <br> <strong><?= "$hours hour(s) and $minutes minute(s)" ?> (<?= $total_time_display ?> hrs)</strong></p>
                        <?php if ($total_time_hours >= 54): ?>
                            <p style="color: green; font-weight: bold;">🎉 Congratulations! You've completed the required 54 hours.</p>
                        <?php else: ?>
                            <p>Remaining Hours: <br> <strong><?= $remaining_hours ?> hour(s)</strong></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>No time recorded</p>
                    <?php endif; ?>
                </td>
            </tr>

            <?php
        }
    } else {
        echo "<tr><td colspan='7'><center>No Enrolled Students Found</center></td></tr>";
    }

    mysqli_close($conn);
} else {
    echo "Please log in to view the data.";
}
?>






                </tbody>
              </table>



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