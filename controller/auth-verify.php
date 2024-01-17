<?php
    require('../controller/classes.php');
    require('../vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;
    
    
    final class User extends Database{
        // public function VerifyUser(String $username){
            
        //     echo $this->SingleData("SELECT COUNT(*) FROM accounts WHERE username = '$username'");
        // }

        public function VerifyEmail(String $email){
            echo $this->SingleData("SELECT COUNT(*) FROM accounts WHERE email = '$email'");
        }

        public function VerifyAccount(String $email, String $password){
            
            if($this->SingleData("SELECT COUNT(*) FROM accounts WHERE email = '$email' AND status = 'Active'") == 1){

                $find = $this->SingleRow("SELECT hashed_password, firstname, lastname, email, otp FROM `accounts` WHERE email = '$email'");

                $hashed_password = $find['hashed_password'];

                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $otp = '';
                for ($i = 1; $i <= 6; $i++) {
                    $otp .= $characters[rand(0, $charactersLength - 1)];
                }

                $this->ExecuteQuery("UPDATE `accounts` SET otp = '$otp'");

                if(password_verify($password, $hashed_password)){

                    $email = $find['email'];
                    $fullname = $find['firstname'] . ' ' . $find['lastname'];
                    // $username = $find['username'];
                    
                    echo 'password-ok';

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
                    $mail->Subject = "AttenVax [$otp]";
                    $mail->Body = "

                        <center>
                        <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
                        </center>
                    
                        <p>The Verification code is: $otp </p>
                        <p>- AttenVax Team</p>"
                        
                        ;

                    // $mail = new PHPMailer(); // create a new object
                    // $mail->IsSMTP(); // enable SMTP
                    // $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                    // $mail->SMTPAuth = true; // authentication enabled
                    // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                    // $mail->Host = "smtp.gmail.com";
                    // $mail->Port = 465; //SSL:465 | TLS: 587
                    // $mail->IsHTML(true);
                    // $mail->Username = "jedterrazola03@gmail.com";
                    // $mail->Password = "lwioojflkykswqdp";
                    // $mail->SetFrom("jedterrazola03@gmail.com", "Jed Terrazola");
                    // $mail->Subject = "RJ Avancena Account [OTP]";
                    // $mail->Body = "
                    //                 <center>
                    //                 <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
                    //                 </center>
                    //                 <h1> Hi $fullname! </h1>
                    //                 <p>This is your requested one-time password for your account.</p>
                                            
                    //                         <p>&nbsp;&nbsp;&nbsp;&nbsp; New OTP: <b>$otp</b></p>
                                            
                    //                         <p>You can sign-in here at this <a href=\"https://rjaenterprise.000webhostapp.com/\">link.</a></p>
                    //                 ";
                    $mail->AddAddress("$email");


                    $mail->Send();
                }else{
                    echo 'password-err';
                }
            }else{
                echo 'account-err';
            }
        }

        public function ResendOTP(String $email){

            if($this->SingleData("SELECT COUNT(*) FROM accounts WHERE email = '$email'") == 1){

                $find = $this->SingleRow("SELECT firstname, lastname, email, otp FROM `accounts` WHERE email = '$email'");

                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $otp = '';
                for ($i = 1; $i <= 6; $i++) {
                    $otp .= $characters[rand(0, $charactersLength - 1)];
                }

                $this->ExecuteQuery("UPDATE `accounts` SET otp = '$otp'");

                $email = $find['email'];
                $fullname = $find['firstname'] . ' ' . $find['lastname'];
                // $username = $find['username'];
                
                // echo 3;
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
                $mail->Subject = "AttenVax [$otp]";
                $mail->Body = "
        
                    <center>
                    <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
                    </center>
                   
                    <p>The Verification code is: $otp </p>
                    <p>- AttenVax Team</p>"
                    
                    ;
        
                // $mail = new PHPMailer(); // create a new object
                // $mail->IsSMTP(); // enable SMTP
                // $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                // $mail->SMTPAuth = true; // authentication enabled
                // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                // $mail->Host = "smtp.gmail.com";
                // $mail->Port = 465; //SSL:465 | TLS: 587
                // $mail->IsHTML(true);
                // $mail->Username = "jedterrazola03@gmail.com";
                // $mail->Password = "lwioojflkykswqdp";
                // $mail->SetFrom("jedterrazola03@gmail.com", "Jed Terrazola");
                // $mail->Subject = "RJ Avancena Account [OTP]";
                // $mail->Body = "
                //                 <center>
                //                 <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
                //                 </center>
                //                 <h1> Hi $fullname! </h1>
                //                 <p>This is your requested one-time password for your account.</p>
                                      
                //                         <p>&nbsp;&nbsp;&nbsp;&nbsp; New OTP: <b>$otp</b></p>
                                        
                //                         <p>You can sign-in here at this <a href=\"https://rjaenterprise.000webhostapp.com/\">link.</a></p>
                //                 ";
                $mail->AddAddress("$email");


                $mail->Send();
                
            }
        }

        public function VerifyOTP(String $email, String $password, Int $otp){
            if($this->SingleData("SELECT COUNT(*) FROM accounts WHERE email = '$email'") == 1){
                
                $find = $this->SingleRow("SELECT firstname, lastname, otp, hashed_password, userlevel, accid FROM `accounts` WHERE email = '$email'");
                
                if(!empty($find)){

                    $hashed_password = $find['hashed_password'];
                    

                    if(password_verify($password, $hashed_password)){
                        if($otp == $this->SingleData("SELECT otp FROM `accounts` WHERE email = '$email'")){
                            echo "ok";
                        }else{
                            echo "not";
                        }
                    }else{
                        echo "err";
                    }
                }
                

            }
        }

        public function VerifyUserEmail(String $userEmail, Bool $bool){

            echo $count = $this->SingleData("SELECT COUNT(*) FROM `accounts` WHERE email = '$userEmail' LIMIT 1");

            if($count == 1){

                if($bool == true){
                    $find = $this->SingleRow("SELECT firstname, lastname, email, otp FROM `accounts` WHERE email = '$userEmail' LIMIT 1");
                
                    $characters = '0123456789';
                    $charactersLength = strlen($characters);
                    $otp = '';
                    for ($i = 1; $i <= 6; $i++) {
                        $otp .= $characters[rand(0, $charactersLength - 1)];
                    }
    
                    $this->ExecuteQuery("UPDATE `accounts` SET otp = '$otp' WHERE email = '$userEmail'");

                    $email = $find['email'];
                    $fullname = $find['firstname'] . ' ' . $find['lastname'];
                    // $username = $find['username'];
                    
                    // echo 3;
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
                    $mail->Subject = "AttenVax [$otp]";
                    $mail->Body = "
            
                        <center>
                        <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
                        </center>
                       
                        <p>The Verification code is: $otp </p>
                        <p>- AttenVax Team</p>"
                        
                        ;
            
                    // $mail = new PHPMailer(); // create a new object
                    // $mail->IsSMTP(); // enable SMTP
                    // $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                    // $mail->SMTPAuth = true; // authentication enabled
                    // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                    // $mail->Host = "smtp.gmail.com";
                    // $mail->Port = 465; //SSL:465 | TLS: 587
                    // $mail->IsHTML(true);
                    // $mail->Username = "jedterrazola03@gmail.com";
                    // $mail->Password = "lwioojflkykswqdp";
                    // $mail->SetFrom("jedterrazola03@gmail.com", "Jed Terrazola");
                    // $mail->Subject = "RJ Avancena Account [OTP]";
                    // $mail->Body = "
                                    
                    //                 <h1> Hi $fullname! </h1>
                    //                 <p>This is your new credentials for your account.</p>
                                            
                    //                         <p>&nbsp;&nbsp;&nbsp;&nbsp; OTP: <b>$otp</b></p>
                                            
                    //                         <p>You can sign-in here at this <a href=\"https://rjaenterprise.000webhostapp.com/\">link.</a></p>
                    //                 ";
                    $mail->AddAddress("$email");
    
                    $mail->Send();

                }
            }

        }

        public function VerifyUserOTP(String $user, Int $otp, Bool $bool){

            // $testUser = $this->SingleData("SELECT COUNT(*) FROM `accounts` WHERE username = '$user' AND otp = '$otp' LIMIT 1");
            $testEmail = $this->SingleData("SELECT COUNT(*) FROM `accounts` WHERE email = '$user' AND otp = '$otp' LIMIT 1");

            if($testEmail == 1){

                if($bool == true){
                    $find = $this->SingleRow("SELECT firstname, lastname, email, otp FROM `accounts` WHERE email = '$user' AND otp = '$otp' LIMIT 1");
                
                    $characters = '0123456789';
                    $charactersLength = strlen($characters);
                    $otp = '';
                    for ($i = 1; $i <= 6; $i++) {
                        $otp .= $characters[rand(0, $charactersLength - 1)];
                    }
    
                    $this->ExecuteQuery("UPDATE `accounts` SET otp = '$otp' WHERE email = '$user'");
    
                    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLen = strlen($chars);
                    $password = '';
                    for ($i = 1; $i <= 8; $i++) {
                        $password .= $chars[rand(0, $charactersLen - 1)];
                    }

                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $this->ExecuteQuery("UPDATE `accounts` SET hashed_password = '$hashed' WHERE email = '$user'");

                    $email = $find['email'];
                    $fullname = $find['firstname'] . ' ' . $find['lastname'];
                    // $username = $find['username'];
                    
                    // echo 3;
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
                    $mail->Subject = "AttenVax [$password]";
                    $mail->Body = "
            
                        <center>
                        <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
                        </center>
                       
                       
                        <p>This is your new credentials for your account.</p>
                                           
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;Password: <b>$password</b></p>
                                            
                                           
                        <p>- AttenVax Team</p>"
                        
                        ;
            
                    // $mail = new PHPMailer(); // create a new object
                    // $mail->IsSMTP(); // enable SMTP
                    // $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                    // $mail->SMTPAuth = true; // authentication enabled
                    // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                    // $mail->Host = "smtp.gmail.com";
                    // $mail->Port = 465; //SSL:465 | TLS: 587
                    // $mail->IsHTML(true);
                    // $mail->Username = "jedterrazola03@gmail.com";
                    // $mail->Password = "lwioojflkykswqdp";
                    // $mail->SetFrom("jedterrazola03@gmail.com", "Jed Terrazola");
                    // $mail->Subject = "RJ Avancena Account [Recovery]";
                    // $mail->Body = "
                    //                 <center>
                    //                 <img src='https://static.vecteezy.com/system/resources/previews/001/312/428/non_2x/monitor-with-password-and-shield-free-vector.jpg' width='30%' height='30%' />
                    //                 </center>
                    //                 <h1> Hi $fullname! </h1>
                    //                 <p>This is your new credentials for your account.</p>
                                           
                    //                         <p>&nbsp;&nbsp;&nbsp;&nbsp; Password: <b>$password</b></p>
                                            
                    //                         <p>You can sign-in here at this <a href=\"https://rjaenterprise.000webhostapp.com/\">link.</a></p>
                    //                 ";
                    $mail->AddAddress("$email");
    
                    $mail->Send();

                }
                echo 1;
            }

           
        }
    }


    $user = new User();
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['otp'])){
        $user->VerifyOTP($_POST['email'], $_POST['password'], $_POST['otp']);
    }elseif(isset($_POST['email'])){
        $user->VerifyEmail($_POST['email']);
    }elseif(isset($_POST['user']) && isset($_POST['pass'])){
        $user->VerifyAccount($_POST['user'], $_POST['pass']);
    }elseif(isset($_POST['userName']) && isset($_POST['otp'])){
        $user->ResendOTP($_POST['userName']);
    }elseif(isset($_POST['UserEmail'])){
        $user->VerifyUserEmail($_POST['UserEmail'], true);
    }elseif(isset($_POST['UserName']) && isset($_POST['OTP'])){
        $user->VerifyUserOTP($_POST['UserName'], $_POST['OTP'], true);
    }

    
?>