
<nav class="sidebar close" id="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/assets/img/user.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name"><?php echo $session_fullname ?></span>
                    <span class="profession"><?php echo $session_userlevel ?></span>
                    <input type="hidden" id="account-id" value="<?php echo $session_account_id ?>">
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links ps-0">
                    <li class="nav-link">
                        <a href="../faculty/dashboard.php" class="dashboard-tab">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../faculty/scan-qr.php" class="scan-qr-tab">
                            <i class='bi bi-qr-code-scan icon' ></i>
                            <span class="text nav-text">Scan QR</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../faculty/reports.php" class="reports-tab">
                            <i class='bi bi-archive-fill icon'></i>
                            <span class="text nav-text">Reports</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../faculty/announcement.php" class="announcement-tab">
                            <i class='bi bi-megaphone-fill icon' ></i>
                            <span class="text nav-text">Announcement</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../faculty/profile.php" class="profile-tab">
                            <i class='bi bi-person-circle icon' ></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../controller/logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>
    </nav>