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
    <title>Dashboard - STII REGISTRATION</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
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
        <h3>Dashboard</h3>
        <!-- <p class="text-subtitle text-muted">A good dashboard to display your statistics</p> -->
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-12 col-lg-4">
                 <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM departments WHERE status = 'Available'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Departments</h3>
                                    
                            </div>
                            <div class="chart-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 text-white">
                                        <center><p style="font-size: 50px"><?php echo $row['rowCount']; ?> </p></center>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <!-- <canvas id="canvas1" style="height:100px !important"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM course WHERE status = 'Available'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Courses</h3>
                            </div>
                            <div class="chart-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 text-white">
                                        <center><p style="font-size: 50px"><?php echo $row['rowCount']; ?> </p></center>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <!-- <canvas id="canvas1" style="height:100px !important"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM students WHERE status = 'Enrolled'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Students</h3>
                                
                            </div>
                            <div class="chart-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 text-white">
                                        <center><p style="font-size: 50px"><?php echo $row['rowCount']; ?> </p></center>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <!-- <canvas id="canvas1" style="height:100px !important"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM nstp WHERE status = 'Active'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Program</h3>
                                
                            </div>
                            <div class="chart-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 text-white">
                                        <center><p style="font-size: 50px"><?php echo $row['rowCount']; ?> </p></center>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <!-- <canvas id="canvas1" style="height:100px !important"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM coordinator WHERE status = 'Active'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Coordinators</h3>
                                
                            </div>
                            <div class="chart-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 text-white">
                                        <center><p style="font-size: 50px"><?php echo $row['rowCount']; ?> </p></center>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <!-- <canvas id="canvas1" style="height:100px !important"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM teacher WHERE status = 'Active'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Teachers</h3>
                                
                            </div>
                            <div class="chart-wrapper">
                                <div class="row">
                                    <div class="col-lg-12 text-white">
                                        <center><p style="font-size: 50px"><?php echo $row['rowCount']; ?> </p></center>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <!-- <canvas id="canvas1" style="height:100px !important"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
            </div>
            <!-- <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Sales Today</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>423 </p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas4" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        
    </section>
</div>

            <?php include 'Include/footer.php'; ?>
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
    header("Location: sign_in.php");
    exit();
}

?>