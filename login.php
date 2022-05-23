<?php
include("connection.php");
include("functions.php");

session_start();

echo $_SERVER['REQUEST_METHOD'];

if($_SERVER['REQUEST_METHOD'] === "POST"){
    echo "Nice";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $result = query_get1($con, $sql, $username);
    var_dump($result);
    $row = $result->fetchArray();

    if($row == NULL || $row == false){
        header("Location: login.html?error=2");
        die;
    }
    var_dump($row);
    $hash = $row['Hash'];
    if(!password_verify($password, $hash)){
        header("Location: login.html?error=3");
        die;
    }
    $_SESSION['username'] = $row['Username'];
    $_SESSION['user_id'] = $row['UserID'];
    header("Location: index.php");
}
else{
    header("Location: login.html?error=12378912");
    die;
}
//Sends back to login page if not a POST request






