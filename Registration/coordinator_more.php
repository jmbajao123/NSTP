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
                <h3>Coordinator</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coordinator</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
	<!-- Table head options start -->
	    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Coordinator Informations</h4>
            </div>
            <div class="card-body">
                <?php
// Include the database connection
include "conn.php";

// Check if the co_id is set in the URL (edit mode)
if (isset($_GET['co_id'])) {
    $co_id = intval($_GET['co_id']);  // Ensure co_id is an integer to prevent SQL injection.

    // Fetch the coordinator data along with the teacher's full name
    $sql = "
        SELECT 
            coordinator.*, 
            teacher.full_name AS teacher_name,  -- Fetch full_name from teacher table
            nstp.nstp_name
        FROM 
            coordinator
        LEFT JOIN 
            teacher ON coordinator.t_id = teacher.t_id  -- Join with teacher table
        LEFT JOIN 
            nstp ON coordinator.n_id = nstp.n_id
        WHERE 
            coordinator.co_id = $co_id
        LIMIT 1
    ";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);  // Fetch the coordinator data
        $teacher_name = $row['teacher_name']; // Store teacher's full name
        $email = $row['email'];
        $contact_number = $row['contact_number'];
        $address = $row['address'];
        $gender = $row['gender'];
        $birthdate = $row['birthdate'];
        $age = $row['age'];
        $civil_status = $row['civil_status'];
        $profile_picture = $row['profile_picture'];
        $valid_id = $row['valid_id'];
        $status = $row['status'];
        $program_name = $row['nstp_name']; // Program name from NSTP table
    } else {
        echo "Coordinator not found.";
        exit;
    }
} else {
    echo "Invalid Coordinator ID.";
    exit;
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Form to view coordinator details -->
<form method="post" action="update_coordinator.php">
    <div class="row">
        <div class="col-lg-6">
            <center>
                <label for="profile">Profile Picture</label><br>
                <?php if ($profile_picture): ?>
                    <img src="../uploads/<?= htmlspecialchars($profile_picture); ?>" alt="Profile Picture" class="img-fluid" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                <?php else: ?>
                    <p>No Profile Picture</p>
                <?php endif; ?>
            </center>
        </div>
        <div class="col-lg-6">
            <center>
                <label for="valid_id">Valid ID</label><br>
                <?php if ($valid_id): ?>
                    <img src="../uploads/<?= htmlspecialchars($valid_id); ?>" alt="Valid ID" class="img-fluid" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                <?php else: ?>
                    <p>No Valid ID</p>
                <?php endif; ?>
            </center>
        </div>
        <div class="col-lg-12"><br></div>
        
        <!-- Display Coordinator (Teacher) Details -->
        <div class="col-lg-4">
            <div class="form-group">
                <label for="teacher_name">Coordinator Name (Teacher)</label>
                <input type="text" class="form-control" id="teacher_name" placeholder="Enter the Coordinator Name" name="teacher_name" value="<?= htmlspecialchars($teacher_name); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email">Coordinator Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter the Coordinator Email" name="email" value="<?= htmlspecialchars($email); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="contact_number">Coordinator Contact Number</label>
                <input type="text" class="form-control" id="contact_number" placeholder="Enter the Coordinator Contact Number" name="contact_number" value="<?= htmlspecialchars($contact_number); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        
        <div class="col-lg-4">
            <div class="form-group">
                <label for="address">Coordinator Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter the Coordinator Contact Address" name="address" value="<?= htmlspecialchars($address); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="gender">Coordinator Gender</label>
                <input type="text" class="form-control" id="gender" placeholder="Enter the Coordinator Gender" name="gender" value="<?= htmlspecialchars($gender); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="birthdate">Coordinator Date of Birth</label>
                <input type="text" class="form-control" id="birthdate" placeholder="Enter the Coordinator Date of Birth" name="birthdate" value="<?= htmlspecialchars($birthdate); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        
        <div class="col-lg-4">
            <div class="form-group">
                <label for="age">Coordinator Age</label>
                <input type="text" class="form-control" id="age" placeholder="Enter the Coordinator Age" name="age" value="<?= htmlspecialchars($age); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="civil_status">Coordinator Civil Status</label>
                <input type="text" class="form-control" id="civil_status" placeholder="Enter the Coordinator Civil Status" name="civil_status" value="<?= htmlspecialchars($civil_status); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="status">Coordinator Account Status</label>
                <input type="text" class="form-control" id="status" placeholder="Enter the Coordinator Account Status" name="status" value="<?= htmlspecialchars($status); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        
        <!-- Display Program Name -->
        <div class="col-lg-4">
            <h4><label for="program_name">Program Name</label></h4>
            <input type="text" class="form-control" id="program_name" name="program_name" value="<?= htmlspecialchars($program_name); ?>" readonly>
        </div>

        <div class="col-lg-12"><br>
            <a href="add_coordinator.php" class="btn btn-outline-dark">Back</a>
        </div>
    </div>

    <!-- Hidden field to pass the coordinator ID -->
    <input type="hidden" name="co_id" value="<?= $co_id; ?>">
</form>




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