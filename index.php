<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOPilot</title>
    <link rel="stylesheet" href="home.css">
</head>

<script>

Number.prototype.pad = function(n) {
  for (var r = this.toString(); r.length < n; r = 0 + r);
  return r;
};

function updateClock() {
  
  var now = new Date();
  var 
    sec = now.getSeconds(),
    min = now.getMinutes(),
    hou = now.getHours(),
    mo = now.getMonth(),
    dy = now.getDate(),
    yr = now.getFullYear();
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var tags = ["mon", "d", "y", "h", "m", "s"],
    corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2)];
  for (var i = 0; i < tags.length; i++)
    document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
}

function initClock() {
  updateClock();
  window.setInterval("updateClock()", 1000);
}

  </script>

    <body onload="initClock()">
        <div id="menu" class="card">
         <div id="logo">
           <img src="icons/navlogo.png" alt="logo" id="logoimg" />
         </div>
         <div id="rightblock">
           <div >
               <a href="#aboutUs" class="menuItem" id="haha">About Us </a>
             </div>
           <div>
             <a href="" class="menuItem">Help</a>
           </div>
         </div>
         </div>

    <div class="maindiv" >

        <div id="Back" >
      
          <div style="margin-top: 12.5%; margin-left: 8%;">

            <div>
                <img src="icons/Logo.png" alt="logo" id="logodisc" />
            </div>
    
    
            <h1 style="color:#0080C3"> 
              Seamless Airport Transfers Await!
            </h1>
    
            <p>
    Elevate your travel experience with effortless airport bookings.<br>
    Reliable,  convenient, and tailored  for  stress-free journeys <br>
    to and from airports.
            </p>
    
            <a href="login.php">
            <button id="bookButton">
              Book Your Trip
            </button>
          </a>
    
            </div>



        </div>  


    </div>   
    <div id="aboutUs" class="aboutUs">
      <div style="padding-left: 10%; padding-top: 10%;">
      <h1>About Us</h1>
      <h3 class="aboutush3">  Go Pilot, a dedicated team passionate about transforming your travel experience.
        We specialize in providing seamless airport transfers, delivering a perfect blend of convenience,
         reliability, and personalized service. At Go Pilot, our mission is to simplify your journey, ensuring
          each passenger enjoys a stress-free and comfortable trip to and from the airport. With a commitment 
          to excellence, we redefine travel with a focus on reliability, efficiency, and a personalized touch.
           Choose Go Pilot for a travel companion that goes beyond the ordinary, creating memorable and hassle-free 
           journeys for every passenger.
          
           
          </h3>
          <span id="aboutusimg1"><img src="./icons/AboutUs.png" height="300px" width="300px" style="float: right; " ></span>

          </div>



      </div>
      <div style="display: flex; flex-flow: row-reverse; justify-content: center; align-items: center;">
     


        <div id="timedate" style="float:right; margin-left: 20%;" >
          <a id="mon">January</a>
          <a id="d">1</a>,
          <a id="y">0</a><br />
          <a id="h">12</a> :
          <a id="m">00</a>:
          <a id="s">00</a>
        </div>

        <div style="color:white;float: right; width: 500px;">
          <h5 >Made with ❤️ by</h1>
          <h3 class="aboutush3">
          
            <ul>
              <li>Omar Farouk</li>
              <li>Amr Ashraf</li>
              <li>Yaser Shaban</li>
              
  
  
  
            </ul>
  
          </h3>
        </div>

      </div>





</body>
</html>