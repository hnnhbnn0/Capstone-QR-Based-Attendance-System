<?php require('../controller/faculty/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <?php include('../controller/header.php'); ?>
    </head>
    <body>
   
        <?php include('../controller/faculty/sidebar.php'); ?>
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
                                            <div class="h6 mb-0 text-muted">Hello  <span class="name text-primary"><?php echo $session_fullname ?></span>, welcome to QR-based management attendance system.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 px-1">
                                                <div class="alert alert-warning">
                                                    <div class="row">
                                                    <div class="col-lg-4 ">
                                                        <i class="fa-solid fa-book-open-reader fa-3x"></i>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <label for="Subject" class="h5 mb-0  fw-bolder px-3" >Total Subject</label>
                                                            </div>
                                                        </div>    
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <label for="Subject" class="h4 mb-0  fw-bolder px-3" id="tot-sub">00</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>       
                                            </div>
                                            <div class="col-lg-6 px-1">
                                                <div class="alert alert-info">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <i class="fa-solid fa-people-roof fa-3x"></i>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                <label for="Class" class="h5 mb-0  fw-bolder px-3">Total Class</label>
                                                                </div>
                                                            </div>    
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                <label for="Class" class="h4 mb-0  fw-bolder px-3" id="tot-class">00</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 px-1">
                                                <div class="alert alert-dark">
                                                     <div class="row">
                                                        <div class="col-lg-12  wrapper overflow-auto">
                                                        <label for="stud_sec" class="h4 mb-0  fw-bolder">Subject with Section</label>
                                                        <table class="table table-secondary table-striped">
                                                            <thead class="h6 text-center" id="thead_studsec">
                                                                <tr>
                                                                    <th>-</th>
                                                                    <th>Year & Section</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody class="h6 text-center" id="tbody_studsec">
                                                                <tr>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                  
                                                                </tr>
                                                                <tr>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                
                                                                </tr>
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 px-1">
                                                <div class="alert alert-light">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                    
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
    <script src="/assets/js/faculty/dashboard.js"></script>
    </body>
</html>