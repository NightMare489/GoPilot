<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Ticket.css?v=<?php echo time(); ?>">

    <title>Ticket</title>
</head>
<body>
    <?php 
    include 'nav.php';

    if($_SERVER["REQUEST_METHOD"] =="POST"){

        $numPersons = isset($_POST["numPersons"]) ? $_POST["numPersons"] : '';
        $numBags = isset($_POST["numBags"]) ? $_POST["numBags"] : '';
        $date = isset($_POST["date"]) ?  $_POST["date"] : '';
        $flightId = isset($_POST["flightId"]) ? $_POST["flightId"] : '';
        $status = isset($_POST["status"]) ? $_POST["status"] : '';
        $airport = isset($_POST["airport"]) ? $_POST["airport"] : '';
        $location = isset($_POST["location"]) ? $_POST["location"] : '';
        $lat = isset($_POST["lat"]) ? $_POST["lat"] : '';
        $long = isset($_POST["long"]) ? $_POST["long"] : '';



        if(($numPersons==='' || $numBags==='' || $date==='' || $flightId==='' || $status ===''|| $airport ===''|| $location===''|| $lat==='' || $long==='')){
            header("location:./Booking.php");
        }
    }

    ?>




    <div id="container">
    <!-- level 1 -->
    <div style="background-color: #003F60;" id="level1">
      <img src="icons/logo.png" alt="logo" style="width: 213px ; height: 100px ; margin-left: 20px ">


      <div id="Llev1">
            <p style="margin-bottom: 0px;">Your Ticket ID</p>
            <p style="margin-top: 5px ;">123456789</p>

      </div>


    </div>
    <!-- level 2 -->
    <div id="level2">
       
    <p><?php      
    if($status == "Returning"){
        echo $airport." Airport";
        
    }else{
        echo $location;
     } ?></p>

     <img src="icons/Car.svg" alt="car" id="Car">

     <p id="Ltext"><?php
     
     if($status == "Returning"){
         echo $location;
         
    }else{
        echo $airport." Airport";
     }
     ?></p>

    </div>
    <!-- level 3 -->
    <div id="level3">
    <div class="conlev3" style="width: 50%; height:83%">
        <p class="label" style="margin-top: 20px;">Date</p>
        <p class="value" style="margin-bottom: 30px;">7/2/2024</p>

        <p class="label" style="margin-top: 30px;">Meet Captain at</p>
        <p class="value">7:00 AM</p>
    </div>
    
     <div class="conlev3" style="background-color: #DFF6FF; width:50%;height:83%">
     <p class="label" style="margin-top: 20px;">Expected Time</p>
        <p class="value" style="margin-bottom: 30px;">2 hrs</p>

        <p class="label" style="margin-top: 30px;">Price</p>
        <p class="value">85 L.E (+ 15 taxes)</p>
     </div>
    </div>
    <!-- level 4 -->
    <div id="level4">
        <div>
             Confirm
        </div>
    </div>


    </div>
    
</body>
</html>