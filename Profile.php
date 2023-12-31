<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Profile.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="goicons/favicon.png" type="image/x-icon">


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


            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_error = $_FILES['file']['error'];

        if ($file_error === 0) {
            $upload_dir = "uploads/"; 
            $target_file = $upload_dir . $file_name;

            if (move_uploaded_file($file_tmp, $target_file)) {

                $query="UPDATE users SET url=:url WHERE id=:id;";
                $stmt=$pdo->prepare($query);
                $stmt->bindParam(":url",$target_file);
                $stmt->bindParam(":id",$_SESSION["usernameID"]);
                $stmt->execute();
                

                $_SESSION["err"] = 0;
                $_SESSION["errmsg"] = "File uploaded successfully!";
            } else {
                $_SESSION["err"] = true;
                $_SESSION["errmsg"] = "Error uploading file.";
            }
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
            
        <form  action="./Profile.php" method="POST" enctype="multipart/form-data" onsubmit="return checkpass()">
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
                    <p class="value">
                    <?php echo $results[0]["name"] ?>
                    </p>    
                </div>
                <div class="data">
                    <p class="label">
                    <strong> E-Mail:</strong>
                    </p>
                    <p class="value">
                    <?php echo $results[0]["email"] ?>
                    </p>    
                </div>
                <div class="data">
                    <p class="label">
                    <strong> Phone Number:</strong>
                    </p>
                    <div id ="phone">

                            <p class="value">
                                <?php echo $results[0]["phonenumber"] ?>
                            </p>    
                            
                            <span id="Ephone" style="border-radius:60px; background-color:#0080C3;width:30px;margin-left:10px;margin-right:10px;cursor: pointer;" onclick="changePhone()">
                                <img src="./goicons/edit.svg" alt="edit" style="margin-left:3px">
                            </span>
                        
                        <div  id="Efeild" style="visibility: hidden;">
                            <input type="text" name="phone" placeholder="Enter The New Number">
                        </div>
                    </div>
                    </div>
                    <div id="passworddiv">
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
                <input id="file" name="file" type="file" onchange="loadFile(event)"/>
                <img src="<?php echo $results[0]["url"]?>" id="output" width="200" />
                </div>
                
        </div>
        <input id="save" type="submit" value="Save" style="visibility: hidden;">
    </div>
    </form>
    <div id="errorBox" >
         <center> <p id="errorMsg"></p><center>
    </div>

    <script>
        let errorMsg = "<?php echo  $_SESSION["errmsg"]?>";
        let error = <?php 
        
            if(isset($_SESSION["err"])&& $_SESSION["err"]){
                echo  $_SESSION["err"];
            }else{
                echo 0;
            }
        ?>;
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