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
// Include the database connection
include 'conn.php';

// Start the session
$o_id = $_SESSION['o_id'];

// Fetch assigned areas without render_time entries or where st/et is NULL
$query_notifications = "
    SELECT area.area_name 
    FROM assign_off 
    JOIN area ON assign_off.area_id = area.area_id 
    LEFT JOIN render_time ON assign_off.area_id = render_time.area_id AND assign_off.o_id = render_time.o_id
    WHERE assign_off.o_id = '$o_id'
    AND (render_time.st IS NULL OR render_time.et IS NULL)
";

$result_notifications = mysqli_query($conn, $query_notifications);
$notification_count = mysqli_num_rows($result_notifications); // Count notifications
?>

<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number"><?php echo $notification_count; ?></span>
    </a><!-- End Notification Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            You have <?php echo $notification_count; ?> new notifications
        </li>
        <li><hr class="dropdown-divider"></li>

        <?php if ($notification_count > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result_notifications)) { ?>
                <li class="notification-item">
                    <i class="bi bi-geo-alt text-success"></i> <!-- Location icon -->
                    <div>
                      <a href="ass_area.php">
                        <h4>New Assigned Area</h4>
                        <p><?php echo htmlspecialchars($row['area_name']); ?></p>
                        <p>Just now</p>
                      </a>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
            <?php } ?>
        <?php } else { ?>
            <li class="notification-item text-center">
                <center>
                  <p>No new assignments</p>
                </center>
            </li>
        <?php } ?>
    </ul><!-- End Notification Dropdown Items -->
</li><!-- End Notification Nav -->



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
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