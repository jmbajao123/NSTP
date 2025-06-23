<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['username']) && isset($_SESSION['r_id']) && ($_SESSION['password']) ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTP - STII REGISTRATION</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/s.png" >
</head>
<body>
    <div id="app">
        <?php include 'Include/sidebar.php'; ?>
        <div id="main">
            <?php include 'Include/header.php'; ?>
            
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>COORDINATOR LIST</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">COORDINATOR List</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
	<!-- Table head options start -->
	<div class="row" id="table-head">
	  <div class="col-12">
	    <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">
	        	<button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#default">Add Coordinator</button>
	        </h4>
	        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Add Program</h5>
                                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="add_coordinator_functions.php">
                                        	<div class="row">
											<?php
												include 'conn.php'; // Database connection
												?>

												<div class="col-lg-12">
												    <div class="col-lg-12">
												        <h4><label>Coordinator Full Name</label></h4>
												    </div>
												    <div class="col-lg-12 form-group">
												        <select class="form-select" name="t_id" id="t_id">
												            <option selected disabled>Choose a Coordinator</option>
												            <?php
												            $query = "SELECT t_id, full_name FROM teacher WHERE status = 'active'";
												            $result = mysqli_query($conn, $query);
												            while ($row = mysqli_fetch_assoc($result)) {
												                echo '<option value="' . $row['t_id'] . '">' . $row['full_name'] . '</option>';
												            }
												            ?>
												        </select>
												    </div>
												</div>

												<div class="col-lg-12">
												    <div class="col-lg-12">
												        <h4><label>Coordinator Email</label></h4>
												    </div>
												    <div class="col-lg-12 form-group">
												        <input type="text" id="email" class="form-control" name="email" value="" readonly>
												    </div>
												</div>

												<div class="col-lg-12">
												    <div class="col-lg-12">
												        <h4><label>Contact Number</label></h4>
												    </div>
												    <div class="col-lg-12 form-group">
												        <input type="text" id="contact_number" class="form-control" name="contact_number" value="" readonly>
												    </div>
												</div>

												<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
												<script>
												$(document).ready(function(){
												    $('#t_id').change(function(){
												        var teacher_id = $(this).val();
												        $.ajax({
												            url: 'fetch_teacher_details.php',
												            type: 'POST',
												            data: {t_id: teacher_id},
												            dataType: 'json',
												            success: function(response){
												                $('#email').val(response.email);
												                $('#contact_number').val(response.contact_number);
												            }
												        });
												    });
												});
												</script>

	                                        	<div class="col-lg-12">
												    <!-- Program Dropdown -->
												    <div class="col-lg-12">
												        <h4><label for="n_id">Program Name</label></h4>
												    </div>
												    <fieldset class="form-group">
												        <select class="form-select" id="n_id" name="n_id" required>
												            <option value="" disabled selected>Choose a Program</option>
												            <?php
												            // Include the database connection
												            include "conn.php";

												            // Query to fetch program data where status is 'Active'
												            $sql = "SELECT n_id, nstp_name FROM nstp WHERE status = 'Active'";
												            $result = mysqli_query($conn, $sql);

												            // Loop through results and populate the dropdown
												            if (mysqli_num_rows($result) > 0) {
												                while ($row = mysqli_fetch_assoc($result)) {
												                    echo "<option value='" . htmlspecialchars($row['n_id']) . "'>" . htmlspecialchars($row['nstp_name']) . "</option>";
												                }
												            } else {
												                echo "<option value='' disabled>No Active Programs Available</option>";
												            }

												            // Close the database connection
												            mysqli_close($conn);
												            ?>
												        </select>
												    </fieldset>
												</div>
												<div class="col-lg-12">
	                                        		<div class="col-lg-12">
								                        <h4><label>Status</label></h4>
								                    </div>
								                    <fieldset class="form-group">
				                                        <select class="form-select" id="status" name="status">
				                                            <option selected disabled>Choose a Status</option>
				                                            <option value="Active">Active</option>
				                                            <option value="Inactive">Inactive</option>
				                                        </select>
				                                    </fieldset>
	                                        	</div>
	                                        </div>
                                    </div>
                                    <div class="modal-footer">
									    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">
									        <i class="bx bx-x d-block d-sm-none"></i>
									        <span class="d-none d-sm-block">Close</span>
									    </button>
									    <button type="submit" class="btn btn-outline-primary ml-1">
									        Add
									    </button>
									</div>
                                    </form>
                                </div>
                            </div>
                        </div>
	      </div>
	      <div class="card-content">
	        <!-- table head dark -->
	        <div class="table-responsive">
					<?php
// Include the database connection
include "conn.php";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare the SQL query to fetch coordinator details with full_name from the teacher table
$sql = "
    SELECT 
        coordinator.co_id AS coordinator_id,
        teacher.full_name,  -- Fetch full_name from teacher table
        nstp.nstp_name,
        coordinator.status
    FROM 
        coordinator
    LEFT JOIN 
        teacher ON coordinator.t_id = teacher.t_id  -- Join with teacher table
    LEFT JOIN 
        nstp ON coordinator.n_id = nstp.n_id
";
$result = mysqli_query($conn, $sql);
?>

<table class="table mb-0">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Coordinator Name</th>
            <th>NSTP Components</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $counter = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td class="text-bold-500"><?= $counter; ?></td>
                    <td><?= htmlspecialchars($row['full_name']); ?></td> <!-- Display teacher's full name -->
                    <td><?= htmlspecialchars($row['nstp_name'] ?? 'Not Assigned'); ?></td>
                    <td>
                        <?php
                            $status = strtolower($row['status']);
                            if ($status === 'active') {
                                echo '<span class="badge bg-success">Active</span>';
                            } elseif ($status === 'inactive') {
                                echo '<span class="badge bg-danger">Inactive</span>';
                            } else {
                                echo '<span class="badge bg-secondary">' . htmlspecialchars($row['status']) . '</span>';
                            }
                        ?>
                    </td>
                    <td>
                        <a href="coordinator_more.php?co_id=<?= urlencode($row['coordinator_id']); ?>" class="btn btn-outline-info">More</a>
                    </td>
                </tr>
                <?php $counter++; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No Coordinator Records Found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
// Close the database connection
mysqli_close($conn);
?>

	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Table head options end -->
	<?php include 'Include/footer.php'; ?>
            
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>
</html>

<?php 
}else{
    header("Location: sign_in.php");
    exit();
}

?>