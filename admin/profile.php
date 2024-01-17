<?php require('../controller/admin/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title> 
    <?php require('../controller/header.php'); ?>    
</head>
<body>
    <?php require('../controller/admin/sidebar.php'); ?>
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
                                                    <img id="edit-image" class="border border-2 border-light prime-profilesrc" src="https://i.pinimg.com/736x/04/34/be/0434be5626c7776ca7ca7b0ada3abc4a.jpg" height="200px" alt="" style="height:200px; width:200px; object-fit: cover;">
                                                    <!-- <button class="btn btn-primary w-50 h-100 mt-1" type="button" id="edit-profile">Upload Profile</button> -->
                                                    <div class="mt-2 text-muted mb-0 h5 prime-acctid" id="display-id">-</div>
                                                </figure>
                                            </div>
                                        </form>
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
                                                                        <input  type="text" name="middlename" class="form-control view-namegroup view-personal-info prime-middlename" id="group-middle" placeholder="Middle Name"></input>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                     <input required type="text" name="lastname" class="form-control view-namegroup view-personal-info prime-lastname" id="group-lastname" placeholder="Last Name"></input>
                                                                    </div>
                                                              </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <hr class="my-3">
                                                    <div class="row h3">
                                                        <div class="col-lg-4 h5 mb-2 align-self-center">
                                                            <div class="">Gender</div>
                                                        </div>
                                                        <div class="col-lg-8 h5 mb-0 align-self-center">
                                                            <select disabled name="gender" class="form-control prime-gender active" id="view-gender">
                                                                <option value="">--SELECT--</option input>
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
                                                            <input disabled type="date" name="birthday" class="form-control prime-birthday" id="view-birthday"></input>
                                                            <!-- <div class="input-group">
                                                                <input disabled type="text" name="month" class="form-control view-birthgroup view-personal-info" id="group-month" placeholder="Month"></input>
                                                                
                                                                <input disabled type="text" name="day" class="form-control view-birthgroup view-personal-info" id="group-day" placeholder="Day"></input>
                                                               
                                                                <input disabled type="text" name="year" class="form-control view-birthgroup view-personal-info" id="group-year" placeholder="Year"></input>
                                                            </div> -->
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
                                                        <div class="">Email</div>
                                                            <input type="hidden" name="acct_info_id" class="prime-acctid">
                                                        </div>
                                                        <div class="col-lg-8 h5 mb-0 align-self-center">
                                                            <input disabled type="" name="email" class="form-control account-info prime-email" id="view-email"></input>
                                                            <span class="position-absolute invalid-feedback" id="invalid-email"></span>
                                                        </div>
                                                    </div>
                                                    <hr class="my-3">
                                                    <div class="row h3">
                                                        <div class="col-lg-4 h5 mb-2 align-self-center">
                                                            <div class="">Password</div>
                                                        </div>
                                                        <div class="col-lg-8 h5 mb-0 align-self-center">
                                                        <input disabled type="text" name="password" minlength="8" class="form-control account-info" id="view-password"></input>
                                                        <span class="position-absolute invalid-feedback" id="invalid-password"></span>
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