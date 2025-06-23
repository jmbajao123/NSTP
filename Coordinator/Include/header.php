  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/s.png" alt="">
        <span class="d-none d-lg-block" style="font-size: 15px;">NSTP COORDINATOR</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <?php
        include 'conn.php';

        // Fetch notifications where o_id status is 'Pending' and join with students and teacher table to get full_name
        $sql = "SELECT o.o_id, o.status, s.full_name AS student_name, t.full_name AS teacher_name 
                FROM officer o
                JOIN students s ON o.s_id = s.s_id
                JOIN teacher t ON o.t_id = t.t_id
                WHERE o.status = 'Pending'";
        $result = $conn->query($sql);

        // Count notifications
        $notification_count = $result->num_rows;
        ?>

        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <?php if ($notification_count > 0): ?>
                    <span class="badge bg-primary badge-number"><?php echo $notification_count; ?></span>
                <?php endif; ?>
            </a><!-- End Notification Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                    You have <?php echo $notification_count; ?> new notifications
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <?php if ($notification_count > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <a href="officer_list.php">
                              <div>
                                <p><strong>From:</strong> Teacher <?php echo htmlspecialchars($row['teacher_name']); ?></p>
                                <p><?php echo htmlspecialchars($row['student_name']); ?> has been added as an officer.</p>
                                <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                              </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="notification-item text-center">
                        <p>No new notifications</p>
                    </li>
                <?php endif; ?>

                <li class="dropdown-footer">
                    <a href="#">Show all notifications</a>
                </li>
            </ul><!-- End Notification Dropdown Items -->
        </li>

        <?php
        $conn->close();
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