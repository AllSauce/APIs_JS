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
    
    if(!str_contain($email, '@') || !str_contain($email, '.')){
        echo "Invalid email";
        //header("Location: register.html?error=invalidemail");
        die;
    }
    if(strlen($username) < 3 ||strlen($username) > 15){
        echo "Username too long or too short";
        header("Location: register.html?error=invalidusername");
        die;
    }
    echo gettype($email);

    $sql = "SELECT * FROM users WHERE username=?";
    $result = query_get1($con, $sql, $username);
    $row = $result->fetchArray();

    if($row != NULL){
        header("Location: register.html?error=usertaken");
        die;
    }

    $sql = "Select * from users where email=?";
    $result = query_get1($con, $sql, $email);
    $row = $result->fetchArray();

    if($row != NULL){
        header("Location: register.html?error=emailtaken");
        die;
    }


    
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo $hash;
    echo '<br>';
    
    $sql = 'INSERT INTO users(username, Email, Hash) VALUES(?,?,?)';
    $res = query_get3($con, $sql, $username, $email, $hash);

    if(!$res){
        header("Location: register.html?error=sqlerror");
        echo "Failed to add to database";
        die;
    }
    echo "Sucess";
    header("Location: login.html");
    die;

}
else{
    header("Location: register.html?error=invalidrequest");
    die;
}

