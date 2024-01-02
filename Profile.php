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
    ?>
    <div id="main">

        <div id="container">
            
            <h1>Profile</h1>
            <p>Username: Omar Farouk</p>
            <p>Email: ofarouk837@gmail.com</p>
            <div style="display: flex; flex-direction: row; gap:15px"> 
               <p>Phone: 01017399693</p>
               <div id="edit"><img src="icons/edit.svg" alt="edit" style="padding-top: 7px;"></div>

            </div>
         
            
            <button id="Reset" onclick="checkpass()">Reset password</button>
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
</body>
</html>