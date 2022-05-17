<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sysdb";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "Connection successful";
}



