<?php
    require('../../controller/classes.php');

    $db = new Database();

    $conn = $db->StartConnection();

    final class Dashboard extends Database{
        public function AdminDashboard(){

            $conn = $this->StartConnection();

            $data = [];

            $sql = "SELECT COUNT(*) AS Active FROM accounts WHERE status = 'Active'";
            $data['active_count'] = $this->SingleData($sql);

            $sql2 = "SELECT COUNT(*) AS Inactive FROM accounts WHERE status = 'Inactive'";
            $data['inactive_count'] = $this->SingleData($sql2);

            $sql3 = "SELECT COUNT(*) AS Totals FROM accounts";
            $data['total_count'] = $this->SingleData($sql3);

            $sql4 = "SELECT COUNT(*) AS Faculty FROM accounts WHERE userlevel = 'Teacher'";
            $data['faculty_count'] = $this->SingleData($sql4);
            
            $sql5 = "SELECT COUNT(*) AS Students FROM accounts WHERE userlevel = 'Student'";
            $data['student_count'] = $this->SingleData($sql5);

            $sql6 = "SELECT COUNT(*) AS VaccinatedStudents FROM accounts WHERE vaxstat = 'Vaccinated' AND userlevel = 'Student'";
            $data['student_vaccinated_count'] = $this->SingleData($sql6);

            $sql7 = "SELECT COUNT(*) AS NotVaccinatedStudents FROM accounts WHERE vaxstat = 'Not Vaccinated' AND userlevel = 'Student'";
            $data['student_not_vaccinated_count'] = $this->SingleData($sql7);

            $sql8 = "SELECT COUNT(*) AS VaccinatedTeacher FROM accounts WHERE vaxstat = 'Vaccinated' AND userlevel = 'Teacher'";
            $data['faculty_vaccinated_count'] = $this->SingleData($sql8);

            $sql9 = "SELECT COUNT(*) AS NotVaccinatedTeacher FROM accounts WHERE vaxstat = 'Not Vaccinated' AND userlevel = 'Teacher'";
            $data['faculty_not_vaccinated_count'] = $this->SingleData($sql9);

            $sql13 = "SELECT COUNT(*) AS Student FROM accounts WHERE userlevel = 'Student' AND status = 'Active'";
            $data['student_active_count'] = $this->SingleData($sql13);

            $sql13 = "SELECT COUNT(*) AS Student FROM accounts WHERE userlevel = 'Student' AND status = 'Inactive'";
            $data['student_inactive_count'] = $this->SingleData($sql13);

            $sql10 = "SELECT COUNT(*) AS Faculty FROM accounts WHERE userlevel = 'Teacher' AND status = 'Active'";
            $data['faculty_active_count'] = $this->SingleData($sql10);

            $sql10 = "SELECT COUNT(*) AS Faculty FROM accounts WHERE userlevel = 'Teacher' AND status = 'Inactive'";
            $data['faculty_inactive_count'] = $this->SingleData($sql10);

            $sql11 = "SELECT COUNT(*) AS Student FROM accounts WHERE userlevel = 'Student' AND yearlevel ='1' AND status ='Active'";
            $data['student_firstyear'] = $this->SingleData($sql11);

            $sql11 = "SELECT COUNT(*) AS Student FROM accounts WHERE userlevel = 'Student' AND yearlevel ='2' AND status ='Active'";
            $data['student_secondyear'] = $this->SingleData($sql11);

            $sql11 = "SELECT COUNT(*) AS Student FROM accounts WHERE userlevel = 'Student' AND yearlevel ='3' AND status ='Active'";
            $data['student_thirdyear'] = $this->SingleData($sql11);

            $sql11 = "SELECT COUNT(*) AS Student FROM accounts WHERE userlevel = 'Student' AND yearlevel ='4' AND status ='Active'";
            $data['student_fourthyear'] = $this->SingleData($sql11);

            header('Content-Type: application/json');
            echo json_encode($data);
            header_remove();
        }
    }
    (new Dashboard())->AdminDashboard();
?>