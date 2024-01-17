<?php
    require('../../controller/classes.php');
    // error_reporting(0);

    final class Profile extends Database{
        public function ProfileDisplay(String $acctid, bool $bool){
            $conn = $this->StartConnection();

            if(!empty($acctid) && $bool == true){
                $sql = "SELECT * FROM accounts WHERE acctid = '$acctid'";

                $result = mysqli_query($conn, $sql);

                $data['rowlimit'] = $this->NumRows($sql);

                $i = 0;

                if($row = mysqli_fetch_assoc($result)){
                    $data['acctid'] = $row['acctid'];

                    $data['firstname'] = $row['firstname'];
                    $data['middlename'] = $row['middlename'];
                    $data['lastname'] = $row['lastname'];

                    $data['fullname'] = $row['firstname'] . ' ' . $row['lastname'];  
                    $data['qr_id'] = $row['qr_id'];
                    $data['gender'] = $row['gender'];

                    $data['vaxstat'] = $row['vaxstat'];

                    $data['birthday'] = $row['birthdate'];
                    $data['profilesrc'] = $row['profilesrc'];

                    $data['email'] = $row['email'];

                }

                header('Content-Type: application/json');
                echo json_encode($data);
                header_remove();

            }

        }
    }

    $pro = new Profile();
   
    if(isset($_POST['acctid']) && isset($_POST['fetch'])){
        if($_POST['fetch'] == 'profile'){
            $acctid = $_POST['acctid'];
            $pro->ProfileDisplay($acctid, true);
        }
    }
?>