<?php
    require('../../controller/classes.php');
    error_reporting(0);
    final Class Teachers extends Database{
        public function SubjectsRun(String $id, String $selector, bool $bool){
            
            $conn = $this->StartConnection();
        
            if(!empty($id) && $bool == true && $selector == 'All'){

                $data = [];
                $sql = "SELECT c.subcode, c.subname, c.yearlevel FROM curriculum c JOIN semester sm ON (c.semester = sm.sem) WHERE sm.status = 'Active';";
                $result = mysqli_query($conn, $sql);

                $data['rowlimit'] = $this->NumRows($sql);

                $i = 0;

                while($subs = mysqli_fetch_assoc($result)){
                    $data['yearlevel'][$i] = $subs['yearlevel'];
                    $data['subcode'][$i] = $subs['subcode'];
                    $data['subname'][$i] = $subs['subname'];
                    $i++;
                }
            }elseif(!empty($id) && $bool == true && $selector == 'Specific'){
                // SELECT GROUP_CONCAT(' "', ass.subcode, '"') FROM `assign` ass JOIN `accounts` acc ON(ass.acctid = acc.acctid AND acc.userlevel = 'Teacher' AND ass.acctid = '20220001') JOIN `semester` stt ON(acc.acad_year = stt.acad_year AND acc.sem = stt.sem AND acc.status = 'Active' AND stt.status = 'Active')
                $data = [];
                $sql = "SELECT GROUP_CONCAT(' \"', s.subcode, '\"') sublist FROM `subject` s JOIN `accounts` acc ON(s.acctid = acc.acctid AND acc.userlevel = 'Teacher' AND s.acctid = '$id') JOIN `semester` sem ON(acc.acad_key = sem.acad_key AND sem.status ='Active')";
                // SELECT GROUP_CONCAT(' "', subcode,'"') subcode FROM assign WHERE acctid = '20220001' GROUP BY acctid
                // SELECT a.* FROM `accounts` a INNER JOIN `semester`s WHERE a.sem = s.sem AND s.status = 'Active' AND a.acctid = 'PROF00000001' AND a.userlevel = 'Teacher';

                $result = mysqli_query($conn, $sql);

                $i = 0;

                if($subs = mysqli_fetch_assoc($result)){
                    $sublist = $subs['sublist'];

                    $sql2 = "SELECT * FROM `curriculum` WHERE subcode IN($sublist) ";
                    $result2 = mysqli_query($conn, $sql2);

                    $data['rowlimit'] = $this->NumRows($sql2);

                    $i = 0;
                    while($row = mysqli_fetch_assoc($result2)){
                        $data['yearlevel'][$i] = $row['yearlevel'];
                        $data['subcode'][$i] = $row['subcode']; 
                        $data['subname'][$i] = $row['subname'];
                        $i++;
                    }
                }
            }
            header('Content-Type: application/json');
            echo json_encode($data);
            header_remove();
        }
        
        public function TeachersAcc(String $id, bool $bool, String $search){

            $conn = $this->StartConnection();
            
            if(!empty($id)){
                if($search != '' && $bool == true){
                   
                    $sql =  "SELECT a.*, s.* FROM `accounts` a JOIN `semester` s ON(a.acad_key = s.acad_key AND s.status = 'Active' AND a.userlevel = 'Teacher') WHERE a.firstname LIKE '%$search%' OR a.lastname LIKE '%$search%' OR a.acctid LIKE '%$search%' OR a.email LIKE '%$search%' ;";
                    $result = mysqli_query($conn, $sql);

                    $data['rowlimit'] = $this->NumRows($sql);

                    $i = 0;

                    while($row = mysqli_fetch_assoc($result)){
                        $data['employeeid'][$i] = $acctid = $row['acctid'];
                        // $subj = $this->SingleData("SELECT  GROUP_CONCAT(' ', subcode) subcode FROM `subject` ass JOIN `semester` s ON(ass.acad_year = s.acad_year AND ass.sem = s.sem AND s.status='Active')WHERE  ass.acctid = '$acctid' GROUP BY ass.acctid;");
                        $data['fullname'][$i] = $row['firstname'] . ' ' .$row['lastname'];
                        $data['acctno'][$i] = $row['acctno'];
                        $data['email'][$i] = $row['email'];
                        // $data['advisory'][$i] = $row['yearlevel'].$row['section'];
                        // $data['subjects'][$i] = $subj == null ? '' : $subj;
                        $data['status'][$i] = $row['status'];
                        $data['profilesrc'][$i] = $row['profilesrc'];
                        $data['acad_year'] = $row['acad_year'];
                        $data['sem'] = $row['sem'];
    
                        $data['firstname'][$i] = $row['firstname'];
                        $data['middlename'][$i] = $row['middlename'];
                        $data['lastname'][$i] = $row['lastname'];
                        $i++;
                    }
                
                }else{
                    $sql = "SELECT a.*,s.* FROM `accounts` a JOIN `semester` s ON(a.acad_key = s.acad_key AND s.status = 'Active' AND a.userlevel = 'Teacher');";
                    // $sql = "SELECT accounts.* FROM `accounts` INNER JOIN `semester` WHERE accounts.sem = semester.sem AND accounts.acad_year = semester.acad_year AND semester.status = 'Active' AND accounts.userlevel = 'Teacher';";
                    $result = mysqli_query($conn, $sql);

                    $data['rowlimit'] = $this->NumRows($sql);

                    $i = 0;

                    while($row = mysqli_fetch_assoc($result)){

                        $data['employeeid'][$i] = $acctid = $row['acctid'];
                        $subj = $this->SingleData("SELECT GROUP_CONCAT(' ', subcode) subcode FROM subject WHERE acctid = '$acctid' GROUP BY acctid");
                        $data['fullname'][$i] = $row['firstname'] . ' ' .$row['lastname'];
                        $data['acctno'][$i] = $row['acctno'];
                        $data['email'][$i] = $row['email'];
                        // $data['advisory'][$i] = $row['yearlevel'].$row['section'];
                        $data['subjects'][$i] = $subj == null ? '' : $subj;
                        $data['status'][$i] = $row['status'];
                        $data['profilesrc'][$i] = $row['profilesrc'];
                        $data['acad_year'] = $row['acad_year'];
                        $data['sem'] = $row['sem'];

                        $data['firstname'][$i] = $row['firstname'];
                        $data['middlename'][$i] = $row['middlename'];
                        $data['lastname'][$i] = $row['lastname'];

                    //     <td>${tea.employeeid[i]}</td>
                    //     <td>${tea.email[i]}</td>
                    //     <td>${tea.fullname[i]}</td>
                    //     <td><span class="badge fs-6 ${status_class}">${tea.status[i]}</span></td>
                    //     <td>
                    //         <button class="btn btn-primary btn-sm bi bi bi-pencil-fill" onclick="ViewTeacher('${tea.acctno[i]}','${tea.employeeid[i]}','${tea.email[i]}','${tea.fullname[i]}','${tea.advisory[i]}','${tea.profilesrc[i]}','${tea.subjects[i]}')"></button>
                        
                    //     </td>
                    // </tr>
                    // <tr class="h6 mb-0 text-center text-truncate align-middle">
                    //     <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${tea.employeeid[i]}</td>
                    //     <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${tea.email[i]}</td>
                    //     <td data-exclude="true">${tea.fullname[i]}</td>
                    //     <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${tea.firstname[i]}</td>
                    //     <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${tea.middlename[i]}</td>
                    //     <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${tea.lastname[i]}</td>
                    //     <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${stud.subjects[i]}</td>
                    //     <td data-exclude="true">
                    //         <span class="badge ${i_class} fs-6 rounded-pill mb-0">${tea.status[i]}</span>
                    //     </td>
                    // <td data-exclude="true">
                    //     <button class="btn btn-primary bi bi-eye-fill btn-sm" onclick="ViewStudent('${tea.acctno[i]}','${tea.employeeid[i]}','${tea.email[i]}','${tea.fullname[i]}','${tea.subjects[i]}','${tea.profilesrc[i]}')"></button>
                    //     <button class="btn ${i_status} btn-sm" onclick="ActivateEmail('${tea.employeeid[i]}')"></button>

                        $i++;
                    }
               
                }
                header('Content-Type: application/json');
                echo json_encode($data);
                header_remove();
            }
            
            
        }
        
        
    }
    
    $tea = new Teachers();
    $db = new Database();
    if(isset($_POST['id'])){
        if(isset($_POST['search'])){
            if(!empty($_POST['search'])){
                $search = $_POST['search'];
                $tea->TeachersAcc($_POST['id'], true, $search);
            }
        }elseif(isset($_POST['fetch'])){
            if($_POST['fetch'] == 'subjects'){
                if($_POST['datalist'] == 'All'){
                    $tea->SubjectsRun($_POST['id'], $_POST['datalist'], true);
                }elseif($_POST['datalist'] == 'Specific'){
                    $tea->SubjectsRun($_POST['id'], $_POST['datalist'], true);
                }
            }elseif($_POST['fetch'] == 'teachers'){
                if(isset($_POST['search'])){
                    $search = $_POST['search'];
                    $tea->TeachersAcc($_POST['id'], true, $search);
                }else{
                    $tea->TeachersAcc($_POST['id'], false, '');
                }
            }
        }elseif(isset($_POST['action'])){
            if($_POST['action'] == 'delete'){
                $acctno = $_POST['acctno'];
                if($fetch = $db->SingleRow("SELECT acad_year, sem FROM `semester` WHERE status = 'Active'")){
                    $academic = $fetch['acad_year'];
                    $sem = $fetch['sem'];
                    
                    $execute = 
                    $db->ExecuteQuery("DELETE FROM accounts WHERE acctno = '$acctno' AND acad_year = '$academic' AND sem = '$sem' AND userlevel");
                    header('Location: '.$_SERVER['HTTP_REFERER']);
                }
            }
        }
    }
?>