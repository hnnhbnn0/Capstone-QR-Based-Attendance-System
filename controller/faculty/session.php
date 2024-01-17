<?php
    session_start();
    if(!empty($_SESSION['Userlevel'] == 'Teacher')){
        $session_fullname = $_SESSION['Name'];
        $session_userlevel = $_SESSION['Userlevel'];
        $session_account_id = $_SESSION['AccountID'];
    }else{
        session_destroy();
        header('Location: ../main/login.php');
    }
?>