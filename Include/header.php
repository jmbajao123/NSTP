<nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        <?php
include 'conn.php';

$s_id = $_SESSION['s_id'] ?? null; // Ensure session variable is set

$notification_count = 0; // Default value
$email = "";
$confirm_password = "";

if ($s_id) {
    // Query to count the number of approvals and fetch email & confirm_password
    $sql = "SELECT COUNT(*) AS notification_count, email, confirm_password 
            FROM officer 
            WHERE s_id = ? AND status = 'Approved'
            LIMIT 1";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $s_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $notification_count = $row['notification_count'];
                $email = $row['email'];
                $confirm_password = $row['confirm_password'];
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<li class="dropdown nav-icon">
    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user position-relative">
        <div class="d-lg-inline-block position-relative">
            <i data-feather="bell"></i>
            <?php if ($notification_count > 0): ?>
                <span class="position-absolute text-bold"
                      style="top: -5px; right: -5px; background-color: green; color: white; font-weight: bold; font-size: 12px; border-radius: 50%; padding: 2px 6px;">
                    <?= htmlspecialchars($notification_count, ENT_QUOTES, 'UTF-8'); ?>
                </span>
            <?php endif; ?>
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-right dropdown-menu-large">
        <h6 class='py-2 px-4'>Notifications</h6>
        <ul class="list-group rounded-none">
            <?php if ($notification_count > 0): ?>
                <li class="list-group-item border-0 align-items-start">
                    <div class="avatar bg-success mr-3">
                        <span class="avatar-content"><i data-feather="user-check"></i></span>
                    </div>
                    <a href="Coordinator/officer_sign_in.php" target="_blank">
                        <div>
                            <h6 class='text-bold'>Officer Approved</h6>
                            <p class='text-xs'>Congratulations! You have been approved as an officer.</p>
                            <p class='text-xs'>Here is your Email and Password:<br><strong>Email:</strong> <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?><br> <strong>Password:</strong> <?= htmlspecialchars($confirm_password, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </a>
                </li>
            <?php else: ?>
                <li class="list-group-item border-0 align-items-start">
                    <div class="avatar bg-warning mr-3">
                        <span class="avatar-content"><i data-feather="alert-circle"></i></span>
                    </div>
                    <div>
                        <h6 class='text-bold'>No Notifications</h6>
                        <p class='text-xs'>You have no new notifications.</p>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</li>

<?php
mysqli_close($conn);
?>
    





                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar mr-1">
                                    <img src="assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $_SESSION['full_name'] ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="profile.php"><i data-feather="user"></i>Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="sign_out.php"><i data-feather="log-out"></i> Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>