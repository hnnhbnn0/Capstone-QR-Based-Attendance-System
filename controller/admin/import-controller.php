<?php
    require('../../controller/classes.php');
    require('../../vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;

    set_time_limit(0);
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
            
            $temp_filename = $academic . '-' . $sem . '-Students' . '.' . end($file_ext);
            $filename = preg_replace("/[^A-z0-9.]/i", "-", $temp_filename);

            mkdir('../../spreadsheets/');
            $targetPath = '../../spreadsheets/' . $filename;
            // mkdir($targetPath);
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

                $yearlevel = "";
                if (isset($spreadSheetAry[$i][5])) {
                    $yearlevel = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
                }

                $section = "";
                if (isset($spreadSheetAry[$i][6])) {
                    $section = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
                }

                if (!empty($acctid) && !empty($firstname) && !empty($lastname)){

                    $acad_key = $db->SingleData("SELECT acad_key FROM `semester` WHERE `status` = 'Active'");

                    if(strlen($acctid) == 10){
                        if($isExist = $db->SingleData("SELECT COUNT(*) FROM `accounts` WHERE `acctid` = '$acctid' AND `acad_key` = '$acad_key'") == 0){

                            $userlevel = 'Student';
                            $status = 'Inactive';
                            $acctno = $gen->UserID('user', 15);
                            $password = $gen->GeneratePassword(8);
                            $encrypt = $sec->Hashing('encrypt', $password);
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            $otp = $gen->GenerateOTP(6);

            
                            $uuid = (new GenerateString)->uuid();
                            if($db->SingleData("SELECT COUNT(*) FROM `accounts` WHERE qr_id = '$uuid' AND `userlevel` = 'Student'") == 0){
                                $execute = "INSERT INTO accounts (acctno,acctid,email,hashed_password,firstname,middlename,lastname,userlevel,otp,acad_key,status,encrypt,qr_id,yearlevel,section) VALUES ('$acctno','$acctid','$email','$hashed_password','$firstname','$middlename','$lastname','$userlevel','$otp','$acad_key','$status','$encrypt', '$uuid','$yearlevel', '$section')";
                                $result = mysqli_query($conn, $execute);
                            }


                            $x++;
                        }else{
                            $y++;
                            $data['redundant'][$i] = $y;
                        }
                    }
                }
                $redundant = $data['redundant'] == '' ? 'None' : implode(", ", $data['redundant']);
                $data['title_2'] = "Status Report!";
                $data['html_2'] = "There are <span class='text-success fw-bolder'>$x inserted</span>, <span class='text-danger fw-bolder'>" . $y . " redundancy</span>.<br>Line [<span class='text-danger fw-bolder'>" . $redundant . "</span>]";
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
                $acad_key = $row['acad_key'];
                $academic = $db->SingleData("SELECT acad_year FROM `semester` WHERE `acad_key` = '$acad_key'");
                $sem = $db->SingleData("SELECT sem FROM `semester` WHERE `acad_key` = '$acad_key'");
                $userlevel = $row['userlevel'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $yearlevel = $row['yearlevel'];
                $section = $row['section'];
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
                    
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year/Section: <b>BSIT - $yearlevel$section</b></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year/Semester: <b>$academic</b>, <b>$sem</b></p>
                    <br>
                    <p>Have a nice day, and thank you.</p>
                    <p>- AttenVax Team</p>
                ";
    
                $mail->AddAddress($email);
                $mail->Send();
            }
        }
    }

    // $db->ExecuteQuery("UPDATE `accounts` SET `qr_id` = uuid() WHERE userlevel LIKE '%Students%'");

?>