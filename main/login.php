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
            <div class="row mt-2 mt-sm-3 mt-lg-5 mb-2">
                <div class="col-lg-12 ps-lg-0">
                    <input type="hidden" value="<?php if(isset($_SESSION['content'])){echo $_SESSION['content']; unset($_SESSION['content']);} ?>" id="hide-show-otp">
                    <div class="alert shadow mb-10 bg-white bg-opacity-70" data-aos="fade" data-aos-duration="1500">
                        <div class="row">
                            <!-- system description -->
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="text-center">
                                    <img class="img-fluid w-75" src="/assets/img/QR Code-bro.png" alt="Login Picture">
                                    <div class="fw-bolder h3 text-dark text-opacity-75 text-center">QR-Based Attendance System</div>
                                </div>
                            </div>

                            <!-- log in form -->
                            <div class="col-md-6">                                  
                                <!-- log in credentials -->
                                <div class="content-1  d-none mb">
                                    <form action="../main/verify.php" method="post">
                                        <div class="container mt-lg-5 px-lg-3">
                                            <div class="row mb-3">
                                                <div class="fw-bolder h1 text-primary text-center">Login</div>
                                            </div>
                                            <div class="row mb-3 mt-5">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-10">
                                                    <input required type="email" class="form-control <?php if(isset($_SESSION['email_err'])){echo $_SESSION['email_err']; unset($_SESSION['email_err']);} ?>" name="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email']; unset($_SESSION['email']);} ?>" placeholder="Email" autocomplete="off" id="_email">
                                                </div>
                                                <div class="col-lg-1"></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-10">
                                                    <div class="input-group">
                                                        <input required minlength="8" type="password" name="password" class="form-control <?php if(isset($_SESSION['password_err'])){echo $_SESSION['password_err']; unset($_SESSION['password_err']);} ?>" placeholder="Password" id="_pass" autocomplete="off">
                                                        <button class="btn btn-primary bi bi-eye-slash " id="_togglepass" type="button"></button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1"></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-10 text-end">
                                                    <a href="../main/forgot_pass.php" class="text-decoration-none text-primary">Forgot Password?</a>
                                                </div>
                                                <div class="col-lg-1"></div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-10">
                                                    <button class="btn btn-primary w-100" name="login" type="submit">Log In</button>
                                                </div>
                                                <div class="col-lg-1"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- OTP Verification -->
                                <div class="content-2">
                                    <form action="../main/verify.php" method="post">
                                        <div class="alert  py-5">
                                            <div class="row mb-5">
                                                <div class="fw-bolder h1 text-primary text-center">OTP Verification</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-10">
                                                    <input type="hidden" name="email" id="email-value" value="<?php if(isset($_SESSION['email_success'])){echo $_SESSION['email_success']; unset($_SESSION['email_success']);} ?>">
                                                    <input type="hidden" name="password" value="<?php if(isset($_SESSION['password_success'])){echo $_SESSION['password_success']; unset($_SESSION['password_success']);} ?>">
                                                    <div class="input-group">
                                                        <input required type="number" class="form-control <?php if(isset($_SESSION['otp_err'])){echo $_SESSION['otp_err']; unset($_SESSION['otp_err']);} ?>" name="otp" placeholder="One Time Password" autocomplete="off">
                                                        <button class="btn btn-primary" type="button" id="resend-otp">Send</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1"></div>
                                            </div>
                                            <div class="row mb-5">
                                            <div class="col-lg-1"></div>
                                                <div class="col-lg-10">
                                                    <button class="btn btn-primary w-100" name="submitOTP" type="submit">Verify</button>
                                                </div>
                                                <div class="col-lg-1"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <script type="text/javascript">
            const _togglepass = document.getElementById("_togglepass")
            const _pass = document.getElementById("_pass");

                _togglepass.addEventListener("click", function () {
                // toggle the type attribute
                const type = _pass.getAttribute("type") === "password" ? "text" : "password";
                _pass.setAttribute("type", type);
                
                // toggle the icon
                this.classList.toggle("bi-eye");
            });
        </script>

        <script>
            function ShowContent(){
                var value = $('#hide-show-otp').val()
                if(value == 1){
                    console.log('Show OTP, Hide Login')
                    $('.content-1').addClass('d-none');
                    $('.content-2').removeClass('d-none');
                    console.log('CONTENT A: <?php if(isset($_SESSION['content'])){echo $_SESSION['content']; unset($_SESSION['content']);} ?>')
                }else{
                    console.log('Show Login, Hide OTP')
                    console.log('<?php if(isset($_SESSION['otp'])){echo $_SESSION['otp'];} ?>')
                    $('.content-2').addClass('d-none');
                    $('.content-1').removeClass('d-none');
                    console.log('CONTENT B: <?php if(isset($_SESSION['content'])){echo $_SESSION['content']; unset($_SESSION['content']);} ?>')
                }
            }

            ShowContent();

            $(document).ready(function(){
                var count;
                var counter;
                clearInterval(counter);
                $('#resend-otp').click(function(){
                    email = $('#email-value').val()
                    SendOTP(email)
                    count = 31;
                    counter = setInterval(timer, 1000);
                    function timer(){
                    count-=1;
                    if (count <= 0){
                        clearInterval(counter);
                        $('#resend-otp').text('Resend')
                        $('#resend-otp').prop('disabled', false)
                    }else{
                        $('#resend-otp').text(count)
                        $('#resend-otp').prop('disabled', true)
                    }
                }
                });
            });

            function SendOTP(email){
                $.ajax({
                    url:'../main/verify.php',
                    method: 'POST',
                    data:{
                        email_OTP: email,
                    }
                })
            }
            $(function(){
                $('#_pass').keyup(function(){
                    $('#_pass').removeClass('is-invalid')
                })
            })
        </script>
    </body>

    <script>AOS.init();</script>

</html>