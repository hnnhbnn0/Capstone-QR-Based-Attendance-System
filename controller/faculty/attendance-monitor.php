

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>


    <?php
            require('../../controller/classes.php');

            $db = new Database();

            if(isset($_POST['encoder']) && isset($_POST['session'])){

                $theme = $_POST['theme'];

                $conn = $db->StartConnection();

                $session = mysqli_real_escape_string($conn, $_POST['session']);
                $encoder = mysqli_real_escape_string($conn, $_POST['encoder']);
                $sql = "SELECT att.*, acc.firstname, acc.middlename, acc.lastname, acc.acctid FROM `attendance` att JOIN `accounts` acc ON(att.qr_id = acc.qr_id AND acc.userlevel = 'Student' AND att.session = '$session' AND att.teacher_id = '$encoder') ORDER BY att.id ASC";
                $result = mysqli_query($conn, $sql);


    ?>

        <table class="table table-striped table-<?php echo $theme; ?>">
            <thead class="h5 text-center mb-0 text-truncate" id="attendance-thead">
            <tr class="h6">
                <th>No.</th>
                <th>Student ID</th>
                <th>Full Name</th>
                <th>Section</th>
                <th>Date/Time</th>
            </tr>
            </thead>
            <tbody class="h6 text-center mb-0 " id="attendance-tbody">



            <?php


                    if($rows = mysqli_num_rows($result) > 0){


                        $i = 1;
                        while($row = mysqli_fetch_assoc($result)){
                            
                            $student_id = $row['acctid'];
                            $qr_id = $row['qr_id'];
                            $fetch = $db->SingleRow("SELECT firstname, lastname FROM `accounts` WHERE `acctid` = '$student_id' AND `userlevel` = 'Student'");
                            $fullname = $fetch['firstname'] . ' ' . $fetch['lastname'];
                            $yearsec = $row['yearlevel'] . $row['section'];
                            $timestamp = $row['date'] . ' ' . $row['time'];
                            $datetime = date('g:i:s A', strtotime($timestamp));

                            echo "
                                <tr class='h6'>
                                    <td>$i</td>
                                    <td>$student_id</td>
                                    <td>$fullname</td>
                                    <td>$yearsec</td>
                                    <td>$datetime</td>
                                </tr>
                            ";
                            $i++;
                        }

                    }else{
                            echo "
                                <tr class='h6'>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            ";
                    }

                }
                

            ?>

            </tbody>
        </table>

  </body>
</html>