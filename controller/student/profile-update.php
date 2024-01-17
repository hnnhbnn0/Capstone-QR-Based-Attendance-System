<?php
    require('../../controller/classes.php');
    error_reporting(0);
    $db = new Database();

    $conn = $db->StartConnection();


    if(isset($_POST['personal_id'])){

        $personal_id = mysqli_real_escape_string($conn, $_POST['personal_id']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
        $vaxstatus = mysqli_real_escape_string($conn, $_POST['vaxstatus']);

        $sql = "UPDATE accounts SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname',  gender = '$gender' , birthdate = '$birthday', vaxstat = '$vaxstatus' WHERE acctid = '$personal_id'";
        $result = mysqli_query($conn, $sql);

        // $data['rowlimit'] = $this->NumRows($sql);

        // $i = 0;

        // while($row = myqli_fetch_assoc($result)){
        //     $data['personal_id'][$i] = $row['personal_id'];
        //     $data['fullname'][$i] = $row['firstname'].''.$row['middlename'].''.$row['lastname'];
        //     $data['gender'][$i] = $row['gender'];
        //     $data['birthday'][$i] = $row['birthday'];
        //     $data['vaxstatus'][$i] = $row['vaxstatus'];
            
        //     $i++;

        if($result == true){
            $data = [];
            $data['title'] = "Update Success!";
            $data['html'] = "USER <span class='text-success fw-bolder h5'>$personal_id</span> is updated successfully.";
            // $data['notification'] = "<span class='text-dark fw-bolder h5'>Update Success!</span><br>USER <span class='text-success fw-bolder h6'>$username</span> is updated successfully.";
            $data['icon'] = "success";

        }else{
            $data = [];
            $data['title'] = "Update Failed!";
            $data['html'] = "USER <span class='text-danger fw-bolder h5'>$personal_id</span> update error.";
            // $data['notification'] = "<span class='text-dark fw-bolder h5'>Update Error!</span><br>USER <span class='text-danger fw-bolder h6'>$personal_id</span> update error.";
            $data['icon'] = "danger";
        }
        // echo json_encode($data);
        header('Content-Type: application/json');
        echo json_encode($data);    
        header_remove();
    // }
}


    // if(isset($_POST['profile_id'])){
        
    //     $profile_id = mysqli_real_escape_string($conn, $_POST['profile_id']);

    //     $basedir = "../profile/";
    //     mdkir($basedir);

    //     $dir - "../profile/$personal_id/";
    //     mdkir($dir);

    //     $file = $img->UploadImage($dir, $personal_id, true);
    //     $imagesource = $dir.$file;
    //     $sql = "UPDATE accounts SET profilesrc = '$imagesource'";
    //     $result = mysqli_query($conn, $sql);
    // }

    $img = new Image();

    if(isset($_POST['profile_id'])){

        $profile_id = mysqli_real_escape_string($conn, $_POST['profile_id']);
        $filename = $_FILES['file']['name'];
        
        $basedir = "../../profile/";
        mkdir($basedir);

        $dir ="../../profile/$profile_id/";
        mkdir($dir);
        $file = $img->ReplaceImage($profile_id, $dir, $profile_id, true);
        $imagesource = $dir.$file;

        $sql = "UPDATE accounts SET profilesrc = '$imagesource' WHERE acctid = '$profile_id' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        echo json_encode("hahaha"); 


    }

    if(isset($_POST['acct_info_id'])){
        $account_info_id = mysqli_real_escape_string($conn, $_POST['acct_info_id']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE accounts SET email = '$email', hashed_password = '$hashed_password' WHERE acctid = '$account_info_id'" ;
        echo json_encode("hahaha"); 

        $result = mysqli_query($conn, $sql);
        if($result == true){

            $data = [];
            $data['title'] = "Update Success!";
            $data['html'] = "USER <span class='text-success fw-bolder h5'>$account_info_id</span> is updated successfully.";
            // $data['notification'] = "<span class='text-dark fw-bolder h5'>Update Success!</span><br>USER <span class='text-success fw-bolder h6'>$username</span> is updated successfully.";
            $data['icon'] = "success";
        }else{

            $data = [];
            $data['title'] = "Update Failed!";
            $data['html'] = "USER <span class='text-danger fw-bolder h5'>$account_info_id</span> is updated successfully.";
            // $data['notification'] = "<span class='text-dark fw-bolder h5'>Update Success!</span><br>USER <span class='text-success fw-bolder h6'>$username</span> is updated successfully.";
            $data['icon'] = "danger";
        }

        // echo json_encode($data);
        header('Content-Type: application/json');
        echo json_encode($data);    
        header_remove();
    }


?>