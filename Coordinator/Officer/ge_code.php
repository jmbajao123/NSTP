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

  <title>Generate a CODE - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1>Generate a CODE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Generate a CODE</li>
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
              		<h5 class="card-title">Generate a CODE</h5>
              	</div>
              </div>
              	<div class="row">
              		<div class="row">
                     <?php
include 'conn.php'; // Ensure this file contains your database connection

if (isset($_POST['assign_off_id']) && isset($_POST['area_id']) && isset($_SESSION['o_id'])) {
    $assign_off_id = $_POST['assign_off_id'];
    $area_id = $_POST['area_id'];
    $o_id = $_SESSION['o_id']; // Get the currently logged-in user's ID
    
    // Check if a record already exists with the same assign_off_id and area_id
    $check_query = "SELECT * FROM render_time WHERE assign_off_id = ? AND area_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ii", $assign_off_id, $area_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo "<script>alert('A code has already been generated for this assignment and area.'); window.location.href = 'ass_area.php';</script>";
    } else {
        // Generate a unique 6-digit random code for 'st'
        $st = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Ensure 'et' is unique and different from 'st'
        do {
            $et = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while ($et === $st);
        
        // Insert the generated times into the database
        $query = "INSERT INTO render_time (assign_off_id, area_id, o_id, st, et) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiiss", $assign_off_id, $area_id, $o_id, $st, $et);
        
        if ($stmt->execute()) {
            echo "<script>alert('Generate Code successfully.');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
        
        ?>
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-center">Start Time</h1>
                <div class="accordion accordion-flush" id="startAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="startHeading">
                            <button class="accordion-button collapsed btn btn-outline-info" type="button" data-bs-toggle="collapse" data-bs-target="#startCollapse" aria-expanded="false" aria-controls="startCollapse">
                                Show the Code
                            </button>
                        </h2>
                        <div id="startCollapse" class="accordion-collapse collapse" aria-labelledby="startHeading" data-bs-parent="#startAccordion">
                            <div class="accordion-body">
                                <h3>Code: <?php echo htmlspecialchars($st); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <h1 class="text-center">End Time</h1>
                <div class="accordion accordion-flush" id="endAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="endHeading">
                            <button class="accordion-button collapsed btn btn-outline-info" type="button" data-bs-toggle="collapse" data-bs-target="#endCollapse" aria-expanded="false" aria-controls="endCollapse">
                                Show the Code
                            </button>
                        </h2>
                        <div id="endCollapse" class="accordion-collapse collapse" aria-labelledby="endHeading" data-bs-parent="#endAccordion">
                            <div class="accordion-body">
                                <h3>Code: <?php echo htmlspecialchars($et); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    $check_stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'ass_area.php';</script>";
}
?>


</div>
</div>
<div class="col-lg-12">
	<br>
</div>
<div class="col-lg-12">
	<br>
</div>
<div class="col-lg-12">
	<a href="ass_area.php" class="btn btn-outline-secondary">Back</a>
</div>
              </div>
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