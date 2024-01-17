<?php
    require('../../controller/classes.php');

    $db = new Database();

    $conn = $db->StartConnection();

    final class Dashboard extends Database{
        public function FacultyDashboard($acctid){

            $conn = $this->StartConnection();

            
            $acad_key = $this->SingleData("SELECT acad_key FROM semester WHERE status = 'Active'") ;
           
            $data = [];

            $sql1 = "SELECT COUNT(*) AS SUBCODE FROM subject WHERE acctid = '$acctid' AND acad_key = '$acad_key' ";
            $data['active_subcode'] = $this->SingleData($sql1);

            $sql2 = "SELECT COUNT(*) AS CLASS FROM subject WHERE acctid = '$acctid' AND acad_key = '$acad_key' GROUP BY section , yearlevel ";
            $data['active_section'] = $this->SingleData($sql2);
            
            $sql3 = "SELECT ass.yearlevel, ass.section, cur.subname  FROM accounts acc JOIN subject ass ON(acc.acctid = ass.acctid AND ass.acctid = '$acctid') JOIN semester sett ON(ass.acad_key = sett.acad_key AND sett.acad_key='$acad_key' AND sett.status = 'Active') JOIN curriculum cur ON (ass.subcode = cur.subcode)";
            $result3 = mysqli_query($conn,$sql3);

            $data['rowlimit'] = $this->NumRows($sql3);
            $i = 0;
            while ($row = mysqli_fetch_assoc($result3)){
                $data['subname'][$i] = $row['subname'] ;
                $data['yearsec'][$i] = $row['yearlevel'].$row['section'];
                
                $i++;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
          

            }

          
        }
    if(isset($_POST['acctid'])){
        $acctid = mysqli_real_escape_string($conn, $_POST['acctid']);
        // $acad_year = mysqli_real_escape_string($conn, $_POST['acad_year']);
        // $semester = mysqli_real_escape_string($conn, $_POST['semester']);
        (new Dashboard())->FacultyDashboard($acctid);
    }
    // var_dump($_POST)
?>