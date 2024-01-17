<?php require('../controller/admin/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reports</title>
        <?php include('../controller/header.php'); ?>
    </head>
    <body>
    <?php include('../controller/admin/sidebar.php'); ?>
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
                                                <div class="h4 mb-0">Archive Attendance <span class="float-end" id="reports-table-name"></span></div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-12 px-0">
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="row mb-2">
                                                <div class="col-lg-4 d-block">
                                                    <div class="input-group mb-2">
                                                        <select name="" class="form-select select" id="teacher-list">   
                                                            <option disabled selected value="" class="dropdown-header">Teacher ID</option>
                                                            <option value="1">-</option>
                                                            <option value="2">-</option>
                                                            <option value="3">-</option>
                                                            <option value="4">-</option>
                                                            <option value="5">-</option>
                                                        </select>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 d-block">
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" name="" id="search-archive-list" placeholder="Search">
                                                    </div>
                                                </div>
                                            </div> 
                                           
                                            <div class="attendance-form">  
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
   <script src="/assets/js/admin/reports.js"></script>
   <script src="/assets/js/main/tableToExcel.js"></script>
    </body>
</html>