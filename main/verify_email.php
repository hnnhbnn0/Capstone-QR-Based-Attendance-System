<?php
    require('../controller/classes.php');
    require('../vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;

    $db = new Database();
    $str = new Filter();
    $gen = new GenerateString();

    $conn = $db->StartConnection();

    if(isset($_POST['login']) && isset($_POST['email'])){

        // Filtering Inputs
        $email = $str->Email($db->PostSecure($_POST['email']));
        // $password = $str->SEO($db->PostSecure($_POST['password']));

        // $sql = Find from Accounts Where the POST['email'] or input name="email"
        $sql = "SELECT COUNT(*) FROM accounts WHERE email = '$email'";

        // If the number of rows ($db-NumRows) is greater than 1, it means that there is an existing account in the database
        // where in the email is the inputted email.
        // Else, if it was zero, then there's no existing account in the database.
        $db_numrows = $db->SingleData($sql);

        session_start();
        
        if($db_numrows == 1){
            
            $_SESSION['email'] = $email;
            $_SESSION['confirm'] = "is-valid";
            header('Location: '.$_SERVER['HTTP_REFERER']);

            // Fetching Data from the Database and collecting it into an associative array.
            // if($data = $db->SingleRow($sql)){

            //     $hashed_password = $data['hashed_password'];

            //     if(password_verify($password, $hashed_password)){
            //         $_SESSION['email_success'] = $email;
            //         $_SESSION['password_success'] = $password;
            //         $_SESSION['content'] = 1;
            //         $_SESSION['password_err'] = "is-valid";
            //         header('Location: '.$_SERVER['HTTP_REFERER']);
            //     }else{
            //         $_SESSION['email'] = $email;
            //         $_SESSION['email_err'] = "is-valid";
            //         $_SESSION['password_err'] = "is-invalid";
            //         header('Location: '.$_SERVER['HTTP_REFERER']);
            //     }
            // }
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['confirm'] = "is-invalid";
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
    // }elseif(isset($_POST['submitOTP'])){

    //     $email = $str->Email($db->PostSecure($_POST['email']));
    //     $password = $str->SEO($db->PostSecure($_POST['password']));
    //     $otp = $str->Numeric($db->PostSecure($_POST['otp']));

    //     $hashed_password = $db->SingleData("SELECT hashed_password FROM accounts WHERE email = '$email'");
    //     $db_otp = $db->SingleData("SELECT otp FROM accounts WHERE email = '$email'");

    //     if(password_verify($password, $hashed_password)){

    //         if($data = $db->SingleRow("SELECT * FROM accounts WHERE email = '$email'")){
    //             session_start();
    //             $_SESSION['Name'] = $data['firstname'].' '.$data['lastname'];
    //             $_SESSION['Email'] = $data['email'];
    //             $_SESSION['Userlevel'] = $data['userlevel'];
    //             $_SESSION['AccountID'] = $data['acctid'];
    //             $_SESSION['AccountNo'] = $data['acctno'];
    //             $_SESSION['Yearlevel'] = $data['yearlevel'];
    //             $_SESSION['Section'] = $data['section'];

    //             if($otp == $db_otp){
    //                 if($data['userlevel'] == 'Admin'){
    //                     header("Location: ../administrator/semester.php");
    //                 }elseif($data['userlevel'] == 'Teacher'){
    //                     header("Location: ../faculty/generate-qr.php");
    //                 }elseif($data['userlevel'] == 'Student'){
    //                     header("Location: ../student/scan-qr.php");
    //                 }
    //             }else{
    //                 $_SESSION['content'] = 1;
    //                 $_SESSION['email_success'] = $email;
    //                 $_SESSION['password_success'] = $password;
    //                 $_SESSION['otp_err'] = 'is-invalid';
    //                 header('Location: '. $_SERVER['HTTP_REFERER']);
    //             }

    //         }
        // }else{
        //     // $_SESSION['content'] = 1;
        //     // $_SESSION['email'] = $email;
        //     // $_SESSION['password'] = $password;
        //     // header('Location: '. $_SERVER['HTTP_REFERER']);
        // }

    //     echo $otp.' '.$email.' '.$password;

    // }elseif(isset($_POST['email_OTP'])){

    //     $email = $db->PostSecure($_POST['email_OTP']);

    //     $otp = $gen->GenerateOTP(6);
    //     $db->ExecuteQuery("UPDATE accounts SET otp = '$otp' WHERE email = '$email'");

    //     $mail = new PHPMailer(); // create a new object
    //     $mail->IsSMTP(); // enable SMTP
    //     $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    //     $mail->SMTPAuth = true; // authentication enabled
    //     $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    //     $mail->Host = "smtp.gmail.com";
    //     $mail->Port = 465; //SSL:465 | TLS: 587
    //     $mail->IsHTML(true);
    //     $mail->Username = "attenvax@gmail.com";
    //     $mail->Password = "qdzbljwsyltythew";
    //     $mail->SetFrom("attenvax@gmail.com", "AttenVax");
    //     $mail->Subject = "AttenVax [$otp]";
    //     $mail->Body = "

    //         <center>
    //         <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
    //         </center>
           
    //         <p>The Verification code is: $otp </p>
    //         <p>- AttenVax Team</p>"
            
    //         ;

    //     $mail->AddAddress("$email");
    //     $mail->Send();
    // }
?>