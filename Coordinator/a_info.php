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

  <title>Assign Area Informations - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1>Assign Area Informations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Assign Area Informations</li>
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
              		<h5 class="card-title">Assign Area Informations
                  </h5><br>
              	</div><br>
              </div>
              <?php
include 'conn.php'; // Include database connection

// Initialize variables
$area_id = isset($_GET['area_id']) ? intval($_GET['area_id']) : 0;
$area_name = "";
$status = "";

// Fetch existing data if `area_id` is provided
if ($area_id > 0) {
    $query = "SELECT area_name, status FROM area WHERE area_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $area_id);
    $stmt->execute();
    $stmt->bind_result($area_name, $status);
    $stmt->fetch();
    $stmt->close();
}
?>

<form method="post" action="up_area_func.php">
    <input type="hidden" name="area_id" value="<?php echo htmlspecialchars($area_id); ?>">

    <div class="col-lg-12">
        <div class="row">
            <!-- Area Name Input -->
            <div class="col-lg-6">
                <label><h4>Area Name</h4></label>
                <input type="text" name="area_name" class="form-control" id="area_name"
                       placeholder="Input the Area Name"
                       value="<?php echo htmlspecialchars($area_name); ?>" required>
            </div>

            <!-- Status Dropdown -->
            <div class="col-lg-6">
                <label><h4>Status</h4></label>
                <select class="form-control" name="status" id="status">
                    <option disabled>Choose a Status</option>
                    <option value="Available" <?php echo ($status == "Available") ? "selected" : ""; ?>>Available</option>
                    <option value="Unavailable" <?php echo ($status == "Unavailable") ? "selected" : ""; ?>>Unavailable</option>
                </select>
            </div>

            <div class="col-lg-12"><br></div>

            <!-- Submit Button -->
            <div class="col-lg-12">
            	<a href="a_area.php" class="btn btn-outline-secondary">Back</a>
                <button type="submit" class="btn btn-outline-success" style="float:right;">
                    <?php echo ($area_id > 0) ? "Update Area" : "Add Area"; ?>
                </button>
            </div>
        </div>
    </div>
</form>

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