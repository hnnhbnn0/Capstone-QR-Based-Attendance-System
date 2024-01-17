<?php
    require_once('../../controller/classes.php');

    $db = new Database();

    $conn = $db->StartConnection();

    Class Reports extends Database{

        public function GenerateReport(String $id, String $table, String $subject, String $section){

            $conn = $this->StartConnection();

            if(!empty($id) && !empty($table)){

                $data = [];

                if($table == 'Attendance'){
                    
                    if(!empty($subject) && empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.time, att.status, att.subcode FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id' AND att.subcode = '$subject') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active') ORDER BY att.date, att.time";
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
                        $data['path'] = "Attendance|ID-True|Subject-True|Section-False";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($section) && empty($subject)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.time, att.status, att.subcode FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id' AND acc.section = '$section') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active') ORDER BY att.date, att.time";
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
                        $data['path'] = "Attendance|ID-True|Subject-False|Section-True";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($subject) && !empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.time, att.status, att.subcode FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id' AND att.subcode = '$subject' AND acc.section = '$section') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active') ORDER BY att.date, att.time";
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
                        $data['path'] = "Attendance|ID-True|Subject-True|Section-True";
                        $data['rowlimit'] = $rows;
                    }else{
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.status, att.time, att.subcode FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active') ORDER BY att.time DESC, att.date, att.subcode";
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
                }elseif($table == 'Absentees'){
                    if(!empty($subject) && empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.time, att.subcode, att.status FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id' AND att.subcode = '$subject' AND att.status = 'Absent') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active')";
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
                        $data['path'] = "Absentees|ID-True|Subject-True|Section-False";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($section) && empty($subject)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.time, att.subcode, att.status FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id' AND acc.section = '$section' AND att.status = 'Absent') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active')";
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
                        $data['path'] = "Absentees|ID-True|Subject-False|Section-True";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($subject) && !empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.time, att.subcode, att.status FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id' AND att.subcode = '$subject' AND acc.section = '$section' AND att.status = 'Absent') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active')";
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
                        $data['path'] = "Absentees|ID-True|Subject-True|Section-True";
                        $data['rowlimit'] = $rows;
                    }else{
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.date, att.time, att.subcode, att.status FROM `accounts` acc JOIN `attendance` att ON(att.qr_id = acc.qr_id AND att.acad_key = acc.acad_key AND att.teacher_id = '$id' AND att.status = 'Absent') JOIN `semester` sem ON(att.acad_key = sem.acad_key AND acc.acad_key = sem.acad_key AND sem.status = 'Active')";
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
                        $data['path'] = "Absentees|ID-True|Subject-False|Section-False";
                        $data['rowlimit'] = $rows;
                    }
                }elseif($table == 'Drop List'){
                    if(!empty($subject) && empty($section)){
                        $sql = "SELECT COUNT(*) AS absences, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.subcode, att.qr_id, acc.acctid FROM accounts acc JOIN attendance att ON(acc.qr_id = att.qr_id AND att.status = 'Absent' AND acc.userlevel = 'Student' AND att.teacher_id = '$id' AND att.subcode = '$subject') JOIN semester sem ON ( att.acad_key = sem.acad_key AND sem.status ='Active') GROUP BY att.subcode, att.qr_id";
                        $result = mysqli_query($conn, $sql);
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                if($row['absences'] > 2){
                                    $data['id'][$i] = $row['acctid'];
                                    $data['absences'][$i] = $row['absences'];
                                    $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                    $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                    $data['subcode'][$i] = $row['subcode'];
                                    $i++;
                                }
                            }
                        }
                        $data['path'] = "Droplist|ID-True|Subject-True|Section-False";
                        $data['rowlimit'] = $i;
                    }elseif(!empty($section) && empty($subject)){
                        $sql = "SELECT COUNT(*) AS absences, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.subcode, att.qr_id, acc.acctid FROM accounts acc JOIN attendance att ON(acc.qr_id = att.qr_id AND att.status = 'Absent' AND acc.userlevel = 'Student' AND att.teacher_id = '$id' AND att.section = '$section') JOIN semester sem ON ( att.acad_key = sem.acad_key AND sem.status ='Active') GROUP BY att.subcode, att.qr_id";
                        $result = mysqli_query($conn, $sql);
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                if($row['absences'] > 2){
                                    $data['id'][$i] = $row['acctid'];
                                    $data['absences'][$i] = $row['absences'];
                                    $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                    $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                    $data['subcode'][$i] = $row['subcode'];
                                    $i++;
                                }
                            }
                        }
                        $data['path'] = "Droplist|ID-True|Subject-False|Section-True";
                        $data['rowlimit'] = $i;
                    }elseif(!empty($subject) && !empty($section)){
                        $sql = "SELECT COUNT(*) AS absences, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.subcode, att.qr_id, acc.acctid FROM accounts acc JOIN attendance att ON(acc.qr_id = att.qr_id AND att.status = 'Absent' AND acc.userlevel = 'Student' AND att.teacher_id = '$id' AND att.subcode = '$subject' AND att.section = '$section') JOIN semester sem ON ( att.acad_key = sem.acad_key AND sem.status ='Active') GROUP BY att.subcode, att.qr_id";
                        $result = mysqli_query($conn, $sql);
    
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                if($row['absences'] > 2){
                                    $data['id'][$i] = $row['acctid'];
                                    $data['absences'][$i] = $row['absences'];
                                    $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                    $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                    $data['subcode'][$i] = $row['subcode'];
                                    $i++;
                                }
                            }
                        }
                        $data['path'] = "Droplist|ID-True|Subject-True|Section-True";
                        $data['rowlimit'] = $i;
                    }else{
                        $sql = "SELECT COUNT(*) AS absences, acc.firstname, acc.lastname, acc.yearlevel, acc.section, att.subcode, acc.acctid FROM accounts acc JOIN attendance att ON(acc.qr_id = att.qr_id AND att.status = 'Absent' AND acc.userlevel = 'Student' AND att.teacher_id = '$id') JOIN semester sem ON ( att.acad_key = sem.acad_key AND sem.status ='Active') GROUP BY att.subcode, att.qr_id";
                        $result = mysqli_query($conn, $sql);
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                if($row['absences'] > 2){
                                    $data['id'][$i] = $row['acctid'];
                                    $data['absences'][$i] = $row['absences'];
                                    $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                    $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                    $data['subcode'][$i] = $row['subcode'];
                                    $i++;
                                }
                            }
                        }
                        $data['path'] = "Droplist|ID-True|Subject-False|Section-False";
                        $data['rowlimit'] = $i;
                    }
                }elseif($table == 'Student List'){
                    
                    if(!empty($subject) && empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, s.subcode FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND s.subcode = '$subject' AND acc.userlevel = 'Student') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') ORDER BY s.subcode, acc.firstname, acc.section";
                        $result = mysqli_query($conn, $sql);
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-True|Section-False";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($section) && empty($subject)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, s.subcode FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.section = '$section' AND acc.userlevel = 'Student') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') ORDER BY s.subcode, acc.firstname, acc.section";
                        $result = mysqli_query($conn, $sql);
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-False|Section-True";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($subject) && !empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, s.subcode FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.section = '$section' AND s.subcode = '$subject' AND acc.userlevel = 'Student') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') ORDER BY s.subcode, acc.firstname, acc.section";
                        $result = mysqli_query($conn, $sql);
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-True|Section-True";
                        $data['rowlimit'] = $rows;
                    }else{
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, s.subcode FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.userlevel = 'Student') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') ORDER BY s.subcode, acc.firstname, acc.section";
                        $result = mysqli_query($conn, $sql);

                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-False|Section-False";
                        $data['rowlimit'] = $rows;
                    }
                }elseif($table == 'Vaccine Status'){
                    
                    if(!empty($subject) && empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, GROUP_CONCAT(' ', s.subcode), acc.vaxstat FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.userlevel = 'Student' AND s.subcode = '$subject') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active')  GROUP BY acc.acctid ORDER BY acc.acctid";
                        $result = mysqli_query($conn, $sql);
    
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $data['vaxstat'][$i] = $row['vaxstat'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-True|Section-False";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($section) && empty($subject)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, GROUP_CONCAT(' ', s.subcode), acc.vaxstat FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.userlevel = 'Student' AND acc.section = '$section') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') GROUP BY acc.acctid ORDER BY acc.acctid";
                        $result = mysqli_query($conn, $sql);
    
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $data['vaxstat'][$i] = $row['vaxstat'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-False|Section-True";
                        $data['rowlimit'] = $rows;
                    }elseif(!empty($subject) && !empty($section)){
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, GROUP_CONCAT(' ', s.subcode), acc.vaxstat FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.userlevel = 'Student' AND s.subcode = '$subject' AND acc.section = '$section') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') GROUP BY acc.acctid ORDER BY acc.acctid";
                        $result = mysqli_query($conn, $sql);
    
    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $data['vaxstat'][$i] = $row['vaxstat'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-True|Section-True";
                        $data['rowlimit'] = $rows;
                    }else{
                        $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, GROUP_CONCAT(' ', s.subcode) AS subcode, acc.vaxstat, sem.status FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.userlevel = 'Student') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') GROUP BY acc.acctid ORDER BY acc.acctid";
                        // $sql = "SELECT acc.acctid, acc.firstname, acc.lastname, acc.email, acc.yearlevel, acc.section, s.subcode, acc.vaxstat FROM `accounts` acc JOIN subject s ON( acc.yearlevel = s.yearlevel AND acc.section = s.section AND s.acctid = '$id' AND acc.userlevel = 'Student') JOIN semester sem ON( s.acad_key = sem.acad_key AND sem.status ='Active') ORDER BY s.subcode, acc.firstname, acc.section";
                        $result = mysqli_query($conn, $sql);

    
                        if($rows = mysqli_num_rows($result)){
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                $data['id'][$i] = $row['acctid'];
                                $data['email'][$i] = $row['email'];
                                $data['fullname'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                                $data['yearsec'][$i] = $row['yearlevel'] . '' . $row['section'];
                                $data['subcode'][$i] = $row['subcode'];
                                $data['vaxstat'][$i] = $row['vaxstat'];
                                $i++;
                            }
                        }
                        $data['path'] = "Attendance|ID-True|Subject-False|Section-False";
                        $data['rowlimit'] = $rows;
                    }
                }

                echo json_encode($data);

            }else{

            }
        }

    }

    $reports = new Reports();

    if(isset($_POST['id']) && isset($_POST['table'])){

        $id = $_POST['id'];
        $table = $_POST['table'];
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
        $section = isset($_POST['section']) ? $_POST['section'] : '';

        $reports->GenerateReport($id, $table, $subject, $section);
    }

?>