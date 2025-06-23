<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['student_id']) && isset($_SESSION['s_id']) && ($_SESSION['full_name']) ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Student - STII NSTP</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/s.png" type="image/x-icon">
</head>
<body>
    <div id="app">
        <?php include 'Include/sidebar.php'; ?>
        <div id="main">
            <?php include 'Include/header.php'; ?>
            
			<div class="main-content container-fluid">
			    <div class="page-title">
			        <h3>Dashboard</h3>
			    </div>
			    <section class="section">
			        <div class="row">
			            <!-- <div class="col-lg-6">
			                <div class="card widget-todo">
			                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
			                        <h4 class="card-title d-flex">
			                            <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Assign Student Cleaning Area
			                        </h4>
			                        
			                    </div>
			                    <div class="card-body px-0 py-1">
			                        <table class='table table-borderless'>
			                            <tr>
			                                <td class='col-3'>UI Design</td>
			                                <td class='col-6'>
			                                    <div class="progress progress-info">
			                                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0"
			                                            aria-valuemax="100"></div>
			                                    </div>
			                                </td>
			                                <td class='col-3 text-center'>60%</td>
			                            </tr>
			                            <tr>
			                                <td class='col-3'>VueJS</td>
			                                <td class='col-6'>
			                                    <div class="progress progress-success">
			                                        <div class="progress-bar" role="progressbar" style="width: 35%" aria-valuenow="0" aria-valuemin="0"
			                                            aria-valuemax="100"></div>
			                                    </div>
			                                </td>
			                                <td class='col-3 text-center'>30%</td>
			                            </tr>
			                            <tr>
			                                <td class='col-3'>Laravel</td>
			                                <td class='col-6'>
			                                    <div class="progress progress-danger">
			                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="0"
			                                            aria-valuemax="100"></div>
			                                    </div>
			                                </td>
			                                <td class='col-3 text-center'>50%</td>
			                            </tr>
			                            <tr>
			                                <td class='col-3'>ReactJS</td>
			                                <td class='col-6'>
			                                    <div class="progress progress-primary">
			                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0"
			                                            aria-valuemax="100"></div>
			                                    </div>
			                                </td>
			                                <td class='col-3 text-center'>80%</td>
			                            </tr>
			                            <tr>
			                                <td class='col-3'>Go</td>
			                                <td class='col-6'>
			                                    <div class="progress progress-secondary">
			                                        <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="0" aria-valuemin="0"
			                                            aria-valuemax="100"></div>
			                                    </div>
			                                </td>
			                                <td class='col-3 text-center'>65%</td>
			                            </tr>
			                        </table>
			                    </div>
			                </div>
			            </div> -->
			            <div class="col-lg-6">
						    <div class="row">
						    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
						    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
						    	<div class="col-lg-12">
						    		<center>
						    			<label><h4>Start Time Code</h4></label><br>
						    		</center>
						    		<div class="accordion accordion-flush" id="accordionFlushExample">
									  <div class="accordion-item">
									    <h2 class="accordion-header" id="flush-headingOne">
									      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
									        Input the Code
									      </button>
									    </h2>
									    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
									      <div class="accordion-body">
									      	<form method="post" action="start_time.php">
									      		<label>Code:</label>
									      		<input type="number" name="st" id="st" class="form-control" placeholder="Input the Start Time Code" required>
									      		<br>
									      		<button type="submit" class="btn btn-outline-primary">Submit</button>
									      	</form>
									      </div>
									    </div>
									  </div>
									</div>
						    	</div>
						    	<div class="col-lg-12">
						    		<br>
						    	</div>
						    	<div class="col-lg-12">
						    		<br>
						    	</div>
						    	<div class="col-lg-12">
						    		<center>
						    			<label><h4>End Time Code</h4></label><br>
						    		</center>
						    		<div class="accordion accordion-flush" id="accordionFlushExample">
									  <div class="accordion-item">
									    <h2 class="accordion-header" id="flush-headingTwo">
									      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
									        Input the Code
									      </button>
									    </h2>
									    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
									      <div class="accordion-body">
									      	<?php
											include 'conn.php';

											// Fetch the latest Start Time Record ID
											$query = "SELECT st_r_id FROM st_render ORDER BY st_r_id DESC LIMIT 1";
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);
											$st_r_id = $row['st_r_id'] ?? ''; // Default to empty if no record is found

											mysqli_close($conn);
											?>

											<form method="post" action="end_time.php">
											    <label>Code:</label>
											    <input type="number" name="et" id="et" class="form-control" placeholder="Input the End Time Code" required>
											    <input type="hidden" name="st_r_id" value="<?php echo htmlspecialchars($st_r_id); ?>">
											    <input type="hidden" name="tt" value="tt">
											    <br>
											    <button type="submit" class="btn btn-outline-primary">Submit</button>
											</form>

									      </div>
									    </div>
									  </div>
									</div>
						    	</div>
						    </div>
			            </div>
			            <div class="col-lg-6">
			                <div class="col-lg-12">
			                	<div class="row">
			                		<div class="card widget-todo">
					                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
					                        <h4 class="card-title d-flex">
					                            <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Student Cleaning Hours
					                        </h4>
					                    </div>
					                    <div class="card-body px-0 py-1">
					                    	<div class="col-lg-12">
					                    		<div class="row">
					                    			<div class="col-lg-6">
    <center>
        <label>Student Cleaning Hours</label>
        <?php
        $s_id = $_SESSION['s_id']; // Get the signed-in user ID from the session

        include 'conn.php';

        $start_date = $end_date = $area_name_start = $area_name_end = null;

        // Get start time
        $sql_start = "
            SELECT start_code.date, area.area_name 
            FROM start_code
            INNER JOIN area ON start_code.area_id = area.area_id 
            WHERE start_code.s_id = ?
        ";
        $stmt = $conn->prepare($sql_start);
        $stmt->bind_param("i", $s_id);
        $stmt->execute();
        $stmt->bind_result($start_date, $area_name_start);
        $stmt->fetch();
        $stmt->close();

        // Get end time
        $sql_end = "
            SELECT end_code.date, area.area_name 
            FROM end_code
            INNER JOIN area ON end_code.area_id = area.area_id 
            WHERE end_code.s_id = ?
        ";
        $stmt = $conn->prepare($sql_end);
        $stmt->bind_param("i", $s_id);
        $stmt->execute();
        $stmt->bind_result($end_date, $area_name_end);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        $hours = $minutes = 0;
        $display_date = '';
        $total_time_seconds = 0; // To store the total time in seconds

        // Convert and compare timestamps
        if (!empty($start_date) && !empty($end_date)) {
            $start_timestamp = strtotime($start_date);
            $end_timestamp = strtotime($end_date);

            // Calculate time difference
            $total_seconds = $end_timestamp - $start_timestamp;

            // If within 24 hours (86400 seconds), calculate time
            if ($total_seconds > 0 && $total_seconds <= 86400) {
                $hours = floor($total_seconds / 3600);
                $minutes = floor(($total_seconds % 3600) / 60);
                $total_time_seconds = $total_seconds; // Store total time in seconds
            }

            // If same day, show only one date
            if (date("Y-m-d", $start_timestamp) === date("Y-m-d", $end_timestamp)) {
                $display_date = date("F j, Y", $start_timestamp);
            } else {
                $display_date = "Start: " . date("F j, Y", $start_timestamp) . " / End: " . date("F j, Y", $end_timestamp);
            }
        }

        // Set the 54-hour period in seconds (54 hours = 54 * 3600 seconds)
        $max_allowed_time_seconds = 54 * 3600;
        $remaining_seconds = $max_allowed_time_seconds - $total_time_seconds;
        $remaining_hours = floor($remaining_seconds / 3600);
        $remaining_minutes = floor(($remaining_seconds % 3600) / 60);
        ?>

        <?php if (!empty($display_date)): ?>
            <!-- <h5>Date: <?php echo htmlspecialchars($display_date); ?></h5> -->
        <?php endif; ?>

        <?php if (!empty($area_name_start) && !empty($start_date)): ?>
            <!-- <h6>Area: <?php echo htmlspecialchars($area_name_start); ?></h6> -->
            <!-- <p>Start: <span><?php echo date("g:i A", strtotime($start_date)); ?></span></p> -->
        <?php else: ?>
            <!-- No start time or area found will not be displayed -->
        <?php endif; ?>

        <?php if (!empty($end_date) && !empty($area_name_end)): ?>
            <!-- <p>End: <span><?php echo date("g:i A", strtotime($end_date)); ?></span></p> -->
        <?php else: ?>
            <!-- <p>No end time or area found.</p> -->
        <?php endif; ?>

        <?php if (!empty($start_date) && !empty($end_date)): ?>
            <p>Total Time: <strong><?php echo "$hours hour(s) and $minutes minute(s)"; ?></strong></p>
        <?php endif; ?>
    </center>
</div>

<div class="col-lg-6">
    <center>
        <label>Student Remaining Hours</label>
        <?php if (!empty($start_date) && !empty($end_date)): ?>
            <p>Remaining Time: <strong><?php echo "$remaining_hours hour(s) and $remaining_minutes minute(s)"; ?></strong></p>
        <?php endif; ?>
    </center>
</div>

					                    			<div class="col-lg-12">
					                    				<br>
					                    			</div>
					                    			<div class="col-lg-12">
					                    				<br>
					                    			</div>
					                    		</div>
					                    	</div>
					                    </div>
					                </div>
			                	</div>
			                </div>
			            </div>
			        </div>
			    </section>
			</div>

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
  </footer>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>
</html>
<?php 
}else{
    header("Location: login.php");
    exit();
}

?>