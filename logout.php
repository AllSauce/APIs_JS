<?php

    

    include ("connection.php");
    include ("functions.php");

    session_start();
    session_destroy();
    header("Location: login.html");
    die;
   
