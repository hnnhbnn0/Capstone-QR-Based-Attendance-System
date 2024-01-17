<?php
    // Add or Delete Semester Records from the Database

    require('../../controller/classes.php');
    // error_reporting(0);

    
    $db = new Database();

    if(isset($_POST['action'])){

        if($_POST['action'] == 'add'){
            $academicVal = $db->PostSecure($_POST['academic']);
            $semesterVal = $db->PostSecure($_POST['semester']);
            if($db->NumRows("SELECT * FROM `semester` WHERE acad_year = '$academicVal' AND sem = '$semesterVal'") == 0){

                $db->ExecuteQuery("INSERT INTO semester (acad_key, acad_year, sem) VALUES ('$acad_key', '$academicVal', '$semesterVal')");

                $data = [];

                $data['title'] = "Create Succesfully!";
                $data['html'] = "<span class=\"text-success fw-bolder\">$academicVal</span>, <span class=\"text-success fw-bolder\">$semesterVal</span> is successfully created.";
                $data['icon'] = "success";
            }else{
                $data['title'] = "Create Failed!";
                $data['html'] = "<span class=\"text-danger fw-bolder\">$academicVal</span>, <span class=\"text-danger fw-bolder\">$semesterVal</span> is unsuccessfully created.";
                $data['icon'] = "warning";
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        }elseif($_POST['action'] == 'delete'){
            $delete_id = $db->PostSecure($_POST['id']);
            $sql = "DELETE FROM `semester` WHERE id = '$delete_id'";
            $db->ExecuteQuery($sql);
        }elseif($_POST['action'] == 'activate'){
            
            if($_POST['sync'] == 'true'){

                $conn = $db->StartConnection();

                $activate_id = $db->PostSecure($_POST['id']);

                $disabled = $db->ExecuteQuery("UPDATE `semester` SET `status` = 'Inactive'");

                $enabled = $db->ExecuteQuery("UPDATE `semester` SET `status` = 'Active' WHERE `id` = '$activate_id'");

                $acad_key = $db->SingleData("SELECT `acad_key` FROM `semester` WHERE `id` = '$activate_id'");

                $qrupdate = $db->ExecuteQuery("UPDATE `accounts` SET `qr_id` = uuid() AND `acad_key` = '$acad_key'");

                // $keys = "SELECT * FROM `semester` GROUP BY `acad_key` ORDER BY `id` ASC";
                // $result = mysqli_query($conn, $result);

                // $arr = [];
                // $a = 0;
                // $start = 2020;
                // $end = 2120;
                // for($i = $start; $i <= $end; $i++){
                //     if($i%2==0){
                //         $year = strval(intval($i).intval($i+1))."F";
                //     }else{
                //         $year = strval(intval($i).intval($i+1))."S";
                //     }
                //     $arr[$a] = $year;
                //     $a++;
                // }
                // if($index = array_search($acad_key, $arr) != ''){
                //     $prev = $arr[$index-1];
                // }

                // $db->ExecuteQuery("UPDATE `accounts` SET `qr_id` = uuid(), acad_key = '$acad_key' WHERE `acad_key` = '$prev' AND `userlevel` = 'Student'");

                $semesterText = $semesterVal == 'First Semester' ? '1st Sem' : ($semesterVal == 'Second Semester' ? '2nd Sem' : '');

                if($enabled == true){
                    $data = [];
                    $data['title'] = "Activate Success!";
                    $data['html'] = "ACTIVATED <span class=\"text-success fw-bolder\">$academicVal, $semesterText</span> with <span class=\"text-danger fw-bolder\">$i data's.</span>";
                    $data['icon'] = "success";
                }elseif($enabled == false){
                    $data = [];
                    $data['title'] = "Activate Failed!";
                    $data['html'] = "NOT ACTIVATED <span class=\"text-success fw-bolder\">$academicVal, $semesterText</span> with <span class=\"text-danger fw-bolder\">$i data's.</span>";
                    $data['icon'] = "warning";
                }   
                header('Content-Type: application/json');
                echo json_encode($data);

                // $fetch = $db->SingleRow("SELECT * FROM `semester` WHERE `id` = '$activate_id'");

                //     $academicVal = $fetch['acad_year'];
                //     $semesterVal = $fetch['sem'];
  
                //     if(!empty($semesterVal) && !empty($academicVal)){

                //         $gen = new GenerateString();
                //         $conn = $db->StartConnection();

                //         // $sql2 = "WITH ranked_accounts AS (
                //         //     SELECT m.*, ROW_NUMBER() OVER (PARTITION BY acctno ORDER BY semester DESC, acad_year) AS rn
                //         //     FROM accounts AS m
                //         //   )
                //         //   SELECT * FROM ranked_accounts WHERE rn = 1";

                //         // $sql2 = "SELECT a.* FROM accounts a LEFT JOIN accounts b ON (a.acctno = b.acctno AND a.acad_year < b.acad_year) WHERE b.id IS NULL;";
                //         // $sql2 = "SELECT a.* FROM accounts a LEFT JOIN accounts b ON (a.acctno = b.acctno AND a.id < b.id) WHERE b.id IS NULL AND a.userlevel = 'Teacher' OR a.userlevel = 'Student';";
                //         // $sql2 = "SELECT a.* FROM `accounts` a LEFT JOIN `accounts` b ON (a.acctno = b.acctno AND a.id < b.id) WHERE b.id IS NULL AND b.userlevel = 'Student' OR b.userlevel = 'Teacher' AND a.userlevel = 'Student' OR a.userlevel = 'Teacher'";
                //         // $result2 = mysqli_query($conn, $sql2);
                        
                //         // $checkRow = $db->NumRows("SELECT acad_year, semester FROM accounts WHERE acad_year = '$academicVal' AND semester = '$semesterVal'");
                //         // $i = 0;

                //         // if($checkRow <= 0){
                           
                //         //     while($row = mysqli_fetch_assoc($result2)){
                //         //         $acctno = $row['acctno'];
                //         //         $acctid = $row['acctid'];
                //         //         $acctprefix = $row['acctprefix'];
                //         //         $acctint = $row['acctint'];
                //         //         $email = $row['email'];
                //         //         $hashed_password = $row['hashed_password'];
                //         //         $contact = $row['contact'];
                //         //         $address = $row['address'];
                //         //         $firstname = $row['firstname'];
                //         //         $middlename = $row['middlename'];
                //         //         $lastname = $row['lastname'];
                //         //         $bday = $row['bday'];
                //         //         $bmonth = $row['bmonth'];
                //         //         $byear = $row['byear'];
                //         //         $vaxstat = $row['vaxstat'];
                //         //         $vaxtype = $row['vaxtype'];
                //         //         $profilesrc = $row['profilesrc'];
                //         //         $vaxsrc = $row['vaxsrc'];
                //         //         $medsrc = $row['medsrc'];
                //         //         $userlevel = $row['userlevel'];
                //         //         $otp = $gen->GenerateOTP(6);
                //         //         $subcode = '';
                //         //         $section = '';
                //         //         $activity = 'Inactive';
                //         //         $acad_year = $academicVal;
                //         //         $semester = $semesterVal;
                                

                //         //         $sql3 = "INSERT INTO `accounts` (acctno, acctid, acctprefix, acctint, email, hashed_password, contact, address, firstname, middlename, lastname, gender, bday, bmonth, byear, status, vaxstat, vaxtype, profilesrc, vaxsrc, medsrc, userlevel, otp, subcode, yearlevel, section, acad_year, semester) VALUES ('$acctno', '$acctid', '$acctprefix', '$acctint', '$email', '$hashed_password', '$contact', '$address', '$firstname', '$middlename', '$lastname', '$gender', '$bday', '$bmonth', '$byear', '$activity', '$vaxstat', '$vaxtype', '$profilesrc', '$vaxsrc', '$medsrc', '$userlevel', '$otp', '$subcode', '$yearlevel', '$section', '$acad_year', '$semester')";
                //         //         $db->ExecuteQuery($sql3);

                //         //         $i++;
                //         //     }
                //         // }


                //     }
            }elseif($_POST['sync'] == 'false'){
                $activate_id = $db->PostSecure($_POST['id']);
                $disabled = $db->ExecuteQuery("UPDATE `semester` SET `status` = 'Inactive'");
                $enabled = $db->ExecuteQuery("UPDATE `semester` SET `status` = 'Active' WHERE `id` = '$activate_id'");
    
                if($fetch = $db->SingleRow("SELECT * FROM `semester` WHERE `id` = '$activate_id'")){
                    $academicVal = $fetch['acad_year'];
                    $semesterVal = $fetch['sem'];
                    
                    $semesterText = $semesterVal == 'First Semester' ? '1st Sem' : ($semesterVal == 'Second Semester' ? '2nd Sem' : '');

                    if($enabled == true){
                        $data = [];
                        $data['title'] = "Activate Success!";
                        $data['html'] = "ACTIVATED <span class=\"text-success fw-bolder\">$academicVal, $semesterText</span>.";
                        $data['icon'] = "success";
                    }elseif($enabled == false){
                        $data = [];
                        $data['title'] = "Activate Failed!";
                        $data['html'] = "<span class=\"text-danger\">$academicVal, $semesterText is not activated.</span>";
                        $data['icon'] = "warning";

                    }
                    header('Content-Type: application/json');
                    echo json_encode($data);
                }
            }
        }
    }
?>