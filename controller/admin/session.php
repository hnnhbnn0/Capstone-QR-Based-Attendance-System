<?php
    session_start();
    if(!empty($_SESSION['Userlevel'] == 'Admin')){
        $session_fullname = $_SESSION['Name'];
        // $session_email = $_SESSION['Email'];
        $session_userlevel = $_SESSION['Userlevel'];
        $session_account_id = $_SESSION['AccountID'];
        // $session_account_no = $_SESSION['AccountNo'];
    }else{
        session_destroy();
        header('Location: ../main/login.php');
    }
    // session_start();
    // if(!isset($_SESSION['Email']) && !isset($_SESSION['Userlevel']) && !isset($_SESSION['Name']) && !isset($_SESSION['AccountID']) && !isset($_SESSION['AccountNo'])){
    //     session_destroy();
    //     header('Location: ../main/login.php');
    // }elseif(!empty($_SESSION['Userlevel'] == 'Admin')){
    //     $session_fullname = $_SESSION['Name'];
    //     $session_email = $_SESSION['Email'];
    //     $session_userlevel = $_SESSION['Userlevel'];
    //     $session_account_id = $_SESSION['AccountID'];
    //     $session_account_no = $_SESSION['AccountNo'];
    // }
?>