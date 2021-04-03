<?php
    include('config.php');
    session_start();
    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($db,"select eid from employee where eid = '$user_check' ");
    if(!isset($_SESSION['login_user'])){
        header("location:login.php");
    }
?>