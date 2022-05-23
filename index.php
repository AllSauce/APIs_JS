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

<div class="header">
       <nav>
           <ul id="main-menu">
              <li><img src="img/utegym-logo.png" id="logo"></li>
              <li><a href="login.php">LOGGA IN</a></li>
              <li><a href="register.php">SKAPA KONTO</a></li>
           </ul>
       </nav>
</div>

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


</body>
</html>
