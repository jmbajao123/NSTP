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
                <h3>Course LIST</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course List</li>
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
	        	<button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#default">Add Course</button>
	        </h4>
	        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                        aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Add Course</h5>
                                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="add_course_functions.php">
                                        	<div class="row">
	                                        	<div class="col-lg-12">
	                                        		<div class="col-lg-12">
								                        <h4><label>Course Name</label></h4>
								                    </div>
	                                        		 <div class="col-lg-12 form-group">
								                        <input type="text" id="course_name" class="form-control" name="course_name" placeholder="Enter the Course Name" required>
								                    </div>
	                                        	</div>
	                                        	<div class="col-lg-12">
                                                    <!-- Department Dropdown -->
                                                    <div class="col-lg-12">
                                                        <h4><label for="department_name">Department</label></h4>
                                                    </div>
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="department_name" name="department_name" required>
                                                            <option value="" disabled selected>Select a Department</option>
                                                            <?php
                                                            // Include the database connection
                                                            include "conn.php";

                                                            // Query to fetch department data where status is 'Available'
                                                            $sql = "SELECT d_id, department_name FROM departments WHERE status = 'Available'";
                                                            $result = mysqli_query($conn, $sql);

                                                            // Loop through results and populate the dropdown
                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo "<option value='" . htmlspecialchars($row['d_id']) . "'>" . htmlspecialchars($row['department_name']) . "</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' disabled>No Available Departments</option>";
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

// Query to fetch course and department data along with status
$sql = "
    SELECT 
        course.c_id AS course_id, 
        course.course_name, 
        departments.department_name, 
        course.status 
    FROM 
        course 
    INNER JOIN 
        departments 
    ON 
        course.d_id = departments.d_id";

$result = mysqli_query($conn, $sql);

// Initialize an empty array to store fetched data
$data = [];

if (mysqli_num_rows($result) > 0) {
    // Fetch all rows into the $data array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!-- HTML Table to display course data -->
<table class="table mb-0">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Course Name</th>
            <th>Department Name</th>
            <th>Status</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $index => $row) : ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($row['course_name']); ?></td>
                    <td><?= htmlspecialchars($row['department_name']); ?></td>
                    <td>
                        <?php 
                            // Display status with a badge for better visual representation
                            $status = htmlspecialchars($row['status']);
                            if (strtolower($status) === 'available') {
                                echo "<span class='badge bg-success'>Available</span>";
                            } else {
                                echo "<span class='badge bg-danger'>Unavailable</span>";
                            }
                        ?>
                    </td>
                    <td>
                        <!-- Edit link with correct dynamic c_id -->
                        <a href="edit_course.php?c_id=<?= urlencode($row['course_id']); ?>" class="btn btn-outline-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5" class="text-center">No Courses Found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>





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