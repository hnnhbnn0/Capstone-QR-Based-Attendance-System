<?php
    require('../../controller/classes.php');
    error_reporting(0);

    final Class Students extends Database{ 
        public function StudentsAcc(String $id, bool $bool, String $search){

            $conn = $this->StartConnection();
            
            if(!empty($id)){
                if($search != '' && $bool == true){
                    $sql = "SELECT a.* FROM `accounts` a JOIN `semester` s ON(a.acad_key = s.acad_key AND s.status = 'Active' AND a.userlevel = 'Student') WHERE a.firstname LIKE '%$search%' OR a.lastname LIKE '%$search%' OR a.acctid LIKE '%$search%' OR a.email LIKE '%$search%' OR a.status LIKE '%$search%' ;";
                    $result = mysqli_query($conn, $sql);
    
                    $data['rowlimit'] = $this->NumRows($sql);
    
                    $i = 0;
    
                    while($row = mysqli_fetch_assoc($result)){
                        $data['id'][$i] = $rowID = $row['id'];
                        $data['fullname'][$i] = $row['firstname'] . ' ' .$row['lastname'];
                        $data['acctno'][$i] = $row['acctno'];
                        $data['studentid'][$i] = $row['acctid'];
                        $data['email'][$i] = $row['email'];
                        $data['status'][$i] = $row['status'];
                        // $data['advisory'][$i] = $row['yearlevel'].$row['section'];
                        $data['firstname'][$i] = $row['firstname'];
                        $data['middlename'][$i] = $row['middlename'];
                        $data['lastname'][$i] = $row['lastname'];
                        $data['section'][$i] = $row['section'];
                        $data['yearlevel'][$i] = $row['yearlevel'];
                        // $data['subjects'][$i] = $row['subcode'];
                        $data['profilesrc'][$i] = $row['profilesrc'];
                        // $teachers = $row['subject_teachers'];
                        // $data['row_teach'] = $row['subject_teachers'];
    
                        // $data['teachers'][$i] = $this->SingleData("SELECT GROUP_CONCAT(' ',firstname, ' ', lastname) FROM `accounts` WHERE acctid IN($teachers)");
                        $i++;         
        
                    }
                }else{
                // SELECT a.firstname, a.lastname FROM `accounts` a JOIN `semester` s ON(a.sem = s.sem AND a.acad_year = s.acad_year AND a.status = 'Active' AND s.status = 'Active' AND a.acctid IN("20220001"))
                $sql = "SELECT a.* FROM `accounts` a JOIN `semester` s ON( a.acad_key = s.acad_key AND s.status = 'Active' AND a.userlevel = 'Student') ORDER BY a.status;";
                $result = mysqli_query($conn, $sql);

                $data['rowlimit'] = $this->NumRows($sql);

                $i = 0;

                while($row = mysqli_fetch_assoc($result)){
                    $data['id'][$i] = $rowID = $row['id'];
                    $data['fullname'][$i] = $row['firstname'] . ' ' .$row['lastname'];
                    $data['acctno'][$i] = $row['acctno'];
                    $data['studentid'][$i] = $row['acctid'];
                    $data['email'][$i] = $row['email'];
                    $data['status'][$i] = $row['status'];
                    // $data['advisory'][$i] = $row['yearlevel'].$row['section'];
                    $data['firstname'][$i] = $row['firstname'];
                    $data['middlename'][$i] = $row['middlename'];
                    $data['lastname'][$i] = $row['lastname'];
                    $data['section'][$i] = $row['section'];
                    $data['yearlevel'][$i] = $row['yearlevel'];
                    // $data['subjects'][$i] = $row['subcode'];
                    $data['profilesrc'][$i] = $row['profilesrc'];
                    // $teachers = $row['subject_teachers'];
                    // $data['row_teach'] = $row['subject_teachers'];

                    // $data['teachers'][$i] = $this->SingleData("SELECT GROUP_CONCAT(' ',firstname, ' ', lastname) FROM `accounts` WHERE acctid IN($teachers)");
                    $i++;
                }
            }
                header('Content-Type: application/json');
                echo json_encode($data);
                header_remove();
            }
        }
        
    }
    $stud = new Students();
    $db = new Database();
    if(isset($_POST['id'])){
        if(isset($_POST['search'])){
            if(!empty($_POST['search'])){
                $search = $_POST['search'];
                $stud->StudentsAcc($_POST['id'], true, $search);
            }
        }elseif(isset($_POST['fetch'])){
            if($_POST['fetch'] == 'students'){
                if(isset($_POST['search'])){
                    $search = $_POST['search'];
                    $stud->StudentsAcc($_POST['id'], true, $search);
                }else{
                    $stud->StudentsAcc($_POST['id'], false, '');
                }
               
            }
        }
        // elseif(isset($_POST['action'])){
        //     if($_POST['action'] == 'single-delete'){
        //         $acctno = $_POST['acctno'];
        //         $db->ExecuteQuery("DELETE FROM accounts WHERE acctno = '$acctno'");
        //     }elseif($_POST['action'] == 'multi-delete'){
        //         $array_id = implode(', ', $_POST['stud']);
        //         $db->ExecuteQuery("DELETE FROM accounts WHERE id IN($array_id)");
        //     }
        // }
    }
?>