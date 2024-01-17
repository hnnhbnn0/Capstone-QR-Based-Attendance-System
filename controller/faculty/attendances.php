<?php

require('../../controller/classes.php');

final Class StudentList extends Database{
    // public function GetStudents(String $id, String $subject, String $section, String $search, bool $bool){
    public function GetStudents(String $id,  bool $bool){
        $conn = $this->StartConnection();

        $data = [];

        if($id != ''){

            // if($search != '' && $section == '' && $subject == ''  && $bool == true){

            //     $sql = "SELECT a.firstname, a.lastname, a.acctid, a.yearlevel, a.section, a.status, a.email, a.middlename FROM `accounts` a JOIN `settings` s ON(a.acad_year = s.acad_year AND a.semester = s.semester AND s.status = 'Active' AND a.userlevel = 'Student' AND a.status = 'Active') WHERE a.firstname LIKE '%$search%' OR a.lastname LIKE '%$search%' ORDER BY a.section ASC, a.acctid;";
            //     $result = mysqli_query($conn, $sql);

            //     $data['rowlimit'] = $this->NumRows($sql);

            //     $i = 0;

            //     while($row = mysqli_fetch_assoc($result)){
            //         $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
            //         $data['acctid'][$i] = $row['acctid'];
            //         $data['yearlevel'][$i] = $row['yearlevel'];
            //         $data['status'][$i] = $row['status'];
            //         $data['section'][$i] = $row['section'];
            //         $data['email'][$i] = $row['email'];
            //         $data['firstname'][$i] = $row['firstname'];
            //         $data['middlename'][$i] = $row['middlename'];
            //         $data['lastname'][$i] = $row['lastname'];
                    
            //         // $data['id'][$i] = $row['id'];
            //         // $data['subject'][$i] = $row['subject_code'];
            //         // $data['date'][$i] = date('F j, Y', strtotime($row['date']));
            //         // $data['time'][$i] = date('h:i:s A', strtotime($row['time']));
            //         // $data['filesrc'][$i] = $row['filesrc'];
            //         // $data['excused'][$i] = $row['excused'];
            //         // $data['reason'][$i] = $row['reason'];
            //         // $data['filename'][$i] = $row['filename'];
            //         $i++;
            //     }
            // }elseif($search == '' && $section != '' && $subject != '' && $bool == false){

            //     $sql = "SELECT a.firstname, a.lastname, a.acctid, a.yearlevel, a.section, a.status, a.email, a.middlename FROM `accounts` a JOIN `settings` s ON(a.acad_year = s.acad_year AND a.semester = s.semester AND s.status = 'Active' AND a.userlevel = 'Student' AND a.status = 'Active') JOIN `assign` ass ON(a.section = ass.section AND a.yearlevel = ass.yearlevel AND ass.section = '$section' AND ass.acctid = '$id' AND ass.subcode = '$subject') ORDER BY a.section ASC, a.acctid;";
            //     // $sql = "SELECT a.firstname, a.lastname, a.acctid, a.yearlevel, a.section, a.status, a.email, a.middlename FROM `accounts` a JOIN `settings` s ON(a.acad_year = s.acad_year AND a.semester = s.semester AND s.status = 'Active' AND a.userlevel = 'Student' AND a.subject_teachers_list LIKE '%$id-$subject%' AND a.section = '$section') ORDER BY a.section ASC, a.acctid;";
            //     // $sql = "SELECT a.firstname, a.lastname, a.acctid, a.yearlevel, a.section, att.id, q.subject_code, att.status, att.date, att.time, att.filesrc FROM `accounts` a JOIN `settings` s ON(a.acad_year = s.acad_year AND a.semester = s.semester) JOIN `attendance` att ON(a.acctid = att.acctno) JOIN `qr` q ON(att.qr = q.qr) WHERE att.status = 'Absent' AND q.subject_code = '$subject' AND q.section = '$section' AND a.section = '$section' ORDER BY q.subject_code ASC, a.section;";
            //     $result = mysqli_query($conn, $sql);

            //     $data['rowlimit'] = $this->NumRows($sql);

            //     $i = 0;

            //     while($row = mysqli_fetch_assoc($result)){
            //         $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
            //         $data['acctid'][$i] = $row['acctid'];
            //         $data['yearlevel'][$i] = $row['yearlevel'];
            //         $data['status'][$i] = $row['status'];
            //         $data['section'][$i] = $row['section'];
            //         $data['email'][$i] = $row['email'];
            //         $data['firstname'][$i] = $row['firstname'];
            //         $data['middlename'][$i] = $row['middlename'];
            //         $data['lastname'][$i] = $row['lastname'];
            //         // $data['id'][$i] = $row['id'];
            //         // $data['subject'][$i] = $row['subject_code'];
            //         // $data['date'][$i] = date('F j, Y', strtotime($row['date']));
            //         // $data['time'][$i] = date('h:i:s A', strtotime($row['time']));
            //         // $data['filesrc'][$i] = $row['filesrc'];
            //         // $data['excused'][$i] = $row['excused'];
            //         // $data['reason'][$i] = $row['reason'];
            //         // $data['filename'][$i] = $row['filename'];
            //         $i++;
                    
            //     }
            // }elseif($search == '' && $section == '' && $subject != '' && $bool == false){

            //     $sql = "SELECT a.firstname, a.lastname, a.acctid, a.yearlevel, a.section, a.status, a.email, a.middlename FROM `accounts` a JOIN `settings` s ON(a.acad_year = s.acad_year AND a.semester = s.semester AND s.status = 'Active' AND a.userlevel = 'Student' AND a.status = 'Active')  JOIN `assign` ass ON(a.section = ass.section AND a.yearlevel = ass.yearlevel AND ass.acctid = '$id' AND ass.subcode = '$subject') ORDER BY a.section ASC, a.acctid;";
            //     // $sql = "SELECT a.firstname, a.lastname, a.acctid, a.yearlevel, a.section, att.id, q.subject_code, att.status, att.date, att.time, att.filesrc FROM `accounts` a JOIN `settings` s ON(a.acad_year = s.acad_year AND a.semester = s.semester) JOIN `attendance` att ON(a.acctid = att.acctno) JOIN `qr` q ON(att.qr = q.qr) WHERE att.status = 'Absent' AND q.subject_code = '$subject' ORDER BY q.subject_code ASC, a.section;";
            //     $result = mysqli_query($conn, $sql);

            //     $data['rowlimit'] = $this->NumRows($sql);

            //     $i = 0;

            //     while($row = mysqli_fetch_assoc($result)){
            //         $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
            //         $data['acctid'][$i] = $row['acctid'];
            //         $data['yearlevel'][$i] = $row['yearlevel'];
            //         $data['status'][$i] = $row['status'];
            //         $data['section'][$i] = $row['section'];
            //         $data['email'][$i] = $row['email'];
            //         $data['firstname'][$i] = $row['firstname'];
            //         $data['middlename'][$i] = $row['middlename'];
            //         $data['lastname'][$i] = $row['lastname'];
            //         // $data['id'][$i] = $row['id'];
            //         // $data['subject'][$i] = $row['subject_code'];
            //         // $data['date'][$i] = date('F j, Y', strtotime($row['date']));
            //         // $data['time'][$i] = date('h:i:s A', strtotime($row['time']));
            //         // $data['filesrc'][$i] = $row['filesrc'];
            //         // $data['excused'][$i] = $row['excused'];
            //         // $data['reason'][$i] = $row['reason'];
            //         // $data['filename'][$i] = $row['filename'];
            //         $i++;
                    
            //     }
            // }elseif($search == '' && $section != '' && $subject == '' && $bool == false){

            //     $sql = "SELECT a.firstname, a.lastname, a.acctid, a.yearlevel, a.section, a.status, a.email, a.middlename FROM `accounts` a JOIN `settings` s ON(a.acad_year = s.acad_year AND a.semester = s.semester  AND s.status = 'Active' AND a.status = 'Active')  JOIN `assign` ass ON(a.section = ass.section AND a.yearlevel = ass.yearlevel AND ass.section = '$section' AND ass.acctid = '$id') GROUP BY a.acctid ORDER BY a.section ASC, a.acctid;";

            //     $result = mysqli_query($conn, $sql);

            //     $data['rowlimit'] = $this->NumRows($sql);

            //     $i = 0;

            //     while($row = mysqli_fetch_assoc($result)){
            //         $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
            //         $data['acctid'][$i] = $row['acctid'];
            //         $data['yearlevel'][$i] = $row['yearlevel'];
            //         $data['status'][$i] = $row['status'];
            //         $data['section'][$i] = $row['section'];
            //         $data['email'][$i] = $row['email'];
            //         $data['firstname'][$i] = $row['firstname'];
            //         $data['middlename'][$i] = $row['middlename'];
            //         $data['lastname'][$i] = $row['lastname'];
            //         // $data['id'][$i] = $row['id'];
            //         // $data['subject'][$i] = $row['subject_code'];
            //         // $data['date'][$i] = date('F j, Y', strtotime($row['date']));
            //         // $data['time'][$i] = date('h:i:s A', strtotime($row['time']));
            //         // $data['filesrc'][$i] = $row['filesrc'];
            //         // $data['excused'][$i] = $row['excused'];
            //         // $data['reason'][$i] = $row['reason'];
            //         // $data['filename'][$i] = $row['filename'];
            //         $i++;
                    
            //     }
            if(!empty($id) && empty($bool)){

                $sql = "SELECT a.firstname, a.lastname, a.acctid, a.middlename, sb.yearlevel, sb.section, att.date, att.time, sb.subcode FROM accounts a JOIN semester s ON(a.acad_key = s.acad_key AND s.status = 'Active' AND a.status = 'Active') JOIN attendance att ON(att.qr_id = a.qr_id AND att.status = 'Present') JOIN subject sb ON(att.section = sb.section) GROUP BY a.acctid ORDER BY sb.section ASC, a.acctid;";
                $result = mysqli_query($conn, $sql);

                $data['rowlimit'] = $this->NumRows($sql);

                $i = 0;

                while($row = mysqli_fetch_assoc($result)){
                    $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                    $data['acctid'][$i] = $row['acctid'];
                    $data['yearlevel'][$i] = $row['yearlevel'];
                    $data['status'][$i] = $row['status'];
                    // $data['yearsec'][$i] = $row['yearlevel'] . ' ' . $row['section'];
                    $data['section'][$i] = $row['section'];
                    $data['firstname'][$i] = $row['firstname'];
                    $data['middlename'][$i] = $row['middlename'];
                    $data['lastname'][$i] = $row['lastname'];
                    // $data['id'][$i] = $row['id'];
                    $data['subcoode'][$i] = $row['subcode'];
                    $data['date'][$i] = date('F j, Y', strtotime($row['date']));
                    $data['time'][$i] = date('h:i:s A', strtotime($row['time']));
                    // $data['filesrc'][$i] = $row['filesrc'];
                    // $data['excused'][$i] = $row['excused'];
                    // $data['reason'][$i] = $row['reason'];
                    // $data['filename'][$i] = $row['filename'];
                    $i++;
                }
            }
            // $data['id_subject'] = $id.'-'.$subject;
            // $data['section_input'] = $section; 
            // $data['subject_input'] = $subject; 
            header('Content-Type: application/json');
            echo json_encode($data);
            header_remove();

        }
    }
}
$abs = new StudentList();
$db = new Database();
if(isset($_POST['id'])){

    $id = $_POST['id'];
    // $section = $_POST['section'];
    // $subject = $_POST['subject'];

    
    // if(empty($subject) && empty($section)){
        $abs->GetStudents($id, '', '', '', '');
    // }elseif(!empty($subject) && !empty($section)){
    //     $abs->GetStudents($id, $subject, $section, '', false);
    // }elseif(!empty($subject) && empty($section)){
    //     $abs->GetStudents($id, $subject, '', '', false);
    // }elseif(empty($subject) && !empty($section)){
    //     $abs->GetStudents($id, '', $section, '', false);
    // }


// }elseif(isset($_POST['id']) && isset($_POST['search'])){
//     $id = $_POST['id'];
//     $search = $_POST['search'];
//     $abs->GetStudents($id, '', '', $search, true);
}

?>