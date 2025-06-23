  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="schedule.php">
          <i class="bi bi-calendar"></i>
          <span>Schedule</span>
        </a>
      </li>
 -->      <!-- End Contact Page Nav -->

      

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Student List</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="student_list.php">
              <i class="bi bi-people"></i><span>Student Enrolled List</span>
            </a>
          </li>
          <li>
            <a href="st_cleaning.php">
              <i class="bi bi-people"></i><span>Student Cleaning Time</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Staff List</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="teacher_list.php">
              <i class="bi bi-people"></i><span>Teacher List</span>
            </a>
          </li>
          <li>
            <a href="officer_list.php">
              <i class="bi bi-people"></i><span>Pending Officer Account</span>
            </a>
          </li>
          <li>
            <a href="app_officer_list.php">
              <i class="bi bi-people"></i><span>Approved Officer Account</span>
            </a>
          </li>
          <li>
            <a href="den_officer_list.php">
              <i class="bi bi-people"></i><span>Denied Officer Account</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-geo-alt"></i><span>Assign Area</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <!-- <li>
            <a href="add_a_area.php">
              <i class="bi bi-circle"></i><span>Add Assign Area</span>
            </a>
          </li> -->
          <li>
            <a href="a_area.php">
              <i class="bi bi-circle"></i><span>Assign Area List</span>
            </a>
          </li>
          <li>
            <a href="ass_student.php">
              <i class="bi bi-circle"></i><span>Assign Student Officer</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-heading">
        <center>Reports</center>
      </li>
    </ul>

  </aside><!-- End Sidebar-->