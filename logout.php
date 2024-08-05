<?php

    require "conn.php";

    session_start();
    if(isset($_SESSION['username'])){
        unset($_SESSION['username']);
        unset($_SESSION['status']);
        session_destroy();
        header('location: index.php');
    }else{
        header('Location:login.php');
    }


?>