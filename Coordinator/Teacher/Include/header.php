  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/s.png" alt="">
        <span class="d-none d-lg-block" style="font-size: 15px;">STII Teacher</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        
          <?php
include 'conn.php';

// Get the currently logged-in user's t_id
if (!isset($_SESSION['t_id'])) {
    echo "Unauthorized access";
    exit;
}

$t_id = $_SESSION['t_id'];

// Fetch notifications where status is 'Approved' or 'Denied' and the t_id matches the o_id
$sql = "SELECT officer.*, students.full_name 
        FROM officer 
        INNER JOIN students ON officer.s_id = students.s_id 
        WHERE officer.status IN ('Approved', 'Denied') 
        AND officer.o_id = ?";
        
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $t_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$notification_count = mysqli_num_rows($result);
?>

<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number"><?php echo $notification_count; ?></span>
    </a>
    
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            You have <?php echo $notification_count; ?> new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li><hr class="dropdown-divider"></li>

        <?php
        if ($notification_count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $icon_class = ($row['status'] == 'Approved') ? 'bi-check-circle text-success' : 'bi-x-circle text-danger';
                ?>
                <li class="notification-item">
                    <i class="bi <?php echo $icon_class; ?>"></i>
                    <a href="officer_list.php">
                      <div>
                        <h4><?php echo htmlspecialchars($row['full_name']); ?></h4>
                        <p><?php echo "Status: " . htmlspecialchars($row['status']); ?></p>
                    </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <?php
            }
        } else {
            echo '<li class="dropdown-item text-center text-muted">No new notifications</li>';
        }
        ?>

        <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
        </li>
    </ul>
</li>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>


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

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
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