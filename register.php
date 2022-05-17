<?php

session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST" ){
    echo $_POST['username'];
    echo $_POST['password'];
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $result = $con->query("SELECT * FROM users WHERE username = '$username'");

    if($result->num_rows > 0){
        header("Location: register.html?error=2");
        die;
    }

    
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo $hash;
    echo '<br>';
    
    $preparequery = "INSERT INTO users(username, hash) VALUES(?,?)";
    var_dump($preparequery);
    $statement = $con->prepare($preparequery);
    $statement->bind_param("ss", $username, $hash);
    
    $statement->execute();
    $statement->close();
    header("Location: login.html");
    die;

}
else{
    header("Location: register.html?error=1");
    die;
}