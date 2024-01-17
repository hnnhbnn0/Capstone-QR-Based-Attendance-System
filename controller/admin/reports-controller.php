<?php
    require_once('../../controller/classes.php');

    $db = new Database();

    $conn = $db->StartConnection();

    Class Reports extends Database{

        public function GenerateReport(String $id, String $table){

            $conn = $this->StartConnection();

            if(!empty($id) && !empty($table)){

                $data = [];

                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.status, att.time, att.subcode FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Inactive') ORDER BY att.time DESC, att.date, att.subcode";
                        $result = mysqli_query($conn, $sql);

    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $data['status'][$i] = $row['status'];
                                $data['date'][$i] = date('F j, Y', strtotime($row['date']));
                                $data['time'][$i] = date('g:i:s A', strtotime($row['time']));
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-False|Section-False";
                        $data['rowlimit'] = $rows;
                   
               
                }

                echo json_encode($data);

           
        }

    }

    $reports = new Reports();

    // if(isset($_POST['id']) && isset($_POST['table'])){

    //     $id = $_POST['id'];
    //     $table = $_POST['table'];
    //     $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    //     $section = isset($_POST['section']) ? $_POST['section'] : '';

    //     $reports->GenerateReport($id, $table, $subject, $section);
    // }

?>