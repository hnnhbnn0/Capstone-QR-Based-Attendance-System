<?php
    require('../../controller/classes.php');
    error_reporting(0);
    final Class Teachers extends Database{
        public function TeachersAcc(String $id){

            $conn = $this->StartConnection();
            
            if(!empty($id)){
                
                
                    $sql = "SELECT a.*,s.* FROM `accounts` a JOIN `semester` s ON(a.acad_key = s.acad_key AND s.status = 'Inactive' AND a.userlevel = 'Teacher');";
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
