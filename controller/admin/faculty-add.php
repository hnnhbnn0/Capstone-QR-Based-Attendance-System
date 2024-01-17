<?php
    require('../../controller/classes.php');
    require('../../vendor/autoload.php');
    use PHPMailer\PHPMailer\PHPMailer;
    // error_reporting(0);
    $db = new Database();
    $ot = new GenerateString();
    $str = new Filter();
    $gen = new GenerateString();

    $email = $str->Email($db->PostSecure($_POST['email']));
    $acctid = $str->Numeric($db->PostSecure($_POST['acctid']));
    $firstname = $str->AlphaSpace($db->PostSecure($_POST['firstname']));
    $middlename = $str->AlphaSpace($db->PostSecure($_POST['middlename']));
    $lastname = $str->AlphaSpace($db->PostSecure($_POST['lastname']));
    // $yearlevel = $str->SEO($db->PostSecure( $_POST['yearlevel']));
    // $section = $str->SEO($db->PostSecure($_POST['section']));
    // $subject = $_POST['subject'];
    // sort($subject);
    // $subcode = implode(', ' , $subject);
    // $subject_list = implode('", "', $subject);
    // $sublist = '"'.$subject_list.'"';

    if(!empty($_POST['acctid']) && !empty($_POST['firstname']) && !empty($_POST['email'])){

        if($fetch = $db->SingleRow("SELECT acad_key, acad_year, sem FROM `semester` WHERE status = 'Active'")){

            $acad_key = $fetch['acad_key'];
            $academic = $fetch['acad_year'];
            $semester = $fetch['sem'];

            $userlevel = 'Teacher';
            $acctno = $gen->UserID('user', 15);
            $password = $gen->GeneratePassword(8);
            $otp = $gen->GenerateOTP(6);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $status = "Inactive";

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
                <p>We would like to inform you that your account on the <a href='https://www.attenvax.com' style='text-decoration: none; font-weight: 700'>AttenVax</a> is created, here are your account details.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username: <b>$email</b></p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password: <b>$password</b></p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year/Semester: <b>$academic</b>, <b>$semester</b></p>
                <br>
                <p>Have a nice day, and thank you.</p>
                <p>- AttenVax Team</p>
            ";

            $mail->AddAddress("$email");
            $mail->Send();

            $execute = $db->ExecuteQuery("INSERT INTO accounts (acctno,acctid,email,hashed_password,firstname,middlename,lastname,userlevel,otp,acad_key,status) VALUES ('$acctno','$acctid','$email','$hashed_password','$firstname','$middlename','$lastname','$userlevel','$otp','$acad_key','$status')");
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        
        
    }


    
?>


