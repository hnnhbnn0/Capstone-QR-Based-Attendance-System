<?php require('../controller/admin/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Subjects</title>
        <?php include('../controller/header.php'); ?>
    </head>
    <body>
    <?php require('../controller/admin/sidebar.php'); ?>
    <section class="home">
        <div class="text">

                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="container">
                                <div class="row">
                                    <div class="alert bg-dark mb-0 rounded-top rounded-0">
                                        <div class="row">
                                            <div class="col-lg-12 d-block align-middle mb-0">
                                                <div class="h4 mb-0"> Teacher Subjects Settings <div class="float-end text-warning h5 mb-0" id=""></div></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 px-0">
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="row mb-2">
                                                <!-- <div class="col-lg-3">
                                                   
                                                    <div class="input-group mb-2">
                                                        <select name="" class="form-select" id="select-academic-year">
                                                            <option selected disabled value="" class="dropdown-header">Academic Year</option>
                                                            <option value="1">2022-2023</option>
                                                            
                                                        </select>
                                                    </div>
                                                  
                                                </div>
                                                
                                                <div class="col-lg-3">
                                                    <div class="input-group mb-2">
                                                        <select name="" class="form-select" id="select-yl">
                                                            <option selected disabled value="" class="dropdown-header">Semester</option>
                                                            <option value="1">First Semester</option>
                                                            <option value="2">Second Semester</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-lg-6">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" name="" id="search-teacher" placeholder="Search">
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="row mb-2">
                                                <div class="wrapper overflow-auto">
                        
                                                    <table class="table table-light table-hover table-striped" data-cols-width="40,50,25">
                                                        <thead class="h5 text-center sticky-top bg-light" id="tchr-thead">
                                                            <tr>
                                                                
                                                                <th>Teacher Name</th>
                                                                <th>Subjects</th>
                                                                <th>Action</th>
                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody class="h6 text-center" id="tchr-tbody">
                                                            <tr class="align-middle">
                                                                
                                                                <td>-</td>
                                                                <td>-</td>
                                                               
                                                                <td>
                                                                <button class="btn btn-primary bi bi-plus-lg btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#sub-add-modal"></button>
                                                                </td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            
            

                <div class="modal fade" id="sub-add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title h4 fw-bolder">Add Teacher Subject</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="arr.splice(0, arr.length); $('#lists-of-subjects').empty()" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-add-subjects">
                                    <!-- <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Employee ID</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <input name="acctid" required type="text" class="form-control"  id="empID" placeholder="Employee ID" autocomplete="off">
                                        </div>
                                    </div> -->
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Full Name</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <div class="input-group">
                                               
                                                <input name="fullname" disabled type="text" class="form-control" id="add-fullname" placeholder="Full Name" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Email Address</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <input name="email" required type="text" class="form-control" id="email" placeholder="Email" autocomplete="off">   
                                        </div>
                                    </div> -->
                                
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Subjects</div>
                                        </div>
                                       
                                        <div class="col-lg-9 d-block">
                                            <input type="hidden" name="id" id="add-acct-id">
                                            <div class="input-group">
            
                                                <select id="select-subject" class="form-select subject-lists">
                                                    <option disabled selected value="" class="dropdown-header">- Select Subjects -</option>
                                  
                                                </select>
                                                <select id="select-section" class="form-select">
                                                    <option disabled selected value="" class="dropdown-header">- Select Section -</option>
                                                    <option value="A">Section A</option>
                                                    <option value="B">Section B</option>
                                                    <option value="C">Section C</option>
                                                    <option value="D">Section D</option>
                                                </select>
                                                <button id="add-subjects" type="button" class="btn btn-primary" style="width: 100px;">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5"></div>
                                        </div>
                                        <div class="col-lg-9 d-block align-self-center">
                                            <div class="row">
                                                <div class="justify-content-start" id="lists-of-subjects"></div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="btn-add-subject">Add Subject</button>
                                    </div>
                                </form>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
    </section>
    <script src="/assets/js/main/sidebar.js"></script>
    <script src="/assets/js/admin/subject.js"></script>
    </body>
</html>