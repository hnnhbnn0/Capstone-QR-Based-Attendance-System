<?php
    require('../../controller/classes.php');
    error_reporting(0);
    $db = new Database();
    $str = new Filter();

    if(isset($_POST['subject']) && isset($_POST['id'])){

        $conn = $db->StartConnection();

        $id = $db->PostSecure($_POST['id']);

        $subjects = $_POST['subject'];

        sort($subjects);

        $count = count($subjects);

        $arr_sub = [];
        $arr_sec = [];
        $arr = [];

        for($i = 0; $i < $count; $i++){
                $arr[$i] = explode("-", $subjects[$i]);
        }
        
        $odd = 0;
        $even = 0;

        for($x = 0; $x < $count; $x++){
            for($y = 0; $y < 2; $y++){

                if($y % 2 == 0){
                    $arr_sub[$even] = $arr[$x][$y];
                    $even++;
                }else{
                    $arr_sec[$odd] = $arr[$x][$y];
                    $odd++;
                }

            }
        }

        $inserted = 0;
        $redundant = 0;
        for($z = 0; $z < $count; $z++){
            $subcode = $arr_sub[$z];
            $yearlevel = substr($arr_sec[$z], 0, 1);
            $section = substr($arr_sec[$z], 1, 2);

            if($db->NumRows("SELECT subcode FROM `subject` WHERE subcode = '$subcode' AND yearlevel = '$yearlevel' AND section = '$section'") == 0){
                
             
                $acad_key = $db->SingleData("SELECT acad_key FROM `semester` WHERE `status` = 'Active'");
                $db->ExecuteQuery("INSERT INTO `subject` (acctid, subcode, yearlevel, section, acad_key) VALUES ('$id', '$subcode', '$yearlevel', '$section',  '$acad_key')");

                $inserted++;
            }else{
                $redundant++;
            }
           
        }
        $data = [];
        $data['title'] = 'Status Report!';
        $data['html'] = "$inserted subjects is successfully added!";
        $data['icon'] = 'success';

        header("Content-type: application/json");
        echo json_encode($data);
        header_remove();
 
        

    }    
?>