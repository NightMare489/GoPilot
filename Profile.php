<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Profile.css?v=<?php echo time(); ?>">

    <script src="./Profile.js?v=<?php echo time(); ?>" defer></script>
    <title>Profile</title>
</head>
<body>
    <?php 
    include 'nav.php';
    include 'backend/conn.php';

    ?>
    

        <?php 
        try{
            if($_SERVER["REQUEST_METHOD"] =="POST"){
                $oldpass = isset($_POST["oldpass"]) ? $_POST["oldpass"] : '';
                $newpass = isset($_POST["newpass"]) ? $_POST["newpass"] : '';
                $confirmpass = isset($_POST["confirmpass"]) ? $_POST["confirmpass"] : '';

            if(!($newpass == "" || $confirmpass == "" || $oldpass == "")){


                $query="SELECT * FROM users WHERE id=:id;";
                $stmt=$pdo->prepare($query);
                $stmt->bindParam(":id",$_SESSION["usernameID"]);
                $stmt->execute();
                $results=$stmt->fetchAll();

                if($results[0]["password"] != $oldpass){
                    $_SESSION["err"] = true;
                    $_SESSION["errmsg"] = "Old password is wrong";
                }else if($newpass != $confirmpass){
                    $_SESSION["err"] = true;
                    $_SESSION["errmsg"] = "New password and confirm password are not the same";
                }else{
                    $query="UPDATE users SET password=:password WHERE id=:id;";
                    $stmt=$pdo->prepare($query);
                    $stmt->bindParam(":password",$newpass);
                    $stmt->bindParam(":id",$_SESSION["usernameID"]);
                    $stmt->execute();
                    $_SESSION["err"] = 0;
                    $_SESSION["errmsg"] = "Password changed successfully";
                }

            }

            $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';

            if(!($phone == "")){
                $query="UPDATE users SET phonenumber=:phonenumber WHERE id=:id;";
                $stmt=$pdo->prepare($query);
                $stmt->bindParam(":phonenumber",$phone);
                $stmt->bindParam(":id",$_SESSION["usernameID"]);
                $stmt->execute();
                $_SESSION["err"] = 0;
                $_SESSION["errmsg"] = "Phone number changed successfully";

            }



            }
        }catch(PDOException $e){
            $_SESSION["err"] = true;
            $_SESSION["errmsg"] = $e->getMessage();
        }
                $usernameID = $_SESSION["usernameID"];
                $query="SELECT * FROM users WHERE id=:id;";
                $stmt=$pdo->prepare($query);
                $stmt->bindParam(":id",$usernameID);
                $stmt->execute();
                $results=$stmt->fetchAll();
            



        ?>
            
        <form  action="./Profile.php" method="POST" onsubmit="return checkpass()">
        <div id="mn" >
        <p id="pro">
            Profile
        </p>
        <div id="main">
            <div id="ldiv">
                <div class="data">
                    <p class="label">
                    <strong>  USER NAME:</strong>
                    </p>
                    <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $results[0]["name"] ?>
                    </p>    
                </div>
                <div class="data">
                    <p class="label">
                    <strong> E-Mail:</strong>
                    </p>
                    <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $results[0]["email"] ?>
                    </p>    
                </div>
                <div class="data">
                    <p class="label">
                    <strong> Phone Number:</strong>
                    </p>
                    <div id ="phone" style="display:flex; flex-direction:row; align-items:center;">
                        <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $results[0]["phonenumber"] ?>
                        </p>    
                        
                             <span id="Ephone" style="border-radius:60px; background-color:#0080C3;width:30px;margin-left:10px;margin-right:10px;cursor: pointer;" onclick="changePhone()">
                            <img src="./icons/edit.svg" alt="edit" style="margin-left:3px">
                        </span>
                        <div  id="Efeild" style="visibility: hidden;">
                            <input type="text" name="phone" placeholder="Enter The New Number">
                        </div>
                    </div>
                    </div>
                    <div id ="phone" style="display:flex; flex-direction:row; align-items:center;gap:20px">
                <div id="reset" onclick="changePassword()">
                    <p id="reser" style="color:white;">
                        Reset Password
                    </p>
                </div>
                <div class="Epass"style="visibility: hidden;">
                     <input type="password" name="oldpass" placeholder="Enter The Current Password">
                </div>
                <div class="Epass"style="visibility: hidden;">
                    <input id="password" type="password" name="newpass" placeholder="Enter The New Password">
                </div>
                <div class="Epass"style="visibility: hidden;">
                    <input id="cpassword" type="password" name="confirmpass" placeholder="Confirm The New Password">
                </div>
            </div>
            </div>

            <div class="profile-pic" id="rightdiv">
                <label class="-label" for="file" style="border-radius: 50%;">
                    <span class="glyphicon glyphicon-camera"></span>
                    <span>Change Image</span>
                </label>
                <input id="file" type="file" onchange="loadFile(event)"/>
                <img src="icons/AboutUs.png" id="output" width="200" />
                </div>
                
        </div>
        <input id="save" type="submit" value="Save">
    </div>
    </form>
    <div id="errorBox" >
         <center> <p id="errorMsg"></p><center>
    </div>

    <script>
        let errorMsg = "<?php echo  $_SESSION["errmsg"]?>";
        let error = <?php echo  $_SESSION["err"]?>;
        console.log("err"+errorMsg);

        if(!error){
            document.getElementById('errorBox').style.backgroundColor = '#00c30f';
        }

        if (errorMsg != "") {
            document.getElementById('errorBox').style.animation = 'slideInFromRight 1s forwards';
            document.getElementById('errorMsg').innerText = errorMsg;
            document.getElementById('errorBox').style.display = 'block';

            setTimeout(function () {
                document.getElementById('errorBox').style.animation = 'slideOutToRight 1s forwards';

            }, 3000);




            <?php $_SESSION["errmsg"] ="";
            $_SESSION["err"] = false; ?>
        }


    </script>



</body>
</html>