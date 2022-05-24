<?php
include("connection.php");
include("functions.php");
session_start();
check_login();

function str_contain(string $haystack, string $needle): bool {
  return '' === $needle || false !== strpos($haystack, $needle);
}

function displayComment($activerow){
  if(check_login()){
    if($activerow['UserID'] == $_SESSION['user_id'] || $_SESSION['RoleID'] == 1){
      echo '<div class = "comment-container">
      <div class = "comment-header">          
        <div class = "comment-header-right">
          <h3>'.$activerow['Username'].'</h3>
          <p>'.$activerow['Text'].'</p>
        </div>
      </div>
      <div class = "comment-footer">          
        <div class = "comment-footer-right">
          <form action = "comment.php" method = "POST">
            <input type = "hidden" name = "commentid" value = "'.$activerow['CommentID'].'">
            <input type = "submit" value = "Delete">
          </form>
        </div>
      </div>';
    }
    else{
      echo '<div class = "comment-container">
      <div class = "comment-header">          
        <div class = "comment-header-right">
          <h3>'.$activerow['Username'].'</h3>
          <p>'.$activerow['Text'].'</p>
        </div>
      </div>';
    
    }
  }
  else{
    echo '<div class = "comment-container">
      <div class = "comment-header">          
        <div class = "comment-header-right">
          <h3>'.$activerow['Username'].'</h3>
          <p>'.$activerow['Text'].'</p>
        </div>
      </div>';
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <script language="javascript" type="text/javascript"></script>

  <!-- Load Esri Leaflet from CDN Work in progress för att ev koppla ihop API 2-->
      <script src="https://unpkg.com/esri-leaflet@^3.0.8/dist/esri-leaflet.js"></script>

      <!-- Load Esri Leaflet Vector from CDN work in progress-->
      <script src="https://unpkg.com/esri-leaflet-vector@3.1.1/dist/esri-leaflet-vector.js" crossorigin=""></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link
  rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
  integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
  crossorigin=""
  />
  <script
  src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
  integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
  crossorigin=""
  ></script>

  <title>Hitta ditt utegym</title>
</head>

<body>

  <?php
  if(!check_login()){
    echo'
    <div class="header">
    <nav>
        <ul id="main-menu">
          <li><img src="img/utegym-logo.png" id="logo"></li>
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
          <li><img src="img/utegym-logo.png" id="logo"></li>
          <li><a href="index.php">HEM</a></li>
          <li><a href="logout.php">LOGGA UT</a></li>
        </ul>
    </nav>'; 
  }

  ?>
  <div class="row">
    <div class="column">
      <div class="left-column">
        <h1><b>Lorem Ipsum</b></h1>
        <p>Lorem ipsum </p>
        <br>
        <br>[Sökfält kopplat till kartan - kolla vad som finns i API dokumentationen]
        <br>
        <br>
        <br><p class="small-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>

    <div class="column">
      <div class="right-column">
        <div id="pMap">
        <script type = "text/javascript" src ="JavaScript/main.js"></script>
        </div>
      </div>
    </div>
  </div>

  <div>
    <form action="index.php" method = "POST">
      <input type="text" name="search" placeholder="Sök efter kommentarer">
      <input type="submit" id="search-button" value="Sök">
    </form>
  </div>



  <?php 
  if(check_login()){
    echo'
    <div id = commenter>        
      
      <h3>Lämna en kommentar!</h3>
      <form action = "comment.php" method = "POST">
        <textarea name = "comment" rows = "5" cols = "50"></textarea>
        <br>
        <input type = "submit" value = "Comment">
      </form>
    
    </div> 
    ';
  }
  else{
    echo '<div id = "commenter">
    <h3>Logga in för att kommentera!</h3>
    </div>';
  }

  ?>

  <div id = comments>
    <?php
      
      
      $sql = "SELECT * FROM comments JOIN users ON comments.UserID = users.UserID ORDER BY commentid DESC";                        
      $result = query_get0($con, $sql);
      
                          
      //Comment section
      echo '<h1>Kommentarer</h1>';
      while($row = $result->fetchArray()){
        if(isset($_POST['search'])){        
          if(str_contain(strtolower($row['Text']), strtolower($_POST['search'])) || str_contain(strtolower($row['Username']), strtolower($_POST['search']))){
              displayComment($row);
          }
        }
        else{
          displayComment($row);
        }
        
      }            
    ?>
  </div>
</body>
</html>
