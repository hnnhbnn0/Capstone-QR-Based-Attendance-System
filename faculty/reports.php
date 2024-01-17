<?php require('../controller/faculty/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reports</title>
        <?php include('../controller/header.php'); ?>
    </head>
    <body>
    <?php include('../controller/faculty/sidebar.php'); ?>
    <section class="home">  
        <div class="text">
            <div class="container-fluid">

                <div class="row">
                    
                    <div class="">
                        <div class="row">
                            <div class="container">
                                <div class="row">
                                    <div class="alert bg-dark mb-0 rounded-top rounded-0 ">
                                        <div class="row">
                                            <div class="col-lg-12 d-block align-middle mb-0">
                                                <div class="h4 mb-0">Reports <span class="float-end" id="reports-table-name"></span></div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-12 px-0">
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="row mb-2">
                                                <div class="col-lg-7 d-block">
                                                    <div class="input-group mb-2">
                                                        <select name="" class="form-select select" id="select-category-list">   
                                                            <option disabled selected value="" class="dropdown-header">Category</option>
                                                            <option value="Attendance">Attendance</option>
                                                            <option value="Absentees">Absentees</option>
                                                            <option value="Drop List">Drop List</option>
                                                            <option value="Student List">Student List</option>
                                                            <option value="Vaccine Status">Vaccine Status</option>
                                                        </select>
                                                        <select name="" class="form-select subject-list" id="select-subject-list">
                                                            <option value="" class="dropdown-header">Subjects</option>
                                                        </select>
                                                        <select name="" class="form-select select" id="select-section-list">   
                                                            <option value="" class="dropdown-header">Section</option>
                                                            <option value="A">Section A</option>
                                                            <option value="B">Section B</option>
                                                            <option value="C">Section C</option>
                                                            <option value="D">Section D</option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 d-block">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" name="" id="search-report-list" placeholder="Search">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="category-form">  
                                                <div class="row mb-2">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-light table-hover">
                                                            <thead class="h5 text-center sticky-top" id="table-category-thead">
                                                                <tr class="align-middle">
                                                                    <th class="text-center">- Select Category First -</th>
                                                                    
                                                                </tr>
                                                                <tbody class="h6 text-center" id="table-category-tbody">
                                                                <tr class="align-middle">
                                                                    <td>- No data to display -</td>
                                                                </td> 
                                                            </tbody>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="attendance-form d-none">  
                                                <div class="row mb-2">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-light table-hover" id="table-attendance" data-cols-width="25,30,15,25,30,25,25">
                                                            <thead class="h5 text-center sticky-top" id="table-attendance-thead">
                                                                <tr class="align-middle">
                                                                    <th class="text-center" data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-b-a-s="thin">Student ID</th>
                                                                    <th class="text-center" data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-b-a-s="thin">Name</th>
                                                                    <th class="text-center" data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-b-a-s="thin">Yr & Section</th>
                                                                    <th class="text-center" data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-b-a-s="thin">Subject</th>
                                                                    <th class="text-center" data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-b-a-s="thin">Status</th>
                                                                    <th class="text-center" data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-b-a-s="thin">Date</th>
                                                                    <th class="text-center" data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-b-a-s="thin">Time</th>
                                                                </tr>
                                                                <tbody class="h6 text-center" id="table-attendance-tbody">
                                                                    <tr class="align-middle">
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                            </tbody>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-5 d-block">
                                                        
                                                    </div>
                                                    <div class="col-lg-2 d-block">
                                                        <div class="wrapper overflow-auto">
                                                         
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 d-block">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="absentees-form d-none">  
                                                <div class="row mb-2">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-light table-hover" id="table-absentees">
                                                            <thead class="h5 text-center sticky-top" id="table-absentees-thead">
                                                                <tr class="align-middle">
                                                                    <th class="text-center">Student ID</th>
                                                                    <th class="text-center">Name</th>
                                                                    <th class="text-center">Yr & Section</th>
                                                                    <th class="text-center">Subject</th>
                                                                    <th class="text-center">Status</th>
                                                                    <th class="text-center">Date</th>
                                                                    <th class="text-center">Time</th>
                                                                </tr>
                                                                <tbody class="h6 text-center" id="table-absentees-tbody">
                                                                    <tr class="align-middle">
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                            </tbody>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-5 d-block">
                                                        
                                                    </div>
                                                    <div class="col-lg-2 d-block">
                                                        <div class="wrapper overflow-auto">
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 d-block">
                                                       
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="droplist-form d-none">  
                                                <div class="row mb-2">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-light table-hover" id="table-droplist">
                                                            <thead class="h5 text-center sticky-top" id="table-droplist-thead">
                                                                <tr class="align-middle">
                                                                    <th class="text-center">Student ID</th>
                                                                    <th class="text-center">Name</th>
                                                                    <th class="text-center">Yr & Section</th>
                                                                    <th class="text-center">Subject</th>
                                                                    <th class="text-center">Absences</th>
                                                                </tr>
                                                                <tbody class="h6 text-center" id="table-droplist-tbody">
                                                                    <tr class="align-middle">
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                            </tbody>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-4 d-block">
                                                        
                                                    </div>
                                                    <div class="col-lg-4">
                                                    <div class="input-group mb-2">
                                                       
                                                    </div>
                                                     </div>
                                                    <div class="col-lg-4 d-block">
                                                       
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="student-list-form d-none">  
                                                <div class="row mb-2">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-light table-hover" id="table-student-list">
                                                            <thead class="h5 text-center sticky-top" id="table-student-list-thead">
                                                                <tr class="align-middle">
                                                                    <th class="text-center">Student ID</th>
                                                                    <th class="text-center">Email</th>
                                                                    <th class="text-center">Name</th>
                                                                    <th class="text-center">Yr & Section</th>
                                                                    <th class="text-center">Subject</th>
                                                                </tr>
                                                                <tbody class="h6 text-center" id="table-student-list-tbody">
                                                                    <tr class="align-middle">
                                                                        <td>2023</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                                    <tr class="align-middle">
                                                                        <td>2024</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                                    <tr class="align-middle">
                                                                        <td>2025</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                                    <tr class="align-middle">
                                                                        <td>2026</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                            </tbody>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-5 d-block">
                                                        
                                                    </div>
                                                    <div class="col-lg-2 d-block">
                                                        <div class="wrapper overflow-auto">
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 d-block">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vaccine-form d-none">  
                                                <div class="row mb-2">
                                                    <div class="wrapper overflow-auto">
                                                        <table class="table table-light table-hover" id="table-vaccine">
                                                            <thead class="h5 text-center sticky-top" id="table-vaccine-thead">
                                                                <tr class="align-middle">
                                                                    <th class="text-center">Student ID</th>
                                                                    <th class="text-center">Name</th>
                                                                    <th class="text-center">Email</th>
                                                                    <th class="text-center">Yr & Section</th>
                                                                    <th class="text-center mw-0 text-truncate">Subjects</th>
                                                                    <th class="text-center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="h6 text-center" id="table-vaccine-tbody">
                                                                <tr class="align-middle">
                                                                    <td>-</td>
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
                                                <div class="row mb-2">
                                                    <div class="col-lg-5 d-block">
                                                        
                                                    </div>
                                                    <div class="col-lg-2 d-block">
                                                        <div class="wrapper overflow-auto">
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 d-block">
                                                       
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
   <script src="/assets/js/faculty/reports.js"></script>
   <script src="/assets/js/main/tableToExcel.js"></script>
    </body>
</html>