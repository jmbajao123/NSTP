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

  <title>Complete Profile - STII CWTS CLEANING ATTENDANCE</title>
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

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <img src="assets/img/s.png" alt="">
        <span class="d-none d-lg-block" style="font-size: 15px;">STII Teacher</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['email'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['email'] ?></h6>
              <!-- <span></span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li> -->
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="sign_out.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  <!-- <main id="main" class="main"> -->
<br><br><br><br>
    <div class="pagetitle">
      <center>
      	<h1>Complete Profile</h1>
      </center>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
          <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

      <div class="row">
      	<?php
// Start session (if not already started)

// Check if client_id is stored in session
if (isset($_SESSION['t_id'])) {
    $t_id = $_SESSION['t_id'];

    // Include database connection
    include "conn.php";

    // Fetch client data based on client_id
    $query = "SELECT * FROM teacher WHERE t_id = $t_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Display client data
        $full_name = $row['full_name'];
        $address = $row['address'];
        $email = $row['email'];
        $gender = $row['gender'];
        $contact_number = $row['contact_number'];
        $age = $row['age'];
        $status = $row['status'];
        $birthdate = $row['birthdate'];
        $civil_status = $row['civil_status'];
        $date = $row['date'];
        $profile_picture = $row['profile_picture'];
        $valid_id = $row['valid_id'];

        ?>
      	<div class="col-lg-2">
      		
      	</div>
      	<div class="col-lg-8">
      	<form method="post" action="complete_profile_functions.php" enctype="multipart/form-data" >
	      		<div class="row">
	      			<div class="col-lg-4">
	      				<label>
	      					<h4>Full Name</h4>
	      				</label>
	      				<input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter your Full Name" value="<?php echo $full_name; ?>" readonly>
	      			</div>
	      			<div class="col-lg-4">
	      				<label>
	      					<h4>Email</h4>
	      				</label>
	      				<input type="text" name="email" id="email" class="form-control" placeholder="Enter your Full Name" value="<?php echo $email; ?>" readonly>
	      			</div>
	      			<div class="col-lg-4">
	      				<label>
	      					<h4>Contact</h4>
	      				</label>
	      				<input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter your Full Name" value="<?php echo $contact_number; ?>" readonly>
	      			</div>
	      			<div class="col-lg-12">
	      				<br>
	      			</div>
	      			<div class="col-lg-4">
	      				<label>
	      					<h4>Date of Birth</h4>
	      				</label>
	      				<input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="Enter your Full Name" value="" required>
	      			</div>
	      			<div class="col-lg-4">
	      				<label>
	      					<h4>Age</h4>
	      				</label>
	      				<input type="number" name="age" id="age" class="form-control" placeholder="Enter your Age" readonly value="">
	      			</div>
	      			
	      			<div class="col-lg-4">
	      				<label>
	      					<h4>Gender</h4>
	      				</label>
	      				<select class="form-select" name="gender" id="gender">
	      					<option selected disabled>Choose a Gender</option>
	      					<option value="Male">Male</option>
	      					<option value="Female">Female</option>
	      					<option value="Other">Other</option>
	      				</select>
	      			</div>
	      			<?php include 'date_age.php'; ?>
					<div class="col-lg-12">
						<br>
					</div>
	      			<div class="col-lg-6">
	      				<label>
	      					<h4>Civil Status</h4>
	      				</label>
	      				<select class="form-select" name="civil_status" id="civil_status">
	      					<option selected disabled>Choose a Civil Status</option>
	      					<option value="Married">Married</option>
	      					<option value="Single">Single</option>
	      					<option value="Divorced">Divorced</option>
	      					<option value="Widowed">Widowed</option>
	      				</select>
	      			</div>
	      			<div class="col-lg-6">
	      				<label>
	      					<h4>Address</h4>
	      				</label>
	      				<input type="text" name="address" id="address" class="form-control" placeholder="Enter your Address" required value="">
	      			</div>
	      			<div class="col-lg-12">
	      				<br>
	      			</div>
	      			<div class="col-lg-6">
	      				<label>
	      					<h4>Profile Picture</h4>
	      				</label>
	      				<input type="file" name="profile_picture" id="profile_picture" class="form-control"  required value="">
	      			</div>
	      			<div class="col-lg-6">
	      				<label>
	      					<h4>Valid ID</h4>
	      				</label>
	      				<input type="file" name="valid_id" id="valid_id" class="form-control"  required value="">
	      			</div>
	      			<div class="col-lg-12">
	      				<br>
	      			</div>
	      			<div class="col-lg-12">
	      				<button class="btn btn-outline-success" style="float: right;">Submit</button>
	      			</div>
	      		</div>
      	</form>
      	</div>
      	<div class="col-lg-2">
      		
      	</div>
      	<?php
    } else {
        echo "<center>No data available for this client ID</center>";
    }
} else {
    echo "<center>No Coordinator ID found in session. Please log in.</center>";
}
?>
      </div>

  <!-- </main> -->
  <!-- End #main -->


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