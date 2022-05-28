<?php


include ("connection.php");
include ("functions.php");

session_start();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['comment'])){
        $comment = $_POST['comment'];
        $airfield = $_POST['airfield'];
        $userid = $_SESSION['user_id'];

        $sql = "INSERT INTO comments(Text, UserID, Airfield) VALUES(?,?,?)";
        $res = query_get3($con, $sql, $comment, $userid, $airfield);

        header("Location: ". $_SERVER['HTTP_REFERER']);
    }
    elseif(isset($_POST['commentid'])){
        $commentID = $_POST['commentid'];
        $sql = "DELETE FROM comments WHERE CommentID=?";
        $res = query_get1($con, $sql, $commentID);
        header("Location: ". $_SERVER['HTTP_REFERER']);
    }
    
}
else{
    header("Location: ". $_SERVER['HTTP_REFERER']);
    die;
}
?>