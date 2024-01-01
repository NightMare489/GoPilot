<!-- app bar -->
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Date</title>
    <link rel="stylesheet" href="./nav.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon">
  <script type="text/javascript" src="nav.js" defer></script>

<div id="menu" class="card">
      <div id="logo">
        <a href="index.php">
          <img src="icons/navlogo.png" alt="logo" id="logoimg" />
        </a>
      </div>
      <div class="rightblock">
        <div class="menuItemDiv">
            <a href="" class="menuItem" id="haha">Dashboard </a>
          </div>
        <div class="menuItemDiv" >
          <a href="" class="menuItem">Amr Asd</a>
        </div>
        <div class="menuItem menuItemDiv" id="coma">|
        </div>
        <div class="menuItemDiv">
          <a href="" class="menuItem">Log Out</a>
        </div>
        <div class="hambruger">
          <span id="hambruger" class="Hambrger" onclick="hambruger()">☰</span>
        </div>
      </div>
      </div>

      <div id="sideBar" class="sideBar notactive">
        <div class="SideBarItems">
          <a  class="SideBarItemsDiv" href="" >
            Dashboard 
        </a>
            <a  class="SideBarItemsDiv"  href="">Amr Asd</a>
            <a  class="SideBarItemsDiv" href="">Log Out</a>
        </div>
      </div>

<!-- end of app bar -->