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
                <h3>Teacher</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Teacher</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
	<!-- Table head options start -->
	    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Teacher Informations</h4>
            </div>
            <div class="card-body">
                <?php
// Include the database connection
include "conn.php";

// Check if the t_id is set in the URL (edit mode)
if (isset($_GET['t_id'])) {
    $t_id = intval($_GET['t_id']);  // Ensure the t_id is an integer to avoid SQL injection.

    // Fetch the teacher data based on t_id
    $sql = "SELECT * FROM teacher WHERE t_id = $t_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);  // Fetch the teacher data.
        $full_name = $row['full_name'];
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
    } else {
        // Handle case if no teacher is found with the provided t_id.
        echo "Teacher not found.";
        exit;
    }
} else {
    // Handle case if t_id is not provided (invalid access).
    echo "Invalid Teacher ID.";
    exit;
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Form to view teacher details -->
<form method="post" action="update_teacher.php">
    <div class="row">
        <div class="col-lg-6">
            <center>
                <label for="profile">Profile Picture</label><br>
                <!-- Display Profile Picture -->
                <?php if ($profile_picture): ?>
                    <img src="../teacher/uploads/<?= htmlspecialchars($profile_picture); ?>" alt="Profile Picture" class="img-fluid" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                <?php else: ?>
                    <p>No Profile Picture</p>
                <?php endif; ?>
            </center>
        </div>
        <div class="col-lg-6">
            <center>
                <label for="valid_id">Valid ID</label>
                <br>
                <!-- Display Valid ID -->
                <?php if ($valid_id): ?>
                    <img src="../teacher/uploads/<?= htmlspecialchars($valid_id); ?>" alt="Valid ID" class="img-fluid" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                <?php else: ?>
                    <p>No Valid ID</p>
                <?php endif; ?>
            </center>
        </div>
        <div class="col-lg-12"><br></div>
        
        <!-- Display Teacher Details -->
        <div class="col-lg-4">
            <div class="form-group">
                <label for="full_name">Teacher Name</label>
                <input type="text" class="form-control" id="full_name" placeholder="Enter the Teacher Name" name="full_name" value="<?= htmlspecialchars($full_name); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email">Teacher Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter the Teacher Email" name="email" value="<?= htmlspecialchars($email); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="contact_number">Teacher Contact Number</label>
                <input type="text" class="form-control" id="contact_number" placeholder="Enter the Teacher Contact Number" name="contact_number" value="<?= htmlspecialchars($contact_number); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        
        <div class="col-lg-4">
            <div class="form-group">
                <label for="address">Teacher Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter the Teacher Address" name="address" value="<?= htmlspecialchars($address); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="gender">Teacher Gender</label>
                <input type="text" class="form-control" id="gender" placeholder="Enter the Teacher Gender" name="gender" value="<?= htmlspecialchars($gender); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="birthdate">Teacher Date of Birth</label>
                <input type="text" class="form-control" id="birthdate" placeholder="Enter the Teacher Date of Birth" name="birthdate" value="<?= htmlspecialchars($birthdate); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        
        <div class="col-lg-4">
            <div class="form-group">
                <label for="age">Teacher Age</label>
                <input type="text" class="form-control" id="age" placeholder="Enter the Teacher Age" name="age" value="<?= htmlspecialchars($age); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="civil_status">Teacher Civil Status</label>
                <input type="text" class="form-control" id="civil_status" placeholder="Enter the Teacher Civil Status" name="civil_status" value="<?= htmlspecialchars($civil_status); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="status">Teacher Account Status</label>
                <input type="text" class="form-control" id="status" placeholder="Enter the Teacher Account Status" name="status" value="<?= htmlspecialchars($status); ?>" readonly>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        
        <div class="col-lg-4">
            <br>
        </div>

        <div class="col-lg-12"><br>
            <a href="add_teacher.php" class="btn btn-outline-dark">Back</a>
        </div>
    </div>

    <!-- Hidden field to pass the teacher ID -->
    <input type="hidden" name="t_id" value="<?= $t_id; ?>">
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