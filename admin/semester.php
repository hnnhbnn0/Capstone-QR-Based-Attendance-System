<?php require('../controller/admin/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Semester</title>
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
                                            <div class="col-lg-5 d-block align-middle mb-0">
                                                <div class="h4 mb-0">Academic Year and Term</div>
                                            </div>
                                            <div class="col-lg-7 d-block align-self-center">
                                                <div class="text-warning fst-italic h6 mb-0 float-lg-end"><span class="fw-bolder">Note:</span> Click the check symbol to make <span class="fw-bolder">Academic Year</span> and <span class="fw-bolder">Term</span> active.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 px-0">
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="row mb-2">
                                                <div class="col-lg-2 d-block">
                                                    <div class="input-group mb-2">
                                                        <button class="btn btn-primary w-100 h-100" type="button" data-bs-toggle="modal" data-bs-target="#semester-modal"> Add Semester</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 d-block">
                                                    <!-- <div class="input-group mb-2">
                                                        <button class="btn bg-dark-blue text-light w-100 h-100" type="button" id="btn-sync-data">Sync Previous</button>
                                                    </div> -->
                                                </div>
                                                <div class="col-lg-2 d-block"></div>
                                                <div class="col-lg-6 d-block">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="" id="search-record" placeholder="Search">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-striped table-hover table-dark table-bordered-0">
                                                            <thead id="semester-thead">
                                                                <tr class="h5 mb-0 text-center text-truncate">
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                    <th>-</th>
                                                                  
                                                                </tr>
                                                            </thead>
                                                            <tbody id="semester-tbody">
                                                                <tr class="h5 mb-0 text-center text-truncate">
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
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
                                </div>
                                <div class="row">
                                    <div class="alert bg-dark mb-0 rounded-top rounded-0">
                                        <div class="row">
                                            <div class="col-lg-12 d-block align-middle mb-0">
                                                <div class="h4 mb-0 text-truncate">Academic Program Evaluation <div class="float-lg-end"><span id="active-term" class="text-warning h5"></span></div></div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 px-0">
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="row mb-2">
                                                
                                                <div class="col-lg-3 d-block">
                                                    <div class="input-group mb-2">
                                                        <select name="" class="form-select" id="select-yl">
                                                            <option selected disabled value="" class="dropdown-header">Year Level</option>
                                                            <option value="1">First Year</option>
                                                            <option value="2">Second Year</option>
                                                            <option value="3">Third Year</option>
                                                            <option value="4">Fourth Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-block">
                                                    <div class="input-group mb-2">
                                                        <select name="" class="form-select" id="select-sem">
                                                            <option selected disabled value="" class="dropdown-header">Semester</option>
                                                            <option value="First Semester">First</option>
                                                            <option value="Second Semester">Second</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 d-block">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" name="" id="search-subject" placeholder="Search">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-striped table-hover table-dark table-bordered-0">
                                                            <thead id="subject-thead">
                                                                <tr class="h6 mb-0 text-center text-truncate">
                                                                    <th>--</th>  
                                                                    <th>--</th>
                                                                    <th>--</th>
                                                                    <th>--</th>
                                                                    <th>--</th>
                                                                    <th>--</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="subject-tbody">
                                                                <tr class="h6 mb-0 text-center text_truncate align-middle">
                                                                    <td>--</td>
                                                                    <td>--</td>
                                                                    <td>--</td>
                                                                    <td>--</td>
                                                                    <td>--</td>
                                                                    <td>--</td>
                                                                </tr>
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
                </div>

                <div class="modal fade" id="semester-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title h4">Add Session</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-2">
                                    <div class="col-lg-3 d-block align-self-center">
                                        <div class="mb-0 h5">Academic Year</div>
                                    </div>
                                    <div class="col-lg-9 d-block">
                                        <select class="form-select" id="select-academic-year">

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-3 d-block align-self-center">
                                        <div class="mb-0 h5">Semester</div>
                                    </div>
                                    <div class="col-lg-9 d-block">
                                        <select class="form-select" id="select-semester">
                                            <option disabled selected value="" class="dropdown-header">- Select Semester -</option>
                                            <option value="First Semester">First Semester</option>
                                            <option value="Second Semester">Second Semester</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="btn-save-record">Save Record</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="/assets/js/admin/semester.js"></script>
    <script src="/assets/js/main/sidebar.js"></script>
    </body>
</html>