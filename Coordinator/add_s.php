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

  <title>Adding Assign Area List - STII CWTS CLEANING ATTENDANCE</title>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script> <!-- QR Code Library -->
</head>

<body>

<?php include 'Include/header.php'; ?>
<?php include 'Include/sidebar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Adding Assign Area List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Adding Assign Area List</li>
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
              		<h5 class="card-title"> Adding Assign Area List
                  </h5><br>
              	</div><br>
              </div>
              <form method="post" action="add_s_func.php">
              	<div class="col-lg-12">
	              	<div class="row">
	              		<div class="col-lg-6">
	              			<label>
	              				<h4>Area Name</h4>
	              			</label>
	              			<select name="area_id" class="form-control" required>
							    <option selected disabled>Choose an Area</option>
							    <?php
							    include 'conn.php'; // Include database connection

							    $sql = "SELECT area_id, area_name FROM area WHERE status = 'Available'";
							    $result = $conn->query($sql);

							    if ($result->num_rows > 0) {
							        while ($row = $result->fetch_assoc()) {
							            echo '<option value="' . htmlspecialchars($row['area_id']) . '">' . htmlspecialchars($row['area_name']) . '</option>';
							        }
							    } else {
							        echo '<option disabled>No available areas</option>';
							    }

							    $conn->close();
							    ?>
							</select>
	              		</div>
	              		<div class="col-lg-6">
	              			<label>
	              				<h4>Student Officer</h4>
	              			</label>
	              			<?php

include 'conn.php'; // Include database connection

// Check if co_id is set in session
if (!isset($_SESSION['co_id'])) {
    echo "Error: No co_id found in session.";
    exit;
}

$co_id = $_SESSION['co_id']; // Get the currently signed-in user's co_id

// Query to get all officers from the officer table (no filtering on s_id or n_id)
$sql = "SELECT o.o_id, s.full_name, s.s_id
        FROM officer o
        JOIN students s ON o.s_id = s.s_id";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}

$stmt->execute();
$result = $stmt->get_result();

// Start the HTML for the select dropdown
?>

<select class="form-control" name="o_id" id="o_id" required>
    <option selected disabled>Choose a Student Officer</option>

    <?php
    // Check if there are officers and populate the options
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($row['o_id']) . '">' . htmlspecialchars($row['full_name']) . '</option>';
        }
    } else {
        echo '<option disabled>No student officers available</option>';
    }
    ?>

</select>

<?php
$stmt->close();
$conn->close();
?>

	              		</div>
	              		<div class="col-lg-12">
	              			<br>
	              		</div>
	              		<div class="col-lg-6">
							<label>
								<h4>Status</h4>
							</label>
							<select class="form-control" name="status" id="status" required>
								<option selected disabled>Choose a Status</option>
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
							</select>
						</div>
	              		<div class="col-lg-12"><br>
	              			<a href="ass_student.php" class="btn btn-outline-secondary">Back</a>
	              			<button type="submit" class="btn btn-outline-success" style="float:right;">Add Area</button>
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