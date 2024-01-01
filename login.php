<!DOCTYPE html>
<html lang="en">
  <head>
    <title>login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>" />
    <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon" />

  <?php
  include 'backend/conn.php';
  ?>

<?php
session_start();

if (isset($_SESSION["username"]) && $_SESSION["username"]!=""){
  header("location:./Booking.php");
}

// Sign up
if($_SERVER["REQUEST_METHOD"] =="POST"){



    if(!empty( $_POST["number2"] )){
    
    $username=$_POST["username"];
    $pwd=$_POST["password"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    try {
        $query="INSERT INTO users (name,password,email,phonenumber) VALUES (:username,:pwd,:email,:phone);";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":pwd",$pwd);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":phone",$phone);
        $stmt->execute();
        
        $_SESSION['success'] = True;
    } catch (PDOException $e) {
      $_SESSION['success'] = False;
      $_SESSION['error'] = $e->getMessage();

    }
  }else{



    $phone=$_POST["phone"];
    $pwd=$_POST["password"];
    
    try {
      $query="SELECT * FROM users WHERE phonenumber=:phone AND password=:pwd;";
      $stmt=$pdo->prepare($query);
      $stmt->bindParam(":phone",$phone);
      $stmt->bindParam(":pwd",$pwd);
      $stmt->execute();

      if($stmt->rowCount() > 0){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['success'] = True;
        $_SESSION['username'] = $user['name'];

        
        header("location:./Booking.php");
        die();
      } else {
        $_SESSION['success'] = False;
        $_SESSION['error'] = "Invalid phone number or password";
      }
    } catch (PDOException $e) {
      $_SESSION['success'] = False;
      $_SESSION['error'] = $e->getMessage();
    }
  
}
}


?>

  </head>
  <script type="text/javascript" src="js.js" defer></script>
  <body>
    <a href="index.php">

      <img src = "icons/LogoBlue.png" id="LOGOIMG" class="LogoImg"/>
    </a>

    <div class="mainBG"></div>

    <div class="planeBox"></div>


    <div id="LogForm" class="card" >
      <span id="log">Login</span>
      <span class="togglebox"
        ><label class="switch">
          <input type="checkbox" name="checkbox" id="chkbox" onclick="toggleSingup()" />
          <span class="slider"></span> </label
      ></span>

      <span id="sign" style="margin-left: 20%">Signup</span><br /><br />
      <div id="blurgroup">
        <div id="loginform">
          <form action='./login.php' method="POST">
            <div class="form-group">
              <input
                type="text"
                name="phone"
                class="form-control"
                placeholder="Enter phone number"
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Password"
              />
            </div>
            <br /><br />
            <a href="Home.php">
              <button type="submit" class="btn" id="Loginbtn">Login</button>
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

          <form action="./login.php" method="POST" onsubmit="return validateSignup()">
          <input type="hidden" name="number2" value="number2">
            <div class="form-group">
              <input
              type="text"
                class="form-control"
                name="username"
                placeholder="Enter Your name"
              />
            </div>
            <div class="form-group">
              <input
              type="email"
              name="email"
                class="form-control"
                placeholder="Enter email"
              />
            </div>
            <div class="form-group">
              <input
              type="text"
              name="phone"
                class="form-control"
                placeholder="Enter phone number"
              />
            </div>
            
            <div class="form-group">
              <input
                type="password"
                name="password"
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

            <button type="submit" class="btn" id="signupbtn">Signup</button>

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
    <div id="errorBox" >
         <center> <p id="errorMsg"></p><center>
    </div>


        <script type="text/javascript">
          
          let success =  <?php echo json_encode($_SESSION['success']); ?>;
          let error =  <?php echo json_encode($_SESSION['error']); ?>;


          if (success) {
            document.getElementById('errorBox').style.animation = 'slideInFromRight 1s forwards';
            document.getElementById('errorMsg').innerText = "Account Created Successfully";
            document.getElementById('errorBox').style.display = 'block';
            document.getElementById('errorBox').style.backgroundColor = '#00c30f';
            
            setTimeout(function () {
                  document.getElementById('errorBox').style.animation = 'slideOutToRight 1s forwards';

                }, 3000);

                setTimeout(function () {
                  
                  <?php
                   $_SESSION['success'] = False; 
                    $_SESSION['error'] = "";
                  ?>
                  document.getElementById('errorBox').style.backgroundColor = '#cc0000';
                  
                }, 4000);

          }else{

            if(error){
                
              document.getElementById('errorBox').style.animation = 'slideInFromRight 1s forwards';
              document.getElementById('errorMsg').innerText = error;
              document.getElementById('errorBox').style.display = 'block';
              setTimeout(function () {
                  document.getElementById('errorBox').style.animation = 'slideOutToRight 1s forwards';
                }, 3000);

                setTimeout(function () {
                  
                  <?php
                   $_SESSION['success'] = False; 
                    $_SESSION['error'] = "";
                  ?>

                  
                }, 4000);
            
            }
          }

            function validateSignup(){

              var username=document.forms[1][1].value;
              var email=document.forms[1][2].value;
              var phone=document.forms[1][3].value;
              var password=document.forms[1][4].value;
              var confirmpassword=document.forms[1][5].value;

              console.log(username);

              var errorMsg = "";
              if(username=="" || email=="" || phone=="" || password=="" || confirmpassword==""){
                errorMsg = "Please fill all the fields";
              }
              else if(password!=confirmpassword){
                errorMsg = "Passwords do not match";
              }

              if (errorMsg != "") {
                document.getElementById('errorBox').style.animation = 'slideInFromRight 1s forwards';
                document.getElementById('errorMsg').innerText = errorMsg;
                document.getElementById('errorBox').style.display = 'block';

                setTimeout(function () {
                  document.getElementById('errorBox').style.animation = 'slideOutToRight 1s forwards';
                }, 3000);

                return false;
              }
              return true;
            }
          

        </script>


  </body>
</html>
