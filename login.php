<!DOCTYPE html>
<html lang="en">
  <head>
    <title>login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <link rel="stylesheet" href="login.css" />
    <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon" />
  </head>
  <script type="text/javascript" src="js.js" defer></script>
  <body>
    <a href="index.php">

      <img src = "icons/LogoBlue.png" id="LOGOIMG" class="LogoImg"/>
    </a>
    <div class="mainBG"></div>
    <div class="planeBox"></div>


    <!-- <div id="menu" class="card">
      <div id="logo">
        <img src="icons/logo.png" alt="logo" id="logoimg" />
      </div>
      <div >
        <a href="about.html" id="aboutlink">About Us</a>
      </div>
      <div id="rightblock">
        <div >
          <a href="about.html" id="LoginNav">Login </a>
        </div>
        <div id="Coma">
          |
        </div>
        <div>
          <a href="about.html" id="SignUpNav"> Sign Up</a>
        </div>
      </div>
      
    </div> -->


    <div id="LogForm" class="card">
      <span id="log">Login</span>
      <span class="togglebox"
        ><label class="switch">
          <input type="checkbox" id="chkbox" onclick="toggleSingup()" />
          <span class="slider"></span> </label
      ></span>

      <span id="sign" style="margin-left: 20%">Signup</span><br /><br />
      <div id="blurgroup">
        <div id="loginform">
          <form>
            <div class="form-group">
              <input
                type="email"
                class="form-control"
                placeholder="Enter phone number"
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
              />
            </div>
            <br /><br />
            <a href="Home.php">
              <button type="button" class="btn" id="Loginbtn">Login</button>
            </a>
          </form>
          <a href="login.php">
            <center>
              <span id="forget"><u>forget password?</u></span>
            </center>
          </a>

          <div class="websites">

            <div class="loginwebsite">
              <div class="loginWebsiteContent">
              <img src="./icons/google.png" alt="Google Logo">
            </div>
            </div>


            <div class="loginwebsite" style="background-color: #0080c3;">
              <div class="loginWebsiteContent" style="top:-10%;left:-10%">
              <img src="./icons/facebook.png" alt="Facebook Logo">
            </div>
            </div>


            <div class="loginwebsite" style="background-color: black;">
              <div class="loginWebsiteContent" style="top:20%;left:20%">
              <img src="./icons/X.png" alt="X Logo">
            </div>
            </div>

          </div>
        </div>

        <div id="signupform" hidden>

          <form>
            <div class="form-group">
              <input
              type="text"
                class="form-control"
                placeholder="Enter Your name"
              />
            </div>
            <div class="form-group">
              <input
              type="email"
                class="form-control"
                placeholder="Enter email"
              />
            </div>
            <div class="form-group">
              <input
              type="text"
                class="form-control"
                placeholder="Enter phone number"
              />
            </div>
            
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
              />
            </div>

            <div class="form-group">
              <input
                type="password"
                class="form-control"
                placeholder="Confirm Password"
              />
            </div>

            <button type="button" class="btn" id="signupbtn">Signup</button>

            <div class="websites">

              <div class="loginwebsite">
                <div class="loginWebsiteContent">
                <img src="./icons/google.png" alt="Google Logo">
              </div>
              </div>
  
  
              <div class="loginwebsite" style="background-color: #0080c3;">
                <div class="loginWebsiteContent" style="top:-10%;left:-10%">
                <img src="./icons/facebook.png" alt="Facebook Logo">
              </div>
              </div>
  
  
              <div class="loginwebsite" style="background-color: black;">
                <div class="loginWebsiteContent" style="top:20%;left:20%">
                <img src="./icons/X.png" alt="X Logo">
              </div>
              </div>
  
            </div>


          </form>

          
        </div>
      </div>
    </div>
  </body>
</html>