<?php 

    session_start();
    require "conn.php";


    $user=$_SESSION["username"];
    $sql="update game set currentposition='-1' where username='$user'";
    $result=$conn->query($sql);
    if(!$result){
        die("Update failed...");
    }

    header("Location:index.php");

?>