<?php

include("connection.php");
include("functions.php");
session_start();
check_login();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $_GET['airfield']?> Comments</title>
</head>
<body>
  <?php
  if(!check_login()){
    echo'
    <div class="header">
    <nav>
        <ul id="main-menu">
          <li><a href="index.php"><img src="img/plane-logo.png" id="logo"></a></li>
          <li><a href="login.php">LOGGA IN</a></li>
          <li><a href="register.php">SKAPA KONTO</a></li>
        </ul>
    </nav>
  </div>';
  }
  else {
    echo'
    <div class="header">
    <nav>
        <ul id="main-menu">
          <li><a href="index.php"><img src="img/plane-logo.png" id="logo"></a></li>
          <li><a href="index.php">HEM</a></li>
          <li><a href="logout.php">LOGGA UT</a></li>
        </ul>
    </nav>';
  }

  ?>


  <div class="row">
    <div class="column">
      <div class="left-column">

        <?php
        if(!isset($_GET['airfield'])){
            header("Location: index.php");
        }
        if(strlen($_GET['airfield']) != 3){
            header("Location: index.php");
        }

        $airfield = $_GET['airfield'];
        $sql = "SELECT * FROM comments JOIN users ON comments.UserID = users.UserID WHERE Airfield = ? ORDER BY CommentID DESC";

        $result = query_get1($con, $sql, $airfield);

        if(check_login()){
            echo'
            <div id = commenter>

            <h2>Dela med dig av din upplevelse från '.$airfield .'!</h2>
            <p>Guida andra flightspotter kring flygfält! Dela med dig av bästa utkiksplatsen eller vad för plan du sett vid '.$airfield .'.</p>
            <br>
              <form action = "comment.php" method = "POST">
                <textarea name = "comment" rows = "5" cols = "50" required></textarea>
                <br>
                <input type = "submit" value = "Skicka">
                <input type="hidden" name="airfield" value="'.$airfield .'" />
              </form>

            </div>
            ';
        }
        else{
            echo '<div id = "commenter">
            <h2>Hur var din upplevelse vid '.$airfield .'?</h2>
            <p>Hjälp andra hitta en bra flygfält! Logga in och dela med dig av din upplevelse!</p>
            </div>';
        }
        ?>
      </div>
        </div>

        <div class="column">
          <div class="right-column">
            <div id = comments>
        <?php
        echo '<h2>Kommentarer för '.$airfield .'</h2>';
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
  </div>

</div>
</div>
</div>

</body>
</html>
