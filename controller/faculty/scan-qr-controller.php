<?php

    require('../../controller/classes.php');
    $db = new Database();


    if(isset($_POST['qr']) && isset($_POST['encoder'])){

        $conn = $db->StartConnection();

        $qr = mysqli_real_escape_string($conn, $_POST['qr']);
        $teacher_id = mysqli_real_escape_string($conn, $_POST['encoder']);
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);

        $fetch = $db->SingleRow("SELECT acctid, firstname, lastname, section, yearlevel FROM accounts WHERE qr_id = '$qr'");

        $data = [];

        $section = $fetch['section'];
        $yearlevel = $fetch['yearlevel'];
        $studentID = $fetch['acctid'];
        $fullname = $fetch['firstname'] . ' ' . $fetch['lastname'];
        $year_sec = $fetch['yearlevel'] . $fetch['section'];
        date_default_timezone_set('Asia/Manila');
        $datetime = date('Y-m-d g:i:s A');

        if($db->SingleData("SELECT COUNT(*) FROM `accounts` WHERE `qr_id` = '$qr' AND `userlevel` = 'Student'") != 0){
            if($db->SingleData("SELECT COUNT(*) FROM `attendance` WHERE `qr_id` = '$qr' AND `session` = '$session'") == 0){
                

                $info = $db->SingleRow("SELECT section, subcode, yearlevel FROM `subject` WHERE `acctid` = '$teacher_id' AND `subcode` = '$subject'");
                $att_sec = $info['section'];
                $att_sub = $info['subcode'];
                $att_yr = $info['yearlevel'];

                if($section == $att_sec && $subject == $att_sub && $yearlevel == $att_yr){
                    $acad_key = $db->SingleData("SELECT acad_key FROM `semester` WHERE `status` = 'Active'");

                    $sql = "INSERT INTO attendance (qr_id, student_id, status, section, yearlevel, teacher_id, session, subcode, acad_key) VALUES ('$qr', '$studentID', 'Present', '$section', '$yearlevel', '$teacher_id', '$session', '$subject', '$acad_key')";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $data['icon'] = 'success';
                        $data['title'] = 'Attendance Success!';
                        $data['html'] = '<div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student ID</span></div><div class="col-sm-8 text-start"><span class="text-primary">'.$studentID.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student Name</span></div><div class="col-sm-8 text-start"><span class="text-primary">'.$fullname.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Year/Section</span></div><div class="col-sm-8 text-start"><span class="text-primary">BSIT '.$year_sec.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Date/Time</span></div><div class="col-sm-8 text-start"><span class="text-primary">'.$datetime.'</span></div></div>
                        ';
                    }else{
                        $data['icon'] = 'error';
                        $data['title'] = 'Attendance Failed!';
                        $data['html'] = '<div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student ID</span></div><div class="col-sm-8 text-start"><span class="text-danger">NULL</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student Name</span></div><div class="col-sm-8 text-start"><span class="text-danger">NULL</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Year/Section</span></div><div class="col-sm-8 text-start"><span class="text-danger">NULL</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Reason</span></div><div class="col-sm-8 text-start"><span class="text-danger">NULL</span></div></div>';
                    }
                }elseif($section == $att_sec && $subject != $att_sub && $yearlevel != $att_year){
                    $data['icon'] = 'warning';
                    $data['title'] = 'Attendance Failed!';
                    $data['html'] = '<div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student ID</span></div><div class="col-sm-8 text-start"><span class="text-danger">'.$studentID.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student Name</span></div><div class="col-sm-8 text-start"><span class="text-danger">'.$fullname.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Year/Section</span></div><div class="col-sm-8 text-start"><span class="text-danger">BSIT '.$year_sec.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Reason</span></div><div class="col-sm-8 text-start"><span class="text-danger">Subject Mismatched</span></div></div>
                    ';
                }elseif($section != $att_sec && $subject == $att_sub &&  $yearlevel != $att_year){
                    $data['icon'] = 'warning';
                    $data['title'] = 'Attendance Failed!';
                    $data['html'] = '<div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student ID</span></div><div class="col-sm-8 text-start"><span class="text-danger">'.$studentID.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student Name</span></div><div class="col-sm-8 text-start"><span class="text-danger">'.$fullname.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Year/Section</span></div><div class="col-sm-8 text-start"><span class="text-danger">BSIT '.$year_sec.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Reason</span></div><div class="col-sm-8 text-start"><span class="text-danger">Section Mismatched</span></div></div>
                    ';
                }elseif($section != $att_sec && $subject != $att_sub && $yearlevel != $att_year){
                    $data['icon'] = 'warning';
                    $data['title'] = 'Attendance Failed!';
                    $data['html'] = '<div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student ID</span></div><div class="col-sm-8 text-start"><span class="text-danger">'.$studentID.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Student Name</span></div><div class="col-sm-8 text-start"><span class="text-danger">'.$fullname.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Year/Section</span></div><div class="col-sm-8 text-start"><span class="text-danger">BSIT '.$year_sec.'</span></div></div><div class="row"><div class="col-sm-4 text-start"><span class="fw-bolder">Reason</span></div><div class="col-sm-8 text-start"><span class="text-danger">Credentials Mismatched</span></div></div>
                    ';
                }else{
                    $data['icon'] = 'warning';
                    $data['title'] = 'Attendance Failed!';
                    $data['html'] = 'You have scanned an invalid QR code.';
                }
            }else{
                $data['icon'] = 'warning';
                $data['title'] = 'Attendance Warning!';
                $data['html'] = 'You have scanned an invalid QR Code.';
            }
        }else{
            $data['icon'] = 'warning';
            $data['title'] = 'Attendance Warning!';
            $data['html'] = 'You have scanned an invalid QR Code.';
        }

        echo json_encode($data);
        header('Content-type: application/json');
        header_remove();
        mysqli_close($conn);

    }elseif(isset($_POST['action']) && isset($_POST['session'])){

        
        set_time_limit(0);

        $conn = $db->StartConnection();

        $session = $_POST['session'];
        // SELECT GROUP_CONCAT('"', acc.acctid, '"') AS `absentees` FROM `accounts` acc JOIN `attendance` att ON(acc.qr_id = att.qr_id AND att.session = '8bdb75d159a9a7b57da6')
        if($db->SingleData("SELECT COUNT(*) FROM `attendance` WHERE `session` = '$session'") > 0){

            $att_data = $db->SingleRow("SELECT teacher_id, acad_key, section, yearlevel, subcode FROM attendance WHERE `session` = '$session'");
            $teacher_id = $att_data['teacher_id'];
            $yearlevel = $att_data['yearlevel'];
            $section = $att_data['section'];
            $acad_key = $att_data['acad_key'];
            $subject = $att_data['subcode'];

            $absentees_id = $db->SingleData("SELECT GROUP_CONCAT('\"', acc.acctid, '\"') AS `absentees` FROM `accounts` acc JOIN `attendance` att ON(acc.qr_id = att.qr_id AND att.session = '$session')");

            $sql = "SELECT `qr_id` FROM `accounts` WHERE `acctid` NOT IN($absentees_id) AND `userlevel` = 'Student' AND `section` = '$section' AND `yearlevel` = '$yearlevel'";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){

                $qr = $row['qr_id'];
                $sql = "INSERT INTO attendance (qr_id, status, section, yearlevel, teacher_id, session, subcode, acad_key) VALUES ('$qr', 'Absent', '$section', '$yearlevel', '$teacher_id', '$session', '$subject', '$acad_key')";
                $execute = mysqli_query($conn, $sql);

            }
        }

       
    }
?>