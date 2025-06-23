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
    <title>Student List - STII NSTP REGISTRATION</title>
    
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
                <h3>Student List</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student List</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>


<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="card-title">Student List</h4>
            </div>
            <div class="col-lg-3">
                
            </div>
            <div class="col-lg-3">
    <select class="form-select" name="department_name" id="department_name">
        <option>Choose a Department</option>
        <?php
        include "conn.php";

        // Query to fetch departments where status is 'Available'
        $query = "SELECT * FROM departments WHERE status = 'Available'"; // Filtering by 'Available' status
        $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

        // Check if there are departments
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Sanitize department data
                $department_id = htmlspecialchars($row['d_id']);
                $department_name = htmlspecialchars($row['department_name']);
                ?>
                <option value="<?php echo $department_id; ?>"><?php echo $department_name; ?></option>
                <?php
            }
        } else {
            // Fallback message if no available departments exist
            echo '<option>No Available Departments</option>';
        }
        ?>
    </select>
    <br>
</div>

            <div class="col-lg-3">
                <select class="form-select" name="section" id="section">
                        <option>Choose a Section</option>
                        <?php
                        include "conn.php";

                        // Query to fetch all unique sections from the students table
                        $query = "SELECT DISTINCT section FROM students WHERE section IS NOT NULL";
                        $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

                        // Check if there are sections
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Sanitize section data
                                $section = htmlspecialchars($row['section']);
                                ?>
                                <option value="<?php echo $section; ?>"><?php echo $section; ?></option>
                                <?php
                            }
                        } else {
                            // Fallback if no sections exist
                            echo '<option>No Sections Available</option>';
                        }
                        ?>
                    </select>
                    <br>
            </div>
            <div class="col-lg-3">
                <select class="form-select" name="nstp_name" id="nstp_name">
                    <option>Choose a Program</option>
                    <?php
                    include "conn.php";

                    // Query to fetch unique active NSTP names
                    $query = "SELECT DISTINCT nstp_name 
                              FROM nstp 
                              WHERE nstp_name IS NOT NULL AND status = 'Active'"; // Filtering by 'Active' status
                    $result = mysqli_query($conn, $query) or die("Database error: " . mysqli_error($conn));

                    // Check if there are results
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Sanitize the NSTP name
                            $nstp_name = htmlspecialchars($row['nstp_name']);
                            ?>
                            <option value="<?php echo $nstp_name; ?>"><?php echo $nstp_name; ?></option>
                            <?php
                        }
                    } else {
                        // Fallback message if no active NSTP programs are available
                        echo '<option>No Active Programs Available</option>';
                    }
                    ?>
                </select>
                <br>
            </div>
        </div>
      </div>
      <div class="card-content">
        <div class="table-responsive">
          <?php
// Include the database connection
include "conn.php";

// Fetch data from the `students` table with `department_name`, `course_name`, and `nstp_name`
$sql = "SELECT 
            students.s_id, 
            students.full_name, 
            students.student_id, 
            departments.department_name, 
            course.course_name, 
            students.section, 
            nstp.nstp_name  -- Fetching nstp_name from nstp table
        FROM 
            students
        LEFT JOIN 
            departments ON students.d_id = departments.d_id
        LEFT JOIN 
            course ON students.c_id = course.c_id
        LEFT JOIN 
            nstp ON students.n_id = nstp.n_id";  // Corrected to join on `students.nstp` = `nstp.n_id`

$result = mysqli_query($conn, $sql);
?>

<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Department</th>
            <th>Course</th>
            <th>Section</th>
            <th>Program</th>
            <th>Action</th> <!-- Added the Action column -->
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $counter = 1; ?> <!-- Initialize the counter -->
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>   
                    <td class="text-bold-500"><?= $counter; ?></td> <!-- Display the counter -->
                    <td class="text-bold-500"><?= htmlspecialchars($row['full_name']); ?></td>
                    <td><?= htmlspecialchars($row['student_id']); ?></td>
                    <td class="text-bold-500"><?= htmlspecialchars($row['department_name'] ?? 'Not Assigned'); ?></td>
                    <td><?= htmlspecialchars($row['course_name'] ?? 'Not Assigned'); ?></td>
                    <td><?= htmlspecialchars($row['section']); ?></td>
                    <td><?= htmlspecialchars($row['nstp_name'] ?? 'Not Assigned'); ?></td> <!-- Displaying nstp_name -->
                    <td>
                        <a href="more_student.php?s_id=<?= $row['s_id']; ?>" class="btn btn-outline-info">
                             More
                        </a>
                    </td>
                </tr>
                <?php $counter++; ?> <!-- Increment the counter -->
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">No Student Records Found</td> <!-- Adjusted colspan to 8 -->
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
<!-- Bordered table end -->


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