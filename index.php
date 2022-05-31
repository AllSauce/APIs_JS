<?php
include("connection.php");
include("functions.php");
session_start();
check_login();

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <script language="javascript" type="text/javascript"></script>

  <!-- Load Leaflet from CDN -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" crossorigin="" />
      <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>

      <!-- Load Esri Leaflet from CDN -->
      <script src="https://unpkg.com/esri-leaflet@^3.0.8/dist/esri-leaflet.js"></script>
      <script src="https://unpkg.com/esri-leaflet-vector@^3.0.0/dist/esri-leaflet-vector.js"></script>

  <title>Flightspot</title>
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
        <h1><b>Flightspotting made easy</b></h1>
        <p>Följ uppdateringar från andra flightspotters över hela världen för de bästa tipsen. Skapa ett konto och börja dela med dig du också!</p>
          <br>
          <br>
        <br>
        <br>
        <br><p class="small-body">Platsdatan för flygplatser tillhandhålls av <a href="https://ourairports.com/" target=”_blank”>OurAirports.com (public domain)</a>.</p>
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
<hr>

<div class="row">
  <div class="column">
    <div class="left-column">

      <div>
        <form action="index.php" method = "GET">
          <input type="text" name="search" placeholder="Sök efter kommentarer">
          <input type="submit" id="search-button" value="Sök">
        </form>
      </div>

<br>

  <?php
  if(check_login()){
    echo'
    <div id = commenter>

    <h2>Dela med dig av din upplevelse!</h2>
    <p>Nyligen kollat efter flygplan? Dela med dig av dina bästa tips på utsiktsplatser vid flygplatsen, eller vad för plan du såg - och hjälp andra flightspotters.<br><br>Klicka dig vidare till din flygplats på kartan för att lämna en platsspecifik kommentar.</p>
    <br>
      <form action = "comment.php" method = "POST">
        <textarea name = "comment" rows = "5" cols = "50" required></textarea>
        <br>
        <input type = "submit" value = "Skicka">
      </form>

    </div>
    ';
  }
  else{
    echo '<div id = "commenter">
    <h2>Hjälp andra flightspotters!</h2>
    <p>Logga in och dela med dig av din flightspotting-upplevelse.</p>
    </div>';
  }

  ?>
</div>
</div>

<div class="column">
  <div class="right-column">
  <div id = comments>



    <?php
      $sql = "SELECT * FROM comments JOIN users ON comments.UserID = users.UserID ORDER BY commentid DESC";
      $result = query_get0($con, $sql);


      //Comment section
      echo '<h2>Kommentarer</h2>';
      while($row = $result->fetchArray()){
        if(isset($_GET['search'])){
          if(str_contain(strtolower($row['Text']), strtolower($_GET['search'])) || str_contain(strtolower($row['Username']), strtolower($_GET['search'])) || str_contain(strtolower($row['Airfield']), strtolower($_GET['search']))){
            if($row['Airfield'] != null){
              displayCommentwithplace($row);
            }
            else {
              displayComment($row);
            }
              
          }
        }
        if($row['Airfield'] != null){
          displayCommentwithplace($row);
        }
        else {
          displayComment($row);
        }

      }
    ?>
  </div>

</div>
</div>
</div>

</body>
</html>
