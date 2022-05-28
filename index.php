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

  <title>Hitta ditt utegym</title>
</head>

<body>

  <?php
  if(!check_login()){
    echo'
    <div class="header">
    <nav>
        <ul id="main-menu">
          <li><a href="index.php"><img src="img/utegym-logo.png" id="logo"></a></li>
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
          <li><a href="index.php"><img src="img/utegym-logo.png" id="logo"></a></li>
          <li><a href="index.php">HEM</a></li>
          <li><a href="logout.php">LOGGA UT</a></li>
        </ul>
    </nav>';
  }

  ?>
  <div class="row">
    <div class="column">
      <div class="left-column">
        <h1><b>Hitta ditt utegym i Uppsala</b></h1>
        <p>Uppsala kommun tillhandahåller +20 utegym runtom Uppsala med omnej. Alla är välkomna att träna utan kostnad!</p>
          <br>
          <br>
        <br>
        <br>
        <br><p class="small-body">Platsdatan för utegym tillhandahålls av <a href="https://opendata.uppsala.se/" target=”_blank”>Uppsala kommun (CC-BY)</a>.</p>
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
    <p>Hjälp andra att hitta rätt utegym! Dela med dig av din upplevelse.</p>
    <br>
      <form action = "comment.php" method = "POST">
        <textarea name = "comment" rows = "5" cols = "50" required></textarea>
        <br>
        <input type = "submit" value = "Comment">
      </form>

    </div>
    ';
  }
  else{
    echo '<div id = "commenter">
    <h2>Hur var din upplevelse?</h2>
    <p>Hjälp andra att hitta rätt utegym! Logga in och dela med dig av din upplevelse.</p>
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
              displayCommentwithplace($row);
          }
        }
        else{
          displayCommentwithplace($row);
        }

      }
    ?>
  </div>

</div>
</div>
</div>

</body>
</html>
