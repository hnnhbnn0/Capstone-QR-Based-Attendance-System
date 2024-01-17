<nav class="sidebar close" id="sidebar">
        <header>
            <div class="image-text">
           
                <span class="image">
                    <img src="/assets/img/user.png" alt="" class="prime-profilesrc">
                </span>
                
                <div class="text logo-text">
                    <span class="name prime-fullname"></span>
                    <span class="profession prime-userlevel"></span>
                    <input type="hidden" id="account-id" value="<?php echo $session_account_id ?>">
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links ps-0">
                    <li class="nav-link">
                        <a href="../admin/dashboard.php" class="dashboard-tab">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../admin/semester.php" class="semester-tab">
                            <i class='bi bi-bookmark-plus-fill icon' ></i>
                            <span class="text nav-text">Semester</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../admin/accounts.php" class="accounts-tab">
                            <i class='fa-solid fa-user-tie icon'></i>
                            <span class="text nav-text">Accounts</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../admin/assign-sub.php" class="assign-tab">
                            <i class='fa-solid fa-chalkboard-teacher icon' ></i>
                            <span class="text nav-text">Subjects</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../admin/archive.php" class="archive-tab">
                            <i class='bi bi-file-earmark-ruled-fill icon' ></i>
                            <span class="text nav-text">Archive</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../admin/profile.php" class="profile-tab">
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