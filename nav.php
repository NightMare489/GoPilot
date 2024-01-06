<!-- app bar -->
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Date</title>
    <link rel="stylesheet" href="./nav.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="goicons/favicon.png" type="image/x-icon">
  <script type="text/javascript" src="nav.js" defer></script>

  <?php
  session_start();
  if (isset($_SESSION["username"]) && $_SESSION["username"]!=""){
      $username=$_SESSION["username"];
  }else{
    header("location:./login.php");
  }
  ?>
<div id="menu" class="card">
      <div id="logo">
        <a href="index.php">
          <img src="goicons/navlogo.png" alt="logo" id="logoimg" />
        </a>
      </div>
      <div class="rightblock">
        <div class="menuItemDiv">
            <a href="./Dash.php" class="menuItem" id="haha">Dashboard </a>
          </div>
        <div class="menuItemDiv" >
          <a href="Profile.php" class="menuItem"><?php echo $username ?></a>
        </div>
        <div class="menuItem menuItemDiv" id="coma">|
        </div>
        <div class="menuItemDiv">
          <a href='./backend/logout.php' class="menuItem">Log Out</a>
        </div>
        <div class="hambruger">
          <span id="hambruger" class="Hambrger" onclick="hambruger()">☰</span>
        </div>
      </div>
      </div>

      <div id="sideBar" class="sideBar notactive">
        <div class="SideBarItems">
          <a  class="SideBarItemsDiv" href="./Dash.php" >
            Dashboard 
        </a>
            <a  class="SideBarItemsDiv"  href="./Profile.php"><?php echo $username ?></a>
            <a href='./backend/logout.php' class="SideBarItemsDiv">Log Out</a>
        </div>
      </div>

<!-- end of app bar -->