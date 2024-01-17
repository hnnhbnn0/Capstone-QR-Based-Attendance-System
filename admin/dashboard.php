<?php require('../controller/admin/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title> 
    <?php require('../controller/header.php'); ?>
    
</head>
<body>
    <?php require('../controller/admin/sidebar.php'); ?>
    <section class="home">
        <div class="text">
            <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 px-0">
                                            <div class="alert alert-light">
                                                <div class=" h3">Welcome to Dashboard!</div>
                                                <div class="h6 mb-0 text-muted">Hello <span class="text-primary fw-bolder" id="user">Admin</span>, welcome to QR-based attendance system.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6 px-1">
                                                    <div class="alert alert-success">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <label for="Subject" class="h5 mb-0  fw-bolder px-3">Total Student Accounts</label>
                                                            
                                                        </div>
                                                        </div>    
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <label for="Subject" class="h2 mb-0  fw-bolder px-3" id="tot-stud">00</label>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 px-1">
                                                    <div class="alert alert-warning">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <label for="Subject" class="h5 mb-0  fw-bolder px-3">Total Faculty Accounts</label>
                                                            </div>
                                                        </div>    
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <label for="Subject" class="h2 mb-0  fw-bolder px-3" id="tot-fac">00</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 px-1">
                                                    <div class="alert alert-light pt-1">
                                                        <label for="chart1" class="h6 mb-0 ">Student Accounts</label>
                                                        <canvas id="chart1" class="w-100" height="150"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 px-1">
                                                    <div class="alert alert-light pt-1">
                                                        <label for="chart2" class="h6 mb-0 ">Faculty Accounts</label>
                                                        <canvas id="chart2" class="w-100" height="150"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 px-1">
                                                    <div class="alert alert-light pt-1">
                                                        <label for="chart3" class="h6 mb-0 ">Total Accounts</label>
                                                        <canvas id="chart3" class="w-100" height="150"></canvas>

                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 px-1">
                                                    <div class="alert alert-light">
                                                        <div class="row">
                                                            <label for="chart4" class="h6 mb-0 ">Students by Year Level</label>
                                                            <div class="col-lg-12">
                                                                <canvas id="chart6" class="w-100"></canvas>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 px-1">
                                                    <div class="alert alert-light">
                                                        <div class="row">
                                                            <label for="chart4" class="h6 mb-0 ">Monthly Report of Absents by Year Level</label>
                                                            <div class="col-lg-12">
                                                                <canvas id="chart4" class="w-100"></canvas>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </section>

    <script src="/assets/js/main/sidebar.js"></script>
    <script src="/assets/js/admin/dashboard.js"></script>
</body>
</html>