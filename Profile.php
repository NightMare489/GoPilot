<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Profile.css?v=<?php echo time(); ?>">
    <title>Profile</title>
</head>
<body>
    <?php 
    include 'nav.php';
    include 'backend/conn.php';

    ?>
    <div id="main">

        <div id="container">

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
            <h1>Profile</h1>
            <p>Username: <?php echo $results[0]['name'] ?></p>
            <p>Email: <?php echo $results[0]['email'] ?></p>
            <div style="display: flex; flex-direction: row; gap:15px"> 
               <p>Phone: <?php echo $results[0]['phonenumber']?>  </p>
               
               <div id="edit"><img src="icons/edit.svg" alt="edit" style="padding-top: 7px;"></div>
               
            </div>
            
            <input type="text" name="phone" id="phone" placeholder="Enter your new phone number">

            <input type="password" name="oldpass" id="oldpass" placeholder="Enter your old password">
            <input type="password" name="newpass" id="newpass" placeholder="Enter your new password">
            <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm your new password">
            
            <button id="Reset" type="submit">Save</button>
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
    </form>
</body>
</html>