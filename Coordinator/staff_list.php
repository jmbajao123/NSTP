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

  <title>Staff List - STII CWTS CLEANING ATTENDANCE</title>
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
      <h1>Staff List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Staff List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              	<div class="col-lg-6">
              		<h5 class="card-title">Staff List</h5>
              	</div>
              </div>
              <table class="table table-bordered border-primary">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
include "conn.php";

// Start the session to access session variables like co_id

// Ensure the session is started and the co_id is available
if (isset($_SESSION['co_id'])) {
    $co_id = $_SESSION['co_id'];  // Get the logged-in user's co_id

    // Prepare the query to fetch staff data based on co_id and staff_status
    $query = "
        SELECT * 
        FROM staff 
        WHERE staff_status = 'Active' 
        AND co_id = ?";  // Filter by co_id to match the logged-in user's co_id

    // Prepare the statement to avoid SQL injection
    if ($stmt = $conn->prepare($query)) {
        // Bind the co_id parameter
        $stmt->bind_param("i", $co_id);  // "i" stands for integer
        $stmt->execute();

        // Get the result
        $results = $stmt->get_result();

        // Check if there are any rows returned
        if (mysqli_num_rows($results) > 0) {
            // Loop through each row
            while ($row = mysqli_fetch_assoc($results)) {
                // Sanitize output
                $staff_id = htmlspecialchars($row['staff_id']);
                $staff_full_name = htmlspecialchars($row['staff_full_name']);
                $staff_email = htmlspecialchars($row['staff_email']);
                $staff_status = htmlspecialchars($row['staff_status']);
                $date = htmlspecialchars($row['date']);
                ?>
                <tr>
                    <th scope="row"><?php echo $staff_id ?></th>
                    <th scope="row"><?php echo $staff_full_name ?></th>
                    <th scope="row"><?php echo $staff_email ?></th>
                    <th scope="row"><?php echo $staff_status ?></th>
                    <th scope="row">
                        <button class="btn btn-outline-info">More</button>
                    </th>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">
                    <center>No Active Staff Data</center>
                </td>
            </tr>
            <?php
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Error handling if statement preparation fails
        echo "Error preparing query: " . $conn->error;
    }
} else {
    // Handle the case where the user is not logged in or co_id is not available
    echo "User not logged in.";
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