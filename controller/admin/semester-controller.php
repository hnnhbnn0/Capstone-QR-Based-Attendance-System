<?php
    require('../../controller/classes.php');

    error_reporting(0);

    final class Semester extends Database{
        public function SemesterRun(String $id, String $search, bool $bool){
            $conn = $this->StartConnection();
            // $account_exists = $this->NumRows("SELECT * FROM accounts WHERE employee_id = '$id'");
            $data = [];
            if($id != ''){
                if($bool == true && $search != ''){
                    $sql = "SELECT * FROM semester WHERE acad_year LIKE '%$search%' OR sem LIKE '%$search%' OR status LIKE '$search' ";
                    $result = mysqli_query($conn, $sql);

                    $data['rowlimit'] = $this->NumRows($sql);

                    $i = 0;

                    while($array = mysqli_fetch_assoc($result)){
                        $data['id'][$i]= $array['id'];
                        $data['acad_year'][$i]= $array['acad_year'];
                        $data['semester'][$i] = $array['sem'];
                        $data['date'][$i] = $array['date'];
                        $data['time'][$i] = $array['time'];
                        $data['status'][$i] = $array['status'];
                        $i++;
                    }
                }elseif($bool == false && $search == ''){
                    $sql = "SELECT * FROM semester ORDER BY acad_year DESC, sem";
                    $result = mysqli_query($conn, $sql);

                    $i = 0;

                    $data['rowlimit'] = $this->NumRows($sql);
                    

                    while($array = mysqli_fetch_assoc($result)){
                        $data['id'][$i]= $array['id'];
                        $data['acad_year'][$i]= $array['acad_year'];
                        $data['acad_key'][$i]= $array['acad_key'];
                        $data['semester'][$i]= $array['sem'];
                        $data['status'][$i]= $array['status'];
                        $i++;
                    }
                }

                $data['active_sem'] = $this->SingleData("SELECT sem FROM `semester` WHERE `status` = 'Active'");
                $data['active_year'] = $this->SingleData("SELECT acad_year FROM `semester` WHERE `status` = 'Active'");
                
                header('Content-Type: application/json');
                echo json_encode($data);
                header_remove();
            }
        }
    }

    final Class Subjects extends Database{
        public function SubjectsRun(String $id, String $semester, String $yearlevel, String $search, bool $bool){
            
            $conn = $this->StartConnection();

            

            if($id != ''){

                if($search != '' && $bool == true){

                    $sql = "SELECT * FROM `curriculum` WHERE subcode LIKE '%$search%' OR subname LIKE '%$search%'";
                    $result = mysqli_query($conn, $sql);

                    $data['rowlimit'] = $this->NumRows($sql);

                    $i = 0;

                    while($subs = mysqli_fetch_assoc($result)){
                        $data['id'][$i]= $subs['id'];
                        $data['yearlevel'][$i] = $subs['yearlevel'];
                        $data['subcode'][$i] = $subs['subcode'];
                        $data['subname'][$i] = $subs['subname'];
                        $data['unitlec'][$i] = $subs['unitlec'];
                        $data['unitlab'][$i] = $subs['unitlab'];
                        $data['yearlevel'][$i] = $subs['yearlevel'];
                        $i++;
                    }
                }elseif($search == '' && $yearlevel != '' && $semester != '' && $bool == false){

                    $sql = "SELECT * FROM `curriculum` WHERE semester = '$semester' AND yearlevel = '$yearlevel'";

                    $result = mysqli_query($conn, $sql);

                    $data['rowlimit'] = $this->NumRows($sql);

                    $i = 0;

                    while($subs = mysqli_fetch_assoc($result)){
                        $data['id'][$i]= $subs['id'];
                        $data['yearlevel'][$i] = $subs['yearlevel'];
                        $data['subcode'][$i] = $subs['subcode'];
                        $data['subname'][$i] = $subs['subname'];
                        $data['unitlec'][$i] = $subs['unitlec'];
                        $data['unitlab'][$i] = $subs['unitlab'];
                        $data['semester'][$i] = $subs['semester'];
                        $i++;
                        
                    }
                }elseif(!empty($id) && empty($semester) && empty($yearlevel) && empty($search) && empty($bool)){

                    $sql = "SELECT cur.* FROM `curriculum` cur JOIN `semester` sem ON(cur.semester = sem.sem AND  sem.status = 'Active');";
                    $result = mysqli_query($conn, $sql);

                    $data['rowlimit'] = $this->NumRows($sql);

                    $i = 0;

                    while($subs = mysqli_fetch_assoc($result)){
                        $data['id'][$i]= $subs['id'];
                        $data['yearlevel'][$i] = $subs['yearlevel'];
                        $data['subcode'][$i] = $subs['subcode'];
                        $data['subname'][$i] = $subs['subname'];
                        $data['unitlec'][$i] = $subs['unitlec'];
                        $data['unitlab'][$i] = $subs['unitlab'];
                        $data['semester'][$i] = $subs['semester'];
                        $i++;
                    }
                }

                header('Content-Type: application/json');
                echo json_encode($data);
                header_remove();

            }
        }
    }


    if(isset($_POST['id'])){

        $sub = new Subjects();
        $sem = new Semester();

        $id = $_POST['id'];

        if(isset($_POST['category']) && isset($_POST['search'])){
            if($_POST['category'] == 'semester'){
                if(!empty($_POST['search'])){
                    $search = $_POST['search'];
                    $sem->SemesterRun($id, $search, true);
                }
            }elseif($_POST['category'] == 'subjects' && isset($_POST['search'])){
                if(!empty($_POST['search'])){
                    $search = $_POST['search'];
                    $sub->SubjectsRun($id, '', '', $search, true);

                }elseif(isset($_POST['yearlevel']) && isset($_POST['semester']) && empty($_POST['search'])){
                    $semester = $_POST['semester'];
                    $yearlevel = $_POST['yearlevel'];

                    $sub->SubjectsRun($id, $semester, $yearlevel, '', false);

                }
            }
        }elseif(isset($_POST['fetch'])){
            if($_POST['fetch'] == 'semester'){
                $sem->SemesterRun($id, '', false);
            }elseif($_POST['fetch'] == 'subjects'){
                $sub->SubjectsRun($id, '', '', '', '');
            }elseif($_POST['fetch'] == 'acad-year-semester'){
                $sem->SemesterRun($id, '', true);
            }
        }
    }

    // if(isset($_POST['id']) && isset($_POST['fetch'])){

    // }

    // yrVal = $('#select-yl').val()
    // semVal = $('#select-sem').val()

    // // Fetch data from the semester-controller
    // $.ajax({
    //     url: "/controller/semester-controller.php",
    //     method: "POST",
    //     data: {
    //         id: $('#account-id').val(),
    //         no: $('#account-id').val(),
    //         yearlevel: yrVal,
    //         semester: semVal,
    //     },
    //     success: function(response) {
    //         // console.log(response)
    //         localStorage.setItem('yearlevel', yrVal)
    //         localStorage.setItem('semester', semVal)
    //         appendSubjects(response)
    //     }
    // })

    // Execute Function SemesterRun from Class Semester
    // $sem = new Semester();
    // if(isset($_POST['search']) && isset($_POST['session'])){
    //     // Search from Semester
    //     $search = $_POST['search'];
    //     $session = $_POST['session'];
    //     $sem->SemesterRun($session, $search, true);
    // }elseif(isset($_POST['session'])){
    //     // Fetch All Semesters
    //     $session = $_POST['session'];
    //     $sem->SemesterRun($session, '', false);
    // }

    // // Execute Function SubjectsRun from Class Subjects
    // $sub = new Subjects();
    // if(isset($_POST['id']) && isset($_POST['search'])){
    //     // Search from Subjects
    //     $id = $_POST['id'];
    //     $search = $_POST['search'];
    //     $sub->SubjectsRun($id, '', '', $search, true);
    // }elseif(isset($_POST['id']) && isset($_POST['semester']) && isset($_POST['yearlevel'])){
    //     // Fetch All Subjects
    //     $id = $_POST['id'];
    //     $semester = $_POST['semester'];
    //     $yearlevel = $_POST['yearlevel'];
    //     $sub->SubjectsRun($id, $semester, $yearlevel, '', false);
    // }elseif(isset($_POST['id'])){
    //     $id = $_POST['id'];
    //     $sub->SubjectsRun($id, '', '', '', '');
    // }

    
//     if($('#search-record').val() != ''){

//         $.ajax({
//             url: "/controller/semester-controller.php",
//             method: "POST",
//             data: {
//                 id: $('#account-id').val(),
//                 category: 'semester',
//                 search: $('#search-record').val(),
//             },
//             success: function(response) {
//                 // console.log(response)
//                 appendSemester(response)

//             }
//         })
//     }else{
//         loadSemester()
//     }
// })
// });

// $(function(){
// $('#search-subject').keyup(function(){

//     if($('#search-subject').val() != ''){
//         $.ajax({
//             url: "/controller/semester-controller.php",
//             method: "POST",
//             data: {
//                 id: $('#account-id').val(),
//                 category: 'subject',
//                 search: $('#search-subject').val(),
//             },
//             success: function(response) {
//                 // console.log(response)
//                 appendSubjects(response)
//             }
//         })
//     }else{
//         loadSubjects()
//     }
// })
// });

// function loadSemester(){
// // Fetch data from the semester-controller
// $.ajax({
//     url: "/controller/semester-controller.php",
//     method: "POST",
//     data: {
//         id: $('#account-id').val(),
//         fetch: 'semester',
//     },
//     success: function(response) {
//         // console.log(response)
//         appendSemester(response)
//     }
// })
// }       

// function loadSubjects(){
// // Fetch data from the semester-controller
// $.ajax({
//     url: "/controller/semester-controller.php",
//     method: "POST",
//     data: {
//         id: $('#account-id').val(),
//         fetch: 'subjects',
//     },
//     success: function(response) {
//         // console.log(response)
//         appendSubjects(response)
//     }
// })
// }




?>
