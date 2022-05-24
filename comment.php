<?php


include ("connection.php");
include ("functions.php");

session_start();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['comment'])){
        $comment = $_POST['comment'];
    $userid = $_SESSION['user_id'];

    $sql = "INSERT INTO comments(Text, UserID) VALUES(?,?)";
    $res = query_get2($con, $sql, $comment, $userid);

    header("Location: index.php");
    }
    elseif(isset($_POST['commentid'])){
        $commentID = $_POST['commentid'];
        $sql = "DELETE FROM comments WHERE CommentID=?";
        $res = query_get1($con, $sql, $commentID);
        header("Location: index.php");
    }
    
}
else{
    header("Location: index.php");
    die;
}
?>