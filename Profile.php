<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Profile.css?v=<?php echo time(); ?>">

    <script src="./Profile.js" defer></script>
    <title>Profile</title>
</head>
<body>
    <?php 
    include 'nav.php';
    include 'backend/conn.php';

    ?>
    

        <?php 
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
                    echo "<script>alert('Old password is wrong')</script>";
                }else if($newpass != $confirmpass){
                    echo "<script>alert('New password and confirm password are not the same')</script>";
                }else{
                    $query="UPDATE users SET password=:password WHERE id=:id;";
                    $stmt=$pdo->prepare($query);
                    $stmt->bindParam(":password",$newpass);
                    $stmt->bindParam(":id",$_SESSION["usernameID"]);
                    $stmt->execute();
                    echo "<script>alert('Password changed successfully')</script>";
                }

            }

            $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';

            if(!($phone == "")){
                $query="UPDATE users SET phonenumber=:phonenumber WHERE id=:id;";
                $stmt=$pdo->prepare($query);
                $stmt->bindParam(":phonenumber",$phone);
                $stmt->bindParam(":id",$_SESSION["usernameID"]);
                $stmt->execute();
                echo "<script>alert('Phone number changed successfully')</script>";

            }



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
                    <p>
                        USER NAME:
                    </p>
                    <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amr Asd
                    </p>    
                </div>
                <div class="data">
                    <p>
                        E-Mail:
                    </p>
                    <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; amrashraf72002@gmail.com
                    </p>    
                </div>
                <div class="data">
                    <p>
                        Phone Number:
                    </p>
                    <div id ="phone" style="display:flex; flex-direction:row; align-items:center;">
                        <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;01122099044
                        </p>    
                        <span id="Ephone" style="border-radius:60px; background-color:#0080C3;width:30px;margin-left:10px;margin-right:10px;cursor: pointer;" onclick="changePhone()">
                            <img src="./icons/edit.svg" alt="edit" style="margin-left:3px">
                        </span>
                        <div  id="Efeild" style="visibility: hidden;">
                            <input type="text" placeholder="Enter The New Number">
                        </div>
                    </div>
                    </div>
                    <div id ="phone" style="display:flex; flex-direction:row; align-items:center;gap:20px">
                <div id="reset" style="border-radius:45px;background-color:#0080C3;width:200px;height:40px;display:flex;justify-content:center;align-items:center; cursor:pointer;" onclick="changePassword()">
                    <p style="color:white;">
                        Reset Password
                    </p>
                </div>
                <div class="Epass"style="visibility: hidden;">
                     <input type="text" placeholder="Enter The Current Password">
                </div>
                <div class="Epass"style="visibility: hidden;">
                    <input type="text" placeholder="Enter The New Password">
                </div>
                <div class="Epass"style="visibility: hidden;">
                    <input type="text" placeholder="Confirm The New Number">
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
        <div id="save">
            <p>
                SAVE
            </p>
        </div>
    </div>
    </form>

</body>
</html>