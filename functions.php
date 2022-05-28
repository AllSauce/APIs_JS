<?php

include("connection.php");

function check_login(){
    if(isset($_SESSION['user_id'])){
        //$user_id = $_SESSION['user_id'];
        //$query = "SELECT * FROM users WHERE userid = '$user_id'";
        //$result = $con->query($query);
        //$user_data = $result->fetchArray();
        return true;
    }
    else{
        return false;
        die;
    }
}
function displayCommentwithplace($activerow){
    if(check_login()){
      if($activerow['UserID'] == $_SESSION['user_id'] || $_SESSION['RoleID'] == 1){
        echo '
            <div class = "comment-container">
                <div class = "comment-header">
                    <div class = "comment-header-right">                                        
                    <h3 id="comment">Användare: '.$activerow['Username']. ' Flygfält: <a href="comments.php?airfield='. $activerow['Airfield'].'">' . $activerow['Airfield'] . '</a></h3>
                        <p id="comment">'.$activerow['Text'].'</p>
            
                    </div>
                </div>
                <div class = "comment-footer">
                    <div class = "comment-footer-right">
                        <form action = "comment.php" method = "POST">
                        <input type = "hidden" name = "commentid" value = "'.$activerow['CommentID'].'">
                        <input type = "submit" value = "Delete">
                        </form>
                    </div>
                <hr id="comment">
            </div>';
      }
      else{
        echo '<div class = "comment-container">
        <div class = "comment-header">
  
        <h3 id="comment">Användare: '.$activerow['Username']. ' Flygfält: <a href="comments.php?airfield='. $activerow['Airfield'].'">' . $activerow['Airfield'] . '</a></h3>
            <p id="comment">'.$activerow['Text'].'</p>
            <hr id="comment">
  
        </div>';
  
      }
    }
    else{
      echo '<div class = "comment-container">
        <div class = "comment-header">
          <div class = "comment-header-right">
          <h3 id="comment">Användare: '.$activerow['Username']. ' Flygfält: <a href="comments.php?airfield='. $activerow['Airfield'].'">' . $activerow['Airfield'] . '</a></h3>
            <p id="comment">'.$activerow['Text'].'</p>
            <hr id="comment">
          </div>
        </div>';
    }
}

function displayComment($activerow){
    if(check_login()){
      if($activerow['UserID'] == $_SESSION['user_id'] || $_SESSION['RoleID'] == 1){
        echo '<div class = "comment-container">
        <div class = "comment-header">
          <div class = "comment-header-right">
            <h3 id="comment">'.$activerow['Username'].'</h3>
            <p id="comment">'.$activerow['Text'].'</p>
  
          </div>
        </div>
        <div class = "comment-footer">
          <div class = "comment-footer-right">
            <form action = "comment.php" method = "POST">
              <input type = "hidden" name = "commentid" value = "'.$activerow['CommentID'].'">
              <input type = "submit" value = "Delete">
            </form>
          </div>
          <hr id="comment">
        </div>';
      }
      else{
        echo '<div class = "comment-container">
        <div class = "comment-header">
  
            <h3 id="comment">Användare: '.$activerow['Username'].'</h3>
            <p id="comment">'.$activerow['Text'].'</p>
            <hr id="comment">
  
        </div>';
  
      }
    }
    else{
      echo '<div class = "comment-container">
        <div class = "comment-header">
          <div class = "comment-header-right">
            <h3 id="comment">Användare: '.$activerow['Username'].'</h3>
            <p id="comment">'.$activerow['Text'].'</p>
            <hr id="comment">
          </div>
        </div>';
    }
}
  
function str_contain(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
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
