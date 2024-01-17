<?php
    require('../../controller/classes.php');
    require('../../vendor/autoload.php');
    
    use PHPMailer\PHPMailer\PHPMailer;
    

    error_reporting(0);
    $db = new Database();
    $gen = new GenerateString();
    $sec = new Security();

    $conn = $db->StartConnection();

    if (isset($_POST["academic"]) && isset($_POST['sem'])) {

        $allowedFileType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (in_array($_FILES["file"]["type"], $allowedFileType)) {

            $academic = mysqli_real_escape_string($conn, $_POST['academic']);
            $sem = mysqli_real_escape_string($conn, $_POST['sem']);

            $file = $_FILES["file"]["name"];
            $file_ext = explode(".", $file);
            
            $temp_filename = $academic . '-' . $sem . '-Faculty' . '.' . end($file_ext);
            $filename = preg_replace("/[^A-z0-9.]/i", "-", $temp_filename);
            mkdir("../../spreadsheets/");
            $targetPath = '../../spreadsheets/' . $filename;
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
            
            $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadSheet = $Reader->load($targetPath);
            $excelSheet = $spreadSheet->getActiveSheet();
            $spreadSheetAry = $excelSheet->toArray();
            $sheetCount = count($spreadSheetAry);

            $data = [];

            $data['filename'] = $_FILES['file']['name'];

            $data['title_1'] = "Import Success!";
            $data['html_1'] = "You have uploaded <span class='text-success fw-bolder'>" . $file . "</span>";
            $data['icon_1'] = "success";

            $x = 0;
            $y = 0;
            
            for ($i = 2; $i <= $sheetCount; $i++) {
                $acctid = "";
                if (isset($spreadSheetAry[$i][0])) {
                    $acctid = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
                }
                $email = "";
                if (isset($spreadSheetAry[$i][1])) {
                    $email = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
                }
                $firstname = "";
                if (isset($spreadSheetAry[$i][2])) {
                    $firstname = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
                }
                $middlename = "";
                if (isset($spreadSheetAry[$i][3])) {
                    $middlename = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
                }
                $lastname = "";
                if (isset($spreadSheetAry[$i][4])) {
                    $lastname = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
                }
                // $subjects = "";
                // if (isset($spreadSheetAry[$i][5])) {
                //     $subjects = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
                //     $subject = explode(", ", $subjects);
                //     $arr_sub = explode(", ", $subjects);
                //     $subject_codes = '"'.implode('", "', $arr_sub).'"';
                //     // sort($subject);
                //     $subcode = implode(', ' , $subject);
                //     $subject_list = implode('", "', $subject);
                //     $sublist = '"'.$subject_list.'"';
                // }

                // SELECT a.firstname, a.lastname FROM `accounts` a JOIN `semester` s ON(a.sem = s.sem AND a.acad_year = s.acad_year AND a.status = 'Active' AND s.status = 'Active' AND a.acctid IN("20220001"))


                $data['hehehee'] = $_FILES['file']['name'];

                if (!empty($acctid) && !empty($firstname) && !empty($lastname)){

                    if(strlen($acctid) == 8){
                        
                        $fetch = $db->SingleRow("SELECT acad_year, acad_key, sem FROM semester WHERE status = 'Active'");
                        $acad_key = $fetch['acad_key'];
                        $academic = $fetch['acad_year'];
                        $sem = $fetch['sem'];

                        // SELECT * FROM accounts a JOIN semester sm ON a.acad_key = sm.acad_key AND sm.acad_year = '$academic' AND sm.sem = '$sem' WHERE sm.status = 'Active'
                        if($isExist = $db->NumRows("SELECT * FROM accounts WHERE acctid = '$acctid' AND `acad_key` = '$acad_key'") == 0){
                
                            $userlevel = 'Teacher';
                            $acctno = $gen->UserID('user_', 15);
                            $password = $gen->GeneratePassword(8);
                            $otp = $gen->GenerateOTP(6);
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            $status = "Inactive";
                            $encrypt = $sec->Hashing($password, 'encrypt');
                            

                            $execute = "INSERT INTO `accounts` (acctno,acctid,email,hashed_password,firstname,middlename,lastname,userlevel,otp,acad_key,status,encrypt) VALUES ('$acctno','$acctid','$email','$hashed_password','$firstname','$middlename','$lastname','$userlevel','$otp','$acad_key','$status', '$encrypt')";
                            $db->ExecuteQuery($execute);

                            $x++;
                        }else{
                            $y++;
                            $data['redundant'][$i] = $y;
                        }
                    }
                }
                $redundant = $data['redundant'] == '' ? 'None' : implode(", ", $data['redundant']);
                $data['title_2'] = "Status Report!";
                $data['html_2'] = "There are <span class='text-success fw-bolder'>$x inserted</span>, <span class='text-danger fw-bolder'>" . $y . " redundancy</span>.";
                $data['icon_2'] = "info";
            }
            unlink($targetPath);
        } else {
            $file = $_FILES["file"]["name"];
            $file_ext = explode(".", $file);

            $data['title_1'] = "Import Failed! [" . strtoupper(end($file_ext)) . "]";
            $data['html_1'] = "You have uploaded a wrong file" . $file;
            $data['icon_1'] = "error";
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        header_remove();
    }elseif(isset($_POST['send']) && isset($_POST['count'])){
        $sql = "SELECT * FROM accounts WHERE mailed = '' AND userlevel = 'Student' LIMIT 20";
        $result = mysqli_query($conn, $sql);

        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $acctid = $row['acctid'];

            $academic = $row['acad_year'];
            $sem = $row['sem'];
            $userlevel = $row['userlevel'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
           
            // $subcode = $row['subcode'];
            $password = $sec->Hashing('decrypt', $row['encrypt']);
            $email = $row['email'];

            $mail = new PHPMailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; //SSL:465 | TLS: 587
            $mail->IsHTML(true);
            $mail->Username = "attenvax@gmail.com";
            $mail->Password = "qdzbljwsyltythew";
            $mail->SetFrom("attenvax@gmail.com", "AttenVax");
            $mail->Subject = "AttenVax Account [$userlevel]";
            $mail->Body = "
                <p>Dear $firstname $lastname,</p>
                <p>We would like to inform you that your account on the <a href='https://www.attenvax.com' style='text-decoration: none; font-weight: 700'>AttenVax</a> is created, here is your accounts details.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student ID: <b>$acctid</b></p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username: <b>$email</b></p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password: <b>$password</b></p>
                
                
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year/Semester: <b>$academic</b>, <b>$sem</b></p>
                <br>
                <p>Have a nice day, and thank you.</p>
                <p>- AttenVax Team</p>
            ";

            $mail->AddAddress("$email");

            if($mail->Send()){
                $db->ExecuteQuery("UPDATE accounts SET mailed = 'Sent', status = 'Active' WHERE acctid = '$acctid'");
                $i++;
            }
        }

        $data = [];

        $data['sent'] = $i;

        header('Content-Type: application/json');
        echo json_encode($data);
        header_remove();
    }elseif(isset($_POST['id']) && isset($_POST['action'])){
        if($_POST['action'] == 'activate-student'){
            $account_id = $db->PostSecure($_POST['id']);
            $db->ExecuteQuery("UPDATE accounts SET mailed = 'Sent', status = 'Active' WHERE acctid = '$account_id'");

            $sql = "SELECT * FROM accounts WHERE acctid = '$account_id'";
            $result = mysqli_query($conn, $sql);
            
            if($row = mysqli_fetch_assoc($result)){
                $acctid = $row['acctid'];
    
                $academic = $row['acad_year'];
                $sem = $row['sem'];
                $userlevel = $row['userlevel'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                // $yearlevel = $row['yearlevel'];
                // $section = $row['section'];
                // $subcode = $row['subcode'];
                $password = $sec->Hashing('decrypt', $row['encrypt']);
                $email = $row['email'];
    
                $mail = new PHPMailer(); // create a new object
                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; //SSL:465 | TLS: 587
                $mail->IsHTML(true);
                $mail->Username = "attenvax@gmail.com";
                $mail->Password = "qdzbljwsyltythew";
                $mail->SetFrom("attenvax@gmail.com", "AttenVax");
                $mail->Subject = "AttenVax Account [$userlevel]";
                $mail->Body = "
                    <p>Dear $firstname $lastname,</p>
                    <p>We would like to inform you that your account on the <a href='https://www.attenvax.com' style='text-decoration: none; font-weight: 700'>AttenVax</a> is created, here is your accounts details.</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student ID: <b>$acctid</b></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username: <b>$email</b></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password: <b>$password</b></p>
                    
               
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year/Semester: <b>$academic</b>, <b>$sem</b></p>
                    <br>
                    <p>Have a nice day, and thank you.</p>
                    <p>- AttenVax Team</p>
                ";
    
                $mail->AddAddress("$email");
                $mail->Send();
            }
        }
    }
?>