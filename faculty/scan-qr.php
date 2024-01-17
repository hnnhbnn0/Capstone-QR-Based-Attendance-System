<?php require('../controller/faculty/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Scan QR</title>
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
                                    <div class="col-lg-6">
                                        <div class="alert bg-dark mb-0 rounded-top rounded-0 ">
                                            <div class="row">
                                                <div class="col-lg-12 d-block align-middle mb-0">
                                                    <div class="h4 mb-0 text-center">Scan QR Code</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="row">
                                                <!-- <div class="text-center mt-2 position-relative">
                                                    <figure>
                                                        <img class="border border-2 border-dark" src="../assets/img/AttenVax.png" height="300px" alt="" style="height:220px; width:220px; object-fit: cover;">
                                                    </figure>
                                                </div> -->
                                                <figure class="d-flex justify-content-center mt-2 mb-0" id="qr-camera-result">
                                                    <div class="position-relative mw-100" style="height: 220px;">
                                                        <div id="video-wrapper" class="d-none">
                                                            <video id="video-file" class=""></video>
                                                        </div>
                                                        <div id="cam-qr-result" class="d-none"></div>
                                                        <img class="d-block border border-1 border-dark" id="img-qr" src="../../assets/img/scan-qr.svg" alt="" style="height:220px; width:220px; object-fit: cover;" ></img>
                                                    </div>
                                                </figure>
                                                <figcaption class="text-center">
                                                    <span class="mt-0 h6" id="session-text"></span>
                                                </figcaption>
                                                <div class="col-lg-2 d-block"></div>
                                                <div class="col-lg-8 d-block">
                                                    <div class="input-group mb-2 w-100 subject-camera-div">
                                                        <select id="select-subject" class="form-select rounded-0 subject-list rounded-start border-end-0 w-50">
                                                            <option value="" class="dropdown-header">Subjects</option>
                                                            <option value="123" class="dropdown-header">123</option>
                                                        </select>
                                                        <button disabled class="rounded-0 btn btn-success rounded-end border-start border-start-0 w-50" type="button" id="open-camera">Start Scan</button>
                                                    </div>
                                                    <div class="input-group mb-2 w-100 stop-camera-div d-none">
<!--                                                         
                                                    <button class="btn btn-danger w-50" type="button">IT 205</button> -->
                                                        <button class="btn btn-danger w-100" type="button" id="close-camera">Stop Scan</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 d-block"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="alert bg-dark mb-0 rounded-top rounded-0 ">
                                            <div class="row">
                                                <div class="col-lg-12 d-block align-middle mb-0">
                                                    <div class="h4 mb-0 text-center">Attendance Monitor</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-light rounded-bottom rounded-0">
                                            <div class="wrapper overflow-auto">
                                                <table class="table table-striped table-hovered h5 mb-0 flex-nowrap" id="attendance-monitor">
                                                    <thead class="h5 text-center mb-0 text-truncate" id="attendance-thead">
                                                        <tr>
                                                            <th>-</th>
                                                            <th>-</th>
                                                            <th>-</th>
                                                            <th>-</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="h6 text-center mb-0 text-truncate" id="attendance-tbody">
                                                        <tr>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="/assets/js/main/qr-scanner.js"></script>
    <script src="/assets/js/faculty/scan-qr.js"></script>
    <script src="/assets/js/main/sidebar.js"></script>
    </body>
</html>