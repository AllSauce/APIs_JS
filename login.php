<?php
include("connection.php");
include("functions.php");

session_start();
$_SESSION;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usernamequery = "SELECT * FROM users WHERE username =  ?";
    $usernameStatement = $con->prepare($usernamequery);
    $usernameStatement->bind_param("s", $username);    
    $hash = $usernameStatement->execute();
    
    if(password_verify($password, $hash)){
        $selectPrepareQuery = "SELECT userid FROM users WHERE username = ?";
        $statement = $con->prepare($selectPrepareQuery);
        $statement->bind_param("s", $username);
        $user_id = $statement->execute();
        $statement->close();                              
        $_SESSION['user_id'] = $user_id;
        header("Location: index.html");
        die;
    }
    else{
        header("Location: login.html?error=1");
        die;
    }

}
else{
    header("Location: login.html");
    die;
}





