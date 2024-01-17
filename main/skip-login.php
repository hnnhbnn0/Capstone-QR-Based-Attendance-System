<?php
    session_start();


    $_SESSION['Name'] = "Admin is Traitor";
    $_SESSION['Email'] = "chubsbaker3@gmail.com";
    $_SESSION['Userlevel'] = "Admin";
    $_SESSION['AccountID'] = "2022000000";
    $_SESSION['AccountNo'] = "ADMIN00000001";
    $_SESSION['Yearlevel'] = "";
    $_SESSION['Section'] = "";

    header("Location: ../admin/dashboard.php");


    // $_SESSION['Name'] = "TEST TWO";
    // $_SESSION['Email'] = "3lannah0@gmail.com";
    // $_SESSION['Userlevel'] = "Teacher";
    // $_SESSION['AccountID'] = "2";
    // $_SESSION['AccountNo'] = "user_2ebd57ff48fcb8b83aede0303a67b0";
    // $_SESSION['Yearlevel'] = "";
    // $_SESSION['Section'] = "";

    // header("Location: ../faculty/dashboard.php");

    // $_SESSION['Name'] = "Hannah Mae Ciriaco ";
    // $_SESSION['Email'] = "hnnhciriaco@gmail.com";
    // $_SESSION['Userlevel'] = "Student";
    // $_SESSION['AccountID'] = "2019500901";
    // $_SESSION['AccountNo'] = "STUD00000001";
    // $_SESSION['Yearlevel'] = "4";
    // $_SESSION['Section'] = "C";

    // header("Location: ../student/generate-qr.php");
