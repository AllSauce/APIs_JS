<?php

include("connection.php");

function check_login($con){
    if(isset($_SESSION['user_id'])){
        //$user_id = $_SESSION['user_id'];
        //$query = "SELECT * FROM users WHERE userid = '$user_id'";
        //$result = $con->query($query);
        //$user_data = $result->fetchArray();
        return;
    }
    else{
        header("Location: login.html");
        die;
    }
}


function query_get0($con, $sql){
    $result = $con->query($sql);
    if(!$result){
        die("Query failed");
    }
    return $result;
}
//Returns a sqlite3 result object from sql query with 1 parameter
//uses prepared statements
function query_get1(SQLite3 $con, string $sql, $binder1)
{
    
    if($stmt = $con->prepare($sql)){

        $stmt->bindParam("1", $binder1);
        $result = $stmt->execute();
        
        return $result;

    }
    
}

function query_get2(SQLite3 $con, string $sql, $binder1, $binder2)
{
    
    if($stmt = $con->prepare($sql)){

        $stmt->bindParam("1", $binder1);
        $stmt->bindParam("2", $binder2);
        $result = $stmt->execute();
        
        return $result;

    }
    
}

function query_get3(SQLite3 $con, string $sql, $binder1, $binder2, $binder3)
{
    
    if($stmt = $con->prepare($sql)){

        $stmt->bindParam("1", $binder1);
        $stmt->bindParam("2", $binder2);
        $stmt->bindParam("3", $binder3);
        $result = $stmt->execute();
        
        return $result;

    }
    
}
