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
    <title>Add Student - STII REGISTRATION</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/s.png">
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
                <h3>Add Student</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Students</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Student Information</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="add_student_functions.php">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="full_name">Student Full Name</label>
                                            <input type="text" id="full_name" class="form-control" placeholder="Last Name, First Name, Middle Initial"
                                                name="full_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="student_id">Student ID</label>
                                            <input type="text" id="student_id" class="form-control" placeholder="Enter the Student ID"
       name="student_id" oninput="validateInput(this)" required>

<script>
  function validateInput(input) {
    // Remove any character that is not a number or a hyphen
    input.value = input.value.replace(/[^0-9-]/g, '');
    
    // Ensure the minus sign is not at the beginning
    if (input.value.charAt(0) === '-') {
      input.value = input.value.substring(1); // Remove the minus sign if it is at the beginning
    }
  }
</script>


                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="department_name">Select a Department</label>
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
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="course-floating">Select a Course</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="course_name" name="course_name" required>
                                                    <option value="" disabled selected>Select a Course</option>
                                                    <?php
                                                    // Include the database connection
                                                    include "conn.php";

                                                    // Query to fetch course data where status is 'Available'
                                                    $sql = "SELECT c_id, course_name FROM course WHERE status = 'Available'";
                                                    $result = mysqli_query($conn, $sql);

                                                    // Check if courses are available and loop through results to populate the dropdown
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            // Sanitize and display course name and id
                                                            echo "<option value='" . htmlspecialchars($row['c_id']) . "'>" . htmlspecialchars($row['course_name']) . "</option>";
                                                        }
                                                    } else {
                                                        // If no available courses, show this message
                                                        echo "<option value='' disabled>No Available Courses</option>";
                                                    }

                                                    // Close the database connection
                                                    mysqli_close($conn);
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="section-column">Section</label>
                                            <input type="text" id="section" class="form-control" name="section"
                                                placeholder="Enter the Section">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nstp">Select a NSTP</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="nstp" name="nstp">
                                                    <option selected disabled>Choose a NSTP</option>
                                                    <?php
                                                        include 'conn.php';

                                                        // SQL query to fetch n_id and nstp_name from the 'nstp' table
                                                        $query = "SELECT n_id, nstp_name FROM nstp WHERE status = 'Active'";
                                                        $result = mysqli_query($conn, $query);

                                                        // Check if the query was successful
                                                        if ($result) {
                                                            // Check if there are any rows returned
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Loop through the rows and create an <option> for each
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    // Output option with n_id as value and nstp_name as the display text
                                                                    echo "<option value='" . $row['n_id'] . "'>" . $row['nstp_name'] . "</option>";
                                                                }
                                                            } else {
                                                                echo "<option>No NSTP available</option>";
                                                            }
                                                        } else {
                                                            echo "<option>Error fetching data</option>";
                                                        }

                                                        // Close the database connection
                                                        mysqli_close($conn);
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="section-column">Status</label>
		                                    <fieldset class="form-group">
		                                        <select class="form-select" id="status" name="status">
		                                            <option selected disabled>Choose a Status</option>
		                                            <option value="Enrolled">Enrolled</option>
		                                            <option value="Unenrolled">Not Enrolled</option>
		                                        </select>
		                                    </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-primary mr-1 mb-1">Add Student</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

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