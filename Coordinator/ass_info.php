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

  <title>Assign Area Officer Informations - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1> Assign Area Officer Informations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item"> Assign Area Officer Informations </li>
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
              		<h5 class="card-title">Assign Area Officer Information
                  </h5><br>
              	</div><br>
              </div>
              <?php
include 'conn.php'; // Include database connection

// Ensure user is logged in
if (!isset($_SESSION['co_id'])) {
    die("Access Denied. Please log in.");
}

$co_id = $_SESSION['co_id'];

// Query to get `n_id` of the currently signed-in coordinator
$query = "SELECT n_id FROM coordinator WHERE co_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $co_id);
$stmt->execute();
$stmt->bind_result($n_id);
$stmt->fetch();
$stmt->close();

// Check if assign_off_id is provided in the GET request
$assign_off_id = isset($_GET['assign_off_id']) ? intval($_GET['assign_off_id']) : 0;

$area_id = $o_id = $status = "";

// Fetch the existing data if assign_off_id is provided
if ($assign_off_id > 0) {
    $query = "SELECT area_id, o_id, status FROM assign_off WHERE assign_off_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $assign_off_id);
    $stmt->execute();
    $stmt->bind_result($area_id, $o_id, $status);
    $stmt->fetch();
    $stmt->close();
}
?>

<form method="post" action="up_ass.php">
    <input type="hidden" name="assign_off_id" value="<?php echo htmlspecialchars($assign_off_id); ?>">
    
    <div class="col-lg-12">
        <div class="row">
            <!-- Area Name Dropdown -->
            <div class="col-lg-6">
                <label><h4>Area Name</h4></label>
                <select name="area_id" class="form-control" required>
                    <option selected disabled>Choose an Area</option>
                    <?php
                    $sql = "SELECT area_id, area_name FROM area WHERE status = 'Available'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['area_id'] == $area_id) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row['area_id']) . '" ' . $selected . '>' . htmlspecialchars($row['area_name']) . '</option>';
                        }
                    } else {
                        echo '<option disabled>No available areas</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Student Officer Dropdown -->
            <div class="col-lg-6">
                <label><h4>Student Officer</h4></label>
                <select class="form-control" name="o_id" id="o_id" required>
                    <option selected disabled>Choose a Student Officer</option>
                    <?php
                    // Query to get officers where s_id matches the retrieved n_id
                    $sql = "SELECT o.o_id, s.full_name 
                            FROM officer o
                            JOIN students s ON o.s_id = s.s_id
                            WHERE s.n_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $n_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['o_id'] == $o_id) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row['o_id']) . '" ' . $selected . '>' . htmlspecialchars($row['full_name']) . '</option>';
                        }
                    } else {
                        echo '<option disabled>No student officers available</option>';
                    }

                    $stmt->close();
                    ?>
                </select>
            </div>

            <div class="col-lg-12"><br></div>

            <!-- Status Dropdown -->
            <div class="col-lg-6">
                <label><h4>Status</h4></label>
                <select class="form-control" name="status" id="status" required>
                    <option selected disabled>Choose a Status</option>
                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>

            <div class="col-lg-12"><br>
                <a href="ass_student.php" class="btn btn-outline-secondary">Back</a>
                <button type="submit" class="btn btn-outline-success" style="float:right;">
                    <?php echo ($assign_off_id > 0) ? 'Update' : 'Add Area'; ?>
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