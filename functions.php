<?php

function check_login($con){
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE userid = '$user_id'";
        $result = $con->query($query);
        $user_data = $result->fetchArray();
        return $user_data;
    }
    else{        
        header("Location: login.html");
        die;
    }
}
