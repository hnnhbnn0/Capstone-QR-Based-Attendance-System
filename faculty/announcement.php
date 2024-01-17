<?php require('../controller/faculty/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Announcement</title>
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
                                    <div class="col-lg-7">
                                        <div class="alert bg-dark mb-0 rounded-top rounded-0">
                                            <div class="row">
                                                <div class="col-lg-12 d-block align-middle mb-0">
                                                    <div class="h4 mb-0 text-truncate">Create Announcement</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-light">
                                            <div class="row overflow-auto" style="height: calc(100vh - 230px);">
                                                <div class="col-lg-12">
                                                    <div class="row mb-2 mt-1 d-none">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <div class="input-group-text">Sender</div>
                                                                <input readonly type="hidden" name="" value="Professor Kian Guillemer" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2 mt-1">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <div class="input-group-text">Receiver</div>
                                                                <select id="select-year" class="form-select">
                                                                    <option value="" class="dropdown-header">Year Level</option>
                                                                    <option value="1">First Year</option>
                                                                    <option value="2">Second Year</option>
                                                                    <option value="3">Third Year</option>
                                                                    <option value="4">Fourth Year</option>
                                                                </select>
                                                                <select id="select-section" class="form-select">
                                                                    <option value="" class="dropdown-header">Section</option>
                                                                    <option value="A">Section A</option>
                                                                    <option value="B">Section B</option>
                                                                    <option value="C">Section C</option>
                                                                    <option value="D">Section D</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <div class="input-group-text">Title</div>
                                                                <input id="input-title" type="text" name="" class="form-control" placeholder="Title" style="width: 20% !important;">    
                                                                <select name="" id="select-subject" class="form-select">
                                                                    <option value="" class="dropdown-header">- Select Subject Code -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <textarea id="input-content" type="text" style="height: calc(100vh - 380px)" name="" class="form-control" placeholder="Content"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6"></div>
                                                        <div class="col-lg-6">
                                                            <div class="input-group">
                                                                <button id="btn-save-announcement" class="btn btn-primary w-100" type="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="alert bg-dark mb-0 rounded-top rounded-0 ">
                                            <div class="row">
                                                <div class="col-lg-12 d-block align-middle mb-0">
                                                    <div class="h4 mb-0 text-truncate">Posted Announcements</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-light">
                                            <div class="">
                                                <div class="row" style="height: calc(100vh - 230px); overflow-x:hidden; overflow-y:auto;">
                                                    <div class="col-lg-12">
                                                        <div id="announcements"></div>
                                                        <!-- <div class="row mb-2">
                                                            <div class="col-lg-12">
                                                                <div class="card bg-primary ">
                                                                    <div class="card-body">
                                                                        <div class="card-title h5">Card Title</div>
                                                                        <div class="card-text h6">Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-lg-12">
                                                                <div class="card bg-success ">
                                                                    <div class="card-body">
                                                                        <div class="card-title h5">Card Title</div>
                                                                        <div class="card-text h6">Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-lg-12">
                                                                <div class="card bg-danger ">
                                                                    <div class="card-body">
                                                                        <div class="card-title h5">Card Title</div>
                                                                        <div class="card-text h6">Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-lg-12">
                                                                <div class="card bg-warning ">
                                                                    <div class="card-body">
                                                                        <div class="card-title h5">Card Title</div>
                                                                        <div class="card-text h6">Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-lg-12">
                                                                <div class="card bg-dark ">
                                                                    <div class="card-body">
                                                                        <div class="card-title h5">Card Title</div>
                                                                        <div class="card-text h6">Some quick example text to build on the card title and make up the bulk of the card's content.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
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
    <script src="/assets/js/faculty/announcement.js"></script>
    </body>
</html>