<?php
    include('config.php');
    session_start();
    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($db,"select custid from customer where custid = '$user_check' ");
    if(!isset($_SESSION['login_user'])){
        header("location:login.php");
    }
?>