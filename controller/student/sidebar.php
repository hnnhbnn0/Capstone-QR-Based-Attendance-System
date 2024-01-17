<nav class="sidebar close" id="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img class="prime-profilesrc" src="/assets/img/user.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name prime-fullname"></span>
                    <span class="profession prime-userlevel"></span>
                    <input type="hidden" value="<?php echo $session_account_id; ?>" id="account-id">
                    <input type="hidden" class="prime-qr-id" id="qr-id">
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links ps-0">
                    <li class="nav-link">
                        <a href="../student/generate-qr.php" class="generate-qr-tab">
                            <i class='bx bx-home-alt icon' ></i>
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