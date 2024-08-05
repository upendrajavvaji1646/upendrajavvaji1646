<?php

    session_start();
    require "conn.php";

    create_array($_SESSION["username"],$conn);
    header("Location:index.php")

?>