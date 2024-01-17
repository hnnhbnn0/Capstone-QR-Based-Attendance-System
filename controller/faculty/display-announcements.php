<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Display Announcements</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <style>

        .col-sm-12:nth-child(4n+2) .card-body  {
            background-color: #003049; color: white;
        }
        .col-sm-12:nth-child(4n+3) .card-body  {
            background-color: #D62828; color: white;
        }
        .col-sm-12:nth-child(4n+4) .card-body  {
            background-color: #F77F00; color: white;
        }
        .col-sm-12:nth-child(4n+5) .card-body  {
            background-color: #FCBF49; color: white;
        }
    </style>
    <body>

    <?php
        require('../../controller/classes.php');
        error_reporting(0);
        $db = new Database();
        $str = new Filter();

        if($_POST['action'] == 'request' && $_POST['encoder'] != ''){

            $conn = $db->StartConnection();

            $data = [];
            $encoder = mysqli_real_escape_string($conn, $_POST['encoder']);

            $sql = "SELECT * FROM `announcements` WHERE acctid = '$encoder' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            $i = 0;

            $data['rowlimit'] = $db->NumRows($sql);

            while($row = mysqli_fetch_assoc($result)){


                echo '<div class="col-sm-12 mb-2">';
                echo '<div class="card-body p-3 rounded-2">';
                


                  echo '<div class="row">';
                      echo '<div class="col-sm-6">';
                          echo "<h6>". date('M d,', strtotime($row['date'])) . ' ' . date('h:iA', strtotime($row['time'])) . '</h6>';
                      echo '</div>';
                      echo '<div class="col-sm-3 text-start">';
                          echo "<h6>". $row['subject_code'] ."</h6>";
                      echo '</div>';
                      echo '<div class="col-sm-3 text-end">';
                          echo '<h6>';
                                // echo '<button class="text-light bg-transparent border-0 p-0 m-0 bi bi-eye-fill"></button>&nbsp;';
                                echo '<button class="text-light bg-transparent border-0 p-0 m-0 bi bi-trash-fill" onclick="DelAnnouncement('.$row['id'].')"></button>&nbsp;';
                          echo '</h6>';
                      echo '</div>';

                      echo '<div class="row">';
                          echo '<div class="col-sm-12">';
                              echo "<h4 class='text-truncate'>". stripslashes($row['title']) . "</h4>";
                              echo '<h6 class="text-truncate">';
                                $str->TextTruncate(($row['content']), 90);
                              echo "</h6>";
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
            echo "</div>";                            
            echo "</div>";
              }
            }
    ?>
        <script>
                    function DelAnnouncement(id){
                        console.log(id)
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/controller/faculty/announcement-controller.php',
                                method: 'post',
                                data:{
                                    delID: id,
                                },
                                success: function(response){
                                    console.log(response)
                                    Swal.fire({
                                        title: 'Delete Success!',
                                        text: "This announcement is successfully deleted.",
                                        icon: 'success',
                                    })
                                }
                            })

                        }
                    })
                }
        </script>
    </body>
</html>