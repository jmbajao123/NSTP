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
    <title>Department - STII REGISTRATION</title>
    
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
                <h3>DEPARTMENT LIST</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Department</li>
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
	        	<button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#default">Add Department</button>
	        </h4>
	        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Add Department</h5>
                                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="add_department_functions.php">
                                        	<div class="row">
	                                        	<div class="col-lg-12">
	                                        		<div class="col-lg-12">
								                        <h4><label>Department Name</label></h4>
								                    </div>
	                                        		 <div class="col-lg-12 form-group">
								                        <input type="text" id="department_name" class="form-control" name="department_name" placeholder="Enter the Department Name" required>
								                    </div>
	                                        	</div>
	                                        	<div class="col-lg-12">
	                                        		<div class="col-lg-12">
								                        <h4><label>Status</label></h4>
								                    </div>
								                    <fieldset class="form-group">
				                                        <select class="form-select" id="status" name="status">
				                                            <option selected disabled>Choose a Status</option>
				                                            <option>Available</option>
				                                            <option>Unavailable</option>
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

// Fetch data from the departments table
$sql = "SELECT * FROM departments";
$result = mysqli_query($conn, $sql);
?>

<table class="table mb-0">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Department Name</th>
            <th>Status</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $counter = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td class="text-bold-500"><?php echo $counter; ?></td>
                    <td><?php echo htmlspecialchars($row['department_name']); ?></td>
                    <td>
                        <?php if (strtolower($row['status']) === 'available'): ?>
                            <span class="badge bg-success">Available</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Unavailable</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_department.php?d_id=<?php echo urlencode($row['d_id']); ?>" class="btn btn-outline-info">Edit</a>
                    </td>
                </tr>
                <?php $counter++; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No Departments Found</td>
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