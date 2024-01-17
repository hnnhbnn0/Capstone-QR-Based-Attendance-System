<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Description here">
        <!----======== Tab Icon ======== -->
        <link rel="icon" href="/assets/img/AttenVax.png">
        <!----======== CSS ======== -->
        <link rel="stylesheet" href="/assets/css/style.css">
        <!----======== Bootstrap 5.2.0 CSS ======== -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!----===== Boxicons CSS ===== -->
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <!----===== Bootstrap Icons CSS ===== -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <!----===== Fontawesome Icons CSS ===== -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> -->
        <!----===== JQuery 3.6.0 JS ===== -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!----===== Bootstrap 5.2.0 JS ===== -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <style>
        @media(min-width: 420px){
            figure img{
                height: 80px;
            }
           
            .attenvax-login{
                background-color: rgba(255,255,255,1);
                
                border-radius: 25px !important;
                
            }
        }
        body{
           background: linear-gradient(to right, #1fa0ff, #12dafb);
            background-repeat: no-repeat;
            background-size: cover;
            background-position-x: center;
            background-position-y: center;
            object-fit: cover;
            overflow: hidden;
            min-height: 100vh;
            min-width: 100vw;
        }
    </style>
    <body>
            <div class="container alert pt-5">
                <div class="row mt-2 mt-sm-3 mt-lg-5">
                    
                    <div class="col-lg-12 ps-lg-0">
                        <div class="alert shadow mb-10 bg-white bg-opacity-70" data-aos="fade" data-aos-duration="1500" >
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <div class="text-center">
                                        <img class="img-fluid w-75" src="/assets/img/QR Code-bro.png" alt="Login Picture">
                                        <div class="fw-bolder h3 text-dark text-opacity-75 text-center">QR-Based Attendance System</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-5 mx-auto" style="max-width: 40%;" >
                                    <div class="content-002 d-none">
                                <form id="form-register-otp">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <div class="form-floating mb-4">
                                                    <input required type="number" name="otp" class="form-control" placeholder="One-time Password" id="input-otp" autocomplete="off">
                                                    <span class="valid-feedback position-absolute mt-0 pt-0" id="valid-otp"></span>
                                                    <span class="invalid-feedback position-absolute mt-0 pt-0" id="invalid-otp"></span>
                                                    <label>One Time Password</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="username" id="submit-username">
                                            <input type="hidden" name="password" id="submit-password">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-lg w-100" type="submit" id="btn-register-user" >Log in</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="content-003">
                                <form id="form-forgot-password">
                                    <div class="container mt-lg-5 px-lg-3">
                                        <div class="row mb-2">
                                                <div class="fw-bolder h2 text-primary text-center">Forgot Password</div>
                                        </div>
                                
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <div class="form-floating mb-4">
                                                    <input required type="text" name="username" class="form-control" placeholder="Username" id="input-forgot-username" autocomplete="off">
                                                    <span class="valid-feedback position-absolute mt-0 pt-0" id="valid-forgot-username"></span>
                                                    <span class="invalid-feedback position-absolute mt-0 pt-0" id="invalid-forgot-username"></span>
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                        <div class="col-lg-12">
                                            <div class="input-group justify-content-start">
                                                <div class="mb-3 d-flex text-truncate">
                                                    <div class="d-flex">
                                                        <div class="vr me-1 ms-1"></div>
                                                        <div class=" text-primary" style="font-size: 12px;">Please enter your email or username.</div>
                                                        <div class="text-danger">*</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary w-100" type="submit" id="btn-forgot-user">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                </form>
                            </div>

                            <div class="content-004 d-none">
                                <form id="form-forgot-password-002">

                                <div class="container mt-lg-5 px-lg-3">
                                        <div class="row mb-2">
                                                <div class="fw-bolder h2 text-primary text-center">OTP Verification</div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <div class="form-floating mb-4">
                                                    <input required type="number" name="OTP" class="form-control" placeholder="Username" id="input-forgot-otp" autocomplete="off">
                                                    <span class="valid-feedback position-absolute mt-0 pt-0" id="valid-forgot-otp"></span>
                                                    <span class="invalid-feedback position-absolute mt-0 pt-0" id="invalid-forgot-otp"></span>
                                                    <label>One Time Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <div class="input-group justify-content-start">
                                                <div class="mb-3 d-flex">
                                                    <div class="d-flex">
                                                        <div class="vr me-1 ms-1"></div>
                                                        <div class="text-muted">If the otp is correct, a temporary password will be sent via email.<span class="text-danger">*</span></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="UserName" id="input-forgot-otp-username">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-lg w-100" type="submit" id="btn-forgot-otp">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                </form>
                            </div>

                            <div class="content-005 d-none">
                                <form action="../controller/user-login.php" method="post" id="form-final-login">
                                    <input type="hidden" name="username" id="input-final-username">
                                    <input type="hidden" name="password" id="input-final-password">
                                    <input type="hidden" name="otp" id="input-final-otp">
                                </form>
                            </div>

                            <div class="content-006 d-none">
                            <div class="container mt-lg-5 px-lg-3">
                                <div class="alert alert-success">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <span class="fw-bolder">Success!</span> You have successfully recover your account.
                                        </div>
                                    </div>
                                </div>
                                <div class="text-start">
                                    <a href="/main/login.php" class="text-decoration-none bi bi-caret-left-fill"> Login</a>
                                </div>
                            </div>
                            </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>

            </div>
        
    
    </body>

    
    <script src="../assets/js/main/forgot.js"></script>
</html>