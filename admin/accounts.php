<?php require('../controller/admin/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Accounts</title>
        <?php include('../controller/header.php'); ?>
    </head>
    <body>
    <?php require('../controller/admin/sidebar.php'); ?>
    <section class="home">
        <div class="text">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-12 col-md-0 col-lg-12 text-truncate d-lg-block">
                        <div class="fs-5">
                            <ul class="nav nav-tabs justify-content-start border-0" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active text-sidebar text-uppercase bg-dynamic" data-bs-toggle="tab" data-bs-target="#teacher-tab-pane" type="button" role="tab" aria-controls="teacher-tab-pane" aria-selected="false">Faculty</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-sidebar text-uppercase bg-dynamic" data-bs-toggle="tab" data-bs-target="#student-tab-pane" type="button" role="tab" aria-controls="student-tab-pane" aria-selected="true">Students</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="teacher-tab-pane" role="tabpanel" aria-labelledby="teacher-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12 px-0">
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="row mb-2">
                                                <div class="col-lg-2">
                                                    <div class="input-group mb-2">
                                                        <button class="btn btn-primary w-100 h-100 text-truncate" type="button" data-bs-toggle="modal" data-bs-target="#tch-add-modal"> Add Teacher</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                    <div class="input-group mb-2">
                                                        <button class="btn btn-success w-50 h-100" type="button" data-bs-toggle="modal" data-bs-target="#import-data-modal"> Import</button>
                                                        <button class="btn btn-danger w-50 h-100" type="button" id="btn-export"> Export</button>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-lg-6">
                                                        <div class="input-group">
                                                        <input type="text" class="form-control" name="" id="search-teacher" placeholder="Search">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="wrapper overflow-auto">
                        
                                                    <table class="table table-light table-hover table-striped" data-cols-width="20,40,25,25,25" id="table-faculty">
                                                        <thead class="h5 text-center sticky-top bg-light" id="teacher-thead">
                                                            <tr>
                                                                                                                    
                                                                <th>Employee ID</th>
                                                                <th>Email</th>
                                                                <th>Full Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody class="h6 text-center" id="teacher-tbody">
                                                            <tr class="align-middle">
                                                                
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="student-tab-pane" role="tabpanel" aria-labelledby="student-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12 px-0">
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                                <div class="row mb-2">
                                                <div class="col-lg-2 d-block">
                                                    <div class="input-group mb-2">
                                                        <button class="btn btn-primary w-100 h-100 text-truncate" type="button" data-bs-toggle="modal" data-bs-target="#std-add-modal"> Add Student</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 d-block">
                                                    <div class="input-group mb-2">
                                                        <button class="btn btn-success w-50 h-100" type="button" data-bs-target="#import-data-stud-modal" data-bs-toggle="modal"> Import</button>
                                                        <button class="btn btn-danger w-50 h-100" type="button" onclick="ExportTableXLSX()"> Export</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 d-block">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" name="" id="search-student" placeholder="Search">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="wrapper overflow-auto">
                        
                                                    <table class="table table-light table-hover table-striped" data-cols-width="20,40,25,25,25,10,10" id="table-students">
                                                        <thead class="h5 text-center sticky-top bg-light" id="student-thead">
                                                            <tr>
                                                                <th>Account No.</th>
                                                                <th>Student ID</th>
                                                                <th>Email</th>
                                                                <th>Full Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="h6 text-center" id="student-tbody">
                                                            <tr class="align-middle">
                                                             
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>
                                                                    <span class="badge bg-success fs-6 rounded-pill mb-0">Verified</span>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-primary bi bi-eye-fill btn-sm"></button>
                                                                 
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

                    
                <div class="modal fade" id="tch-add-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title h4 fw-bolder">Add Teacher Account</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../controller/admin/faculty-add.php" method="post">
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Employee ID</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <input name="acctid" required type="text" class="form-control" maxlength="8" minlength="8" id="empID" placeholder="Employee ID" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Full Name</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <div class="input-group">
                                                <input name="firstname" required type="text" class="form-control"  id="fname" placeholder="First Name" autocomplete="off">
                                                <input name="middlename" class="form-control"  id="mname" placeholder="Middle Name" autocomplete="off">
                                                <input name="lastname"required type="text" class="form-control"  id="lname" placeholder="Last Name" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Email Address</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <input name="email" required type="email" class="form-control" id="email" placeholder="Email" autocomplete="off">   
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add Account</button>
                                    </div>
                                </form>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="modal fade" id="std-add-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title h4 fw-bolder">Add Student Account</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../controller/student/student-add.php" method="post">
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Student ID</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <input name="acctid" required type="text" class="form-control" maxlength="" minlength="10" id="stdID" placeholder="Student ID" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Full Name</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <div class="input-group">
                                                <input name="firstname" required type="text" class="form-control"  id="fname" placeholder="First Name" autocomplete="off">
                                                <input name="middlename"  class="form-control"  id="mname" placeholder="Middle Name" autocomplete="off">
                                                <input name="lastname"required type="text" class="form-control"  id="lname" placeholder="Last Name" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Email Address</div>
                                        </div>
                                        <div class="col-lg-9 d-block">
                                            <input name="email" required type="email" class="form-control" id="email" placeholder="Email" autocomplete="off">   
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-3 d-block align-self-center">
                                            <div class="mb-0 h5">Year Level</div>
                                        </div>
                                        <div class="col-lg-3 d-block">
                                            <input name="yearlevel" required type="yearlevel" class="form-control" id="yearlevel" placeholder="Year Level" autocomplete="off">   
                                        </div>
                                        <div class="col-lg-2 d-block align-self-center">
                                            <div class="mb-0 h5">Section</div>
                                        </div>
                                        <div class="col-lg-4 d-block">
                                            <input name="section" required type="section" class="form-control" id="section" placeholder="Section" autocomplete="off">   
                                        </div>
                                    </div>
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add Account</button>
                                    </div>
                                </form>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="modal fade" id="import-data-modal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title mb-0 h4 fw-bolder">Import Spreadsheet [<div class="bx bxs-download"></div>]</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <form id="form-add-faculty">
                                            <div class="modal-body h5 mb-0">
                                                <div class="row mb-2">
                                                    <label class="col-lg-3 col-form-label text-truncate">Academic Year</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <input readonly class="form-control active-year" type="text">
                                                            <input name="academic" class="form-control active-year" type="hidden">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label class="col-lg-3 col-form-label text-truncate">Semester</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <input readonly class="form-control active-sem" type="text">
                                                            <input required name="sem" class="form-control active-sem" type="hidden">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label class="col-lg-3 col-form-label text-truncate">Import Data</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <input required name="file" class="form-control" type="file" accept=".xls, .xlsx" id="input-xlsx">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-secondary" href="/assets/xlsx/Import-Template-Data-Teachers.xlsx" download="Import-Template-Data-Teachers.xlsx">Template</a>
                                                <button type="submit" name="import" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal" id="loading-modal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <div class="container">
                                                    <div class="row pt-4">
                                                        <div class="col-lg-12">
                                                            <div class="text-dark h2" id="loading-title"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-lg-12">
                                                            <div class="text-dark h6" id="loading-text"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row p-5" style="transform: scale(1.5)" id="loading-screen">
                                                        <div class="col-lg-12">
                                                            <div class="spinner-border text-primary h6" role="status">
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                </div>
                
                <div class="modal fade" id="import-data-stud-modal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title mb-0 h4 fw-bolder">Import Spreadsheet [<div class="bx bxs-download"></div>]</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <form id="form-import-students">
                                            <div class="modal-body h5 mb-0">
                                                <div class="row mb-2">
                                                    <label class="col-lg-3 col-form-label text-truncate">Academic Year</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <input readonly class="form-control active-year" type="text">
                                                            <input name="academic" class="form-control active-year" type="hidden">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label class="col-lg-3 col-form-label text-truncate">Semester</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <input readonly class="form-control active-sem" type="text">
                                                            <input required name="sem" class="form-control active-sem" type="hidden">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <label class="col-lg-3 col-form-label text-truncate">Import Data</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <input required name="file" class="form-control" type="file" accept=".xls, .xlsx" id="input-xlsx">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-secondary" href="/assets/xlsx/Import-Template-Data-Students.xlsx" download="Import-Template-Data-Students.xlsx">Template</a>
                                                <button type="submit" name="import" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal" id="loading-stud-modal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <div class="container">
                                                    <div class="row pt-4">
                                                        <div class="col-lg-12">
                                                            <div class="text-dark h2" id="loading-title"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-lg-12">
                                                            <div class="text-dark h6" id="loading-text"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row p-5" style="transform: scale(1.5)" id="loading-screen">
                                                        <div class="col-lg-12">
                                                            <div class="spinner-border text-primary h6" role="status">
                                                                <span class="visually-hidden">Loading...</span>
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
     <script src="/assets/js/admin/teachers.js"></script>
     <script src="/assets/js/admin/students.js"></script>
     <script src="/assets/js/main/tableToExcel.js"></script>
    </body>
</html>