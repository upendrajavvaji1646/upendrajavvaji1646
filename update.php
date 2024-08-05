<?php 

    session_start();
    require "conn.php";

    $decksize= $_GET["decksize"];
    $points= $_GET["points"];
    $currentposition= $_GET["current"];
    $defuser= $_GET["defuse"];
    $opencard= $_GET["opencard"];

    $user=$_SESSION["username"];

    
    update($points, $decksize, $currentposition, $defuser, $opencard, $user, $conn);
    header("Location:index.php");

?>