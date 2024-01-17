<?php
    require('../../controller/classes.php');
    require('../../vendor/autoload.php');
    
    use PHPMailer\PHPMailer\PHPMailer;

    $db = new Database();
    $str = new Filter();
    $conn = $db->StartConnection();

    if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['subject']) && isset($_POST['yearlevel']) && isset($_POST['section']) && isset($_POST['encoder']) ){

        $data = [];
        date_default_timezone_set('Asia/Manila');
        $currentDatetime = date('M d, Y H:i:s');
        
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $yearlevel = mysqli_real_escape_string($conn, $_POST['yearlevel']);
        $section = mysqli_real_escape_string($conn, $_POST['section']);
        $encoder = mysqli_real_escape_string($conn, $_POST['encoder']);

        $isExecute = $db->ExecuteQuery("INSERT INTO `announcements` (`title`,`content`,`subject_code`,`yearlevel`,`section`,`acctid`) VALUES('$title','$content','$subject','$yearlevel','$section','$encoder')");
    

        
        if($isExecute == true){

            $data['title'] = "Add Success!";
            $data['html'] = "Title: '<span class=\"text-success\">$title</span>' is created successfully at $currentDatetime.";
            $data['icon'] = "success";

        }else{
            
            $data['title'] = "Add Failed!";
            $data['html'] = "Title: '<span class=\"text-danger\">$title</span>' is created unsuccessfully.";
            $data['icon'] = "error";

        }

        header('Content-Type: application/json');
        echo json_encode($data);
        header_remove();
       
    }

    if(isset($_POST['id']) && isset($_POST['fetch'])){
        $id = $_POST['id'];
        $fetch = $_POST['fetch'];
        if($fetch == 'student-announcements'){
            $sql = "SELECT ann.*, accx.firstname, accx.lastname FROM `accounts` acc JOIN `announcements` ann ON(acc.yearlevel = ann.yearlevel AND acc.section = ann.section AND acc.status = 'Active' AND acc.acctid = '$id') JOIN `accounts` accx ON(ann.acctid = accx.acctid) ORDER BY ann.id DESC";
            $result = mysqli_query($conn, $sql);


            $data = [];

            $data['rowlimit'] = $db->NumRows($sql);

            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $data['title'][$i] = $row['title'];
                $data['content'][$i] = $row['content'];
                $data['subject'][$i] = $row['subject_code'];
                $data['date'][$i] = date('F j, Y', strtotime($row['date']));
                $data['time'][$i] = date('h:i:s A', strtotime($row['time']));
                $data['encoder'][$i] = $row['firstname'] . ' ' . $row['lastname'];
                $i++;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
            header_remove();

        }
    }

    if(isset($_POST['delID'])){
        $id = mysqli_real_escape_string($conn,$_POST['delID']);
        $sql = "DELETE FROM announcements WHERE id = '$id'";
        $result = mysqli_query($conn,$sql);
    }
?>