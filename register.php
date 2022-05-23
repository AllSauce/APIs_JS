<?php

session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST" ){
    echo $_POST['username'];
    echo $_POST['password'];
    
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    

    echo gettype($email);

    $sql = "SELECT * FROM users WHERE username=?";
    $result = query_get1($con, $sql, $username);
    $row = $result->fetchArray();

    if($row != NULL){
        header("Location: register.html?error=2");
        die;
    }

    $sql = "Select * from users where email=?";
    $result = query_get1($con, $sql, $email);
    $row = $result->fetchArray();

    if($row != NULL){
        header("Location: register.html?error=3");
        die;
    }


    
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo $hash;
    echo '<br>';
    
    $sql = 'INSERT INTO users(username, Email, Hash) VALUES(?,?,?)';
    $res = query_get3($con, $sql, $username, $email, $hash);

    if(!$res){
        header("Location: register.html?error=4");
        echo "Failed to add to database";
        die;
    }
    echo "Sucess";
    header("Location: login.html");
    die;

}
else{
    header("Location: register.html?error=1");
    die;
}

