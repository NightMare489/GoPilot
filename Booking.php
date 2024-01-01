<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Booking</title>
    <link rel="stylesheet" href="./Booking.css">
    <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon">
  <script type="text/javascript" src="Booking.js" defer></script>

</head>
<body>
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

          <img src="icons/navlogo.png" alt="logo" id="logoimg" />
        </a>
      </div>
      <div class="rightblock">
        <div class="menuItemDiv">
            <a href="" class="menuItem" id="haha">Dashboard </a>
          </div>
        <div class="menuItemDiv" >
          <a href="" class="menuItem"><?php echo $username ?></a>
        </div>
        <div class="menuItem menuItemDiv" id="coma">
          |
        </div>
        <div class="menuItemDiv">
          <a href="./backend/logout.php" class="menuItem">Log Out</a>
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
            <a  class="SideBarItemsDiv"  href=""><?php echo $username ?></a>
            <a href='./backend/logout.php' class="SideBarItemsDiv" href="">Log Out</a>


        </div>
      </div>

      <div class="main">  
        <div class="maindiv">
          <div class="radio-inputs">
            <label>
              <input class="radio-input" type="radio" name="engine">
              <span class="radio-tile">
                <span class="radio-label">Travling</span>
                <span class="radio-icon">
                  <img src="./icons/airplane-takeoff.svg" alt="" width="40px" height="40px">
                </span>
              </span>
            </label>
            <label>
              <input checked="" class="radio-input" type="radio" name="engine">
              <span class="radio-tile">
                <span class="radio-icon">
                  <img src="./icons/airplane-arrival.svg" alt="" width="40px" height="40px">
                </span>
                <span class="radio-label">Returning</span>
              </span>
            </label>



          </div>
          
          <select class="select">
            <option value="0" selected disabled hidden aria-placeholder="Choose Your City">Choose The Airport</option>
            <option value="1">Cairo</option>
            <option value="2">Aswan</option>
            <option value="3">Sohag</option>
            <option value="4">Hurghada</option>
            <option value="5">Sharm El Sheikh</option>
          </select>
          
        </div>
        <div class="maindiv2">
  <input type="text" class="Location" placeholder="Enter Your Location">
  <a href="" id="map" style=" margin-left: -200px;">
    <img src="icons/map.png" >
  </a>


</div>

<div class="maindiv2">
  <button class="chooseBtn">
    Choose Your Trip
  </button>
</div>



</div>






</body>
</html>