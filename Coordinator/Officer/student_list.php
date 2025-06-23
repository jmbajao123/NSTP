<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['email']) && isset($_SESSION['o_id']) && ($_SESSION['password']) ) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Classmate List - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1>Classmate List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Classmate List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              	<div class="col-lg-2">
              		<h5 class="card-title">Classmate List</h5>
              	</div>
              </div>
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

if (isset($_SESSION['email'], $_SESSION['o_id'], $_SESSION['password'])) {
    $o_id = $_SESSION['o_id'];

    // Get organizer's department and course
    $org_query = "SELECT d_id, c_id FROM officer WHERE o_id = '$o_id'";
    $org_result = mysqli_query($conn, $org_query) or die("Organizer lookup error: " . mysqli_error($conn));

    if ($org_row = mysqli_fetch_assoc($org_result)) {
        $org_d_id = $org_row['d_id'];
        $org_c_id = $org_row['c_id'];

        // Get students
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
                students.n_id  
            FROM 
                students 
            LEFT JOIN departments ON students.d_id = departments.d_id 
            LEFT JOIN course ON students.c_id = course.c_id 
            WHERE 
                students.status = 'Enrolled' 
                AND students.n_id = '$o_id'
                AND students.d_id = '$org_d_id'
                AND students.c_id = '$org_c_id'
        ";

        $results = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $s_id = htmlspecialchars($row['s_id']);
                $full_name = htmlspecialchars($row['full_name']);
                $department_name = htmlspecialchars($row['department_name'] ?? 'N/A');
                $course_name = htmlspecialchars($row['course_name'] ?? 'N/A');
                $section = htmlspecialchars($row['section'] ?? 'N/A');
                $status = htmlspecialchars($row['status'] ?? 'N/A');
                $student_id = htmlspecialchars($row['student_id'] ?? 'N/A');

                // Fetch Start Time
                $sql_start = "
                    SELECT start_code.date, area.area_name 
                    FROM start_code
                    INNER JOIN area ON start_code.area_id = area.area_id 
                    WHERE start_code.s_id = ?
                ";
                $stmt_start = $conn->prepare($sql_start);
                $stmt_start->bind_param("i", $s_id);
                $stmt_start->execute();
                $stmt_start->bind_result($start_date, $area_name_start);
                $stmt_start->fetch();
                $stmt_start->close();

                // Fetch End Time
                $sql_end = "
                    SELECT end_code.date, area.area_name 
                    FROM end_code
                    INNER JOIN area ON end_code.area_id = area.area_id 
                    WHERE end_code.s_id = ?
                ";
                $stmt_end = $conn->prepare($sql_end);
                $stmt_end->bind_param("i", $s_id);
                $stmt_end->execute();
                $stmt_end->bind_result($end_date, $area_name_end);
                $stmt_end->fetch();
                $stmt_end->close();

                // Time Calculations
                $hours = $minutes = 0;
                $display_date = '';
                $has_time = false;
                $total_time_hours = 0;

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

                    if (date("Y-m-d", $start_ts) === date("Y-m-d", $end_ts)) {
                        $display_date = date("F j, Y", $start_ts);
                    } else {
                        $display_date = "Start: " . date("F j, Y", $start_ts) . " / End: " . date("F j, Y", $end_ts);
                    }
                }

                // Remaining hours from 54
                $remaining_hours = 54 - $total_time_hours;
                $remaining_hours = $remaining_hours > 0 ? number_format($remaining_hours, 2) : 0;
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
    } else {
        echo "Organizer not found.";
    }

    mysqli_close($conn);
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