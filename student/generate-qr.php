<?php require('../controller/student/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title> 
    <?php require('../controller/header.php'); ?>    
</head>
<body>
    <?php require('../controller/student/sidebar.php'); ?>
    <section class="home">
        <div class="text">
            

        <div class="container-fluid">

            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="alert bg-dark mb-0 rounded-top rounded-0 ">
                                        <div class="row">
                                            <div class="col-lg-12 d-block align-middle mb-0">
                                                <div class="h4 mb-0">Profile
                                                    <!-- <div class="text-warning float-end cursor-pointer" id="edit-pro">Edit</div> <div class="text-warning float-end cursor-pointer" id="cancel-pro">Cancel</div><div class="text-warning float-end me-2 cursor-pointer" id="save-pro">Save</div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-light rounded-bottom rounded-0">
                                        <div class="row">
                                            <form id="profile-upload">
                                                    <div class="text-center mt-2 position-relative">
                                                        <figure>
                                                            <input type="hidden" name="profile_id" class="prime-acctid">
                                                            <input type="file" name="file" accept=".jpg" id="edit-file" class="d-none">
                                                            <img id="edit-image" class="border border-2 border-light prime-profilesrc" src="../assets/img/user.png" height="200px" alt="" style="height:200px; width:200px; object-fit: cover;">
                                                            <!-- <button class="btn btn-primary w-50 h-100 mt-1" type="button" id="edit-profile">Upload Profile</button> -->
                                                            <div class="mt-2 text-muted mb-0 h5 prime-acctid"></div>
                                                        </figure>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="alert bg-dark mb-0 rounded-top rounded-0">
                                        <div class="row">
                                            <div class="col-lg-12 d-block align-middle mb-0">
                                                <div class="h4 mb-0">
                                                    QR
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-light rounded-bottom rounded-0">
                                        <div class="row">
                                            <div class="text-center mt-2 position-relative">
                                                <figure>
                                                    <div id="view-qr-code" class="d-none"></div>
                                                    <img id="qr-image" class="border border-4 border-light prime-qr-src " height="200px" alt="" style="height:200px; width:200px; object-fit: cover;">
                                                    <a class="btn btn-primary w-50 h-100 mt-1 prime-qr-download " type="button" id="qr-download">Download QR</a>
                                                    
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row mb">
                                        <form id="personal-info">
                                                <div class="alert bg-dark mb-0 rounded-top rounded-0 ">
                                                    <div class="row">
                                                        <div class="col-lg-12 d-block align-middle mb-0">
                                                            <div class="h4 mb-0">Personal Information <div class="text-warning float-end cursor-pointer" id="edit-info">Edit</div> <div class="text-warning float-end cursor-pointer" id="cancel-info">Cancel</div><div class="text-warning float-end me-2 cursor-pointer" id="save-info" type="submit">Save</div></div> 
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 d-block align-middle mb-0">
                                                    <div class="h4 mb-0">
                                                        <div class="alert alert-light rounded-bottom rounded-0">
                                                            <div class="show-profile">
                                                                <div class="row h3">
                                                                    <div class="col-lg-4 h5 mb-2 align-self-center">
                                                                        <div class="">Name</div>
                                                                        <input type="hidden" name="personal_id" class="prime-acctid">
                                                                    </div>
                                                                    <div class="col-lg-8 h5 mb-0 align-self-center">
                                                                        <input disabled type="text" name="fullname" class="form-control prime-fullname" id="view-fullname"></input>
                                                                        <!-- <div class="input-group">
                                                                        <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <input required type="text" name="firstname" class="form-control view-namegroup view-personal-info prime-firstname" id="group-firstname" placeholder="First Name"></input>
                                                                                </div>

                                                                                <div class="col-lg-4">
                                                                                    <input required type="text" name="middlename" class="form-control view-namegroup view-personal-info prime-middlename" id="group-middle" placeholder="Middle Name"></input>
                                                                                </div>

                                                                                <div class="col-lg-4">
                                                                                <input required type="text" name="lastname" class="form-control view-namegroup view-personal-info prime-lastname" id="group-lastname" placeholder="Last Name"></input>
                                                                                </div>
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="my-3">
                                                        <div class="row h3">
                                                            <div class="col-lg-4 h5 mb-2 align-self-center">
                                                                <div class="">Gender</div>
                                                            </div>
                                                            <div class="col-lg-8 h5 mb-0 align-self-center">
                                                                <select disabled name="gender" class="form-control  prime-gender" id="view-gender">
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <hr class="my-3">
                                                        <div class="row h3">
                                                            <div class="col-lg-4 h5 mb-2 align-self-center">
                                                                <div class="">Birthdate</div>
                                                            </div>
                                                            <div class="col-lg-8 h5 mb-0 align-self-center">
                                                                <input disabled type="date" name="birthday" class="form-control  prime-birthday" id="view-birthday"></input>
                                                            </div>
                                                        </div>
                                                        <hr class="my-3">
                                                        <div class="row h6 mt-3">
                                                        <div class="col-lg-4 h5 mb-2 align-self-center">
                                                            <div class="">Vaccine Status</div>
                                                            </div>
                                                            <div class="col-lg-8 h5 mb-0 align-self-center">
                                                            <!-- <input disabled type="text" name="vaxstatus" class="form-control view-personal-info" id="view-vaxstatus"> -->
                                                            <select disabled name="vaxstatus" class="form-control view-personal-info prime-vaxstat" id="view-vaxstatus">
                                                                <option disabled selected value="">--SELECT--</option>
                                                                <option value="Unvaccinated">Unvaccinated</option>
                                                                <option value="Vaccinated">Vaccinated</option>
                                                            </select>
                                                        </div>
                                                        </div>    


                                                        <hr class="my-3">
                                                        <div class="row h3">
                                                            <div class="col-lg-3 h5 mb-2 align-self-center">
                                                                <div class="">Year Level</div>
                                                            </div>
                                                            <div class="col-lg-3 h5 mb-0 align-self-center">
                                                                <input disabled type="yearlevel" name="yearlevel" class="form-control view-personal-info prime-yearlevel" id="view-yearlevel"></input>
                                        
                                                            </div>
                                                            <div class="col-lg-3 h5 mb-2 align-self-center">
                                                                <div class="">Section</div>
                                                            </div>
                                                            <div class="col-lg-3 h5 mb-0 align-self-center">
                                                                <input disabled type="section" name="section" class="form-control view-personal-info prime-section" id="view-section"></input>
                                        
                                                            </div>
                                                        </div>
                                                    </div>      
                                                </div>
                                                </div>
                                                </div>
                                        </form>
                                        <div class="row">
                                        <form id="account-info">
                                    <div class="alert bg-dark mb-0 rounded-top rounded-0 ">
                                        <div class="row">
                                            <div class="col-lg-12 d-block align-middle mb-0">
                                                <div class="h4 mb-0">Account Information <div class="text-warning float-end cursor-pointer" id="edit-acct">Edit</div> <div class="text-warning float-end cursor-pointer" id="cancel-acct">Cancel</div><div class="text-warning float-end me-2 cursor-pointer" id="save-acct">Save</div></div> 
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-block align-middle mb-0">
                                        <div class="h4 mb-0">
                                            <div class="alert alert-light rounded-bottom rounded-0">
                                                <div class="show-profile">
                                                    <div class="row h3">
                                                        <div class="col-lg-4 h5 mb-2 align-self-center">
                                                            <div class="">Password</div>
                                                        </div>
                                                        <div class="col-lg-4 h5 mb-2 align-self-center d-none">
                                                            <input type="hidden" name="account_id" class="prime-acctid">
                                                        </div>
                                                        <div class="col-lg-8 h5 mb-0 align-self-center">
                                                            <input disabled type="text" name="email" class="form-control account-info prime-email" id="view-email"></input>
                                                        </div>
                                                    </div>
                                                    <hr class="my-3">
                                                    <div class="row h3">
                                                        <div class="col-lg-4 h5 mb-2 align-self-center">
                                                            <div class="">Password</div>
                                                        </div>
                                                        <div class="col-lg-8 h5 mb-0 align-self-center">
                                                        <input disabled type="text" name="password" class="form-control account-info" id="view-password"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                            </div>
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
    </section>

    <script src="/assets/js/main/sidebar.js"></script>
    <script src="/assets/js/main/profile.js"></script>
</body>
</html>