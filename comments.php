<?php



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $_GET['Airfield']?> Comments</title>   
</head>


    <div id = comments>
        


        <?php
        include("connection.php");
        include("functions.php");
        session_start();
        
        $airfield = $_GET['airfield'];
        $sql = "SELECT * FROM comments JOIN users ON comments.UserID = users.UserID WHERE Airfield = ? ORDER BY CommentID DESC";
        
        $result = query_get1($con, $sql, $airfield);

        if(check_login()){
            echo'
            <div id = commenter>
        
            <h2>Dela med dig av din upplevelse!</h2>
            <p>Hjälp andra hitta en bra flygfält! Har du sätt någonting här?</p>
            <br>
              <form action = "comment.php" method = "POST">
                <textarea name = "comment" rows = "5" cols = "50" required></textarea>
                <br>
                <input type = "submit" value = "Comment">
                <input type="hidden" name="airfield" value="'.$airfield .'" />
              </form>
        
            </div>
            ';
        }
        else{
            echo '<div id = "commenter">
            <h2>Hur var din upplevelse?</h2>
            <p>Hjälp andra hitta en bra flygfält! Logga in och dela med dig av din upplevelse!</p>
            </div>';
        }
        //Comment section
        echo '<h2>Kommentarer</h2>';
        if(isset($_SERVER['HTTP_REFERER'])){
            $referer = $_SERVER['HTTP_REFERER'];
            echo '
            <div>
                <form action="' . $referer . '" method = "GET">
                    <input type="hidden" name="airfield" value="'.$airfield .'" />
                    <input type="text" name="search" placeholder="Sök efter kommentarer">
                    <input type="submit" id="search-button" value="Sök">                   
                </form>
            </div>';
        }
        else {
            echo '
            <div>
                <form action="comments.php" method = "GET">
                    <input type="hidden" name="airfield" value="'.$airfield .'" />
                    <input type="text" name="search" placeholder="Sök efter kommentarer">
                    <input type="submit" id="search-button" value="Sök">                    
                </form>
            </div>';
        }
        
        
        while($row = $result->fetchArray()){
            if(isset($_GET['search'])){
                if(str_contain(strtolower($row['Text']), strtolower($_GET['search'])) || str_contain(strtolower($row['Username']), strtolower($_GET['search']))){
                displayComment($row);
                }
            }
            else{
            displayComment($row);
            }

        }
    ?>
  </div>
</html>