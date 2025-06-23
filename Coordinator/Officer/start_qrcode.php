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

  <title>Generate a QRCODE - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1>Generate a QRCODE</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Generate a QRCODE</li>
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
                    <h5 class="card-title">Generate a QRCODE</h5>
                </div>
              </div>
                <div class="row">
                  <?php
// Start session and include database connection
include 'conn.php';

// Check if officer is logged in
if (!isset($_SESSION['o_id'])) {
    exit("Access Denied. Please log in.");
}

$o_id = $_SESSION['o_id'];

// Fetch the assigned area and assign_off_id for the logged-in officer
$query = "SELECT assign_off_id, area_id FROM assign_off WHERE o_id = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $o_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    exit("No assigned area found for the logged-in officer.");
}

// Store assign_off_id and area_id
$assign_off_id = $row['assign_off_id'];
$area_id = $row['area_id'];

// Close the database connection
$stmt->close();
$conn->close();
?>

<form method="post" action="start_qrcode.php" onsubmit="generateQRCode(event)">
    <center>
        <label><h4>Start Time</h4></label><br>

        <!-- Hidden fields for assign_off_id and area_id -->
        <input type="hidden" name="assign_off_id" value="<?php echo htmlspecialchars($assign_off_id); ?>">
        <input type="hidden" name="area_id" value="<?php echo htmlspecialchars($area_id); ?>">
        
        <!-- Hidden input for start_time -->
        <input type="hidden" id="start_time" name="start_time" value="">

        <button type="submit" class="btn btn-outline-primary">Generate QR Code</button>

        <!-- QR Code Display -->
        <div id="qrcode-container" style="margin-top: 20px;">
            <img id="qrcode" src="" alt="QR Code will appear here">
        </div>
    </center>
</form>

<script>
function generateQRCode(event) {
    event.preventDefault(); // Prevent form submission until QR code is set

    // Generate the current start time
    let startTime = new Date().toISOString();
    document.getElementById('start_time').value = startTime;

    // Get values for QR Code
    let assignOffId = "<?php echo $assign_off_id; ?>";
    let areaId = "<?php echo $area_id; ?>";
    
    // Construct QR data
    let qrData = `Start Time: ${startTime}, Assign ID: ${assignOffId}, Area ID: ${areaId}`;
    
    // Generate Google Chart API QR Code
    let qrImage = `https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=${encodeURIComponent(qrData)}&choe=UTF-8`;

    // Set QR Code Image
    document.getElementById('qrcode').src = qrImage;

    // Submit the form after QR code is generated
    setTimeout(() => {
        document.querySelector("form").submit();
    }, 1000); // Delay for 1 second to update QR code
}
</script>





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