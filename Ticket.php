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
    include 'backend/conn.php';

    if($_SERVER["REQUEST_METHOD"] =="POST"){

        $numPersons = isset($_POST["numPersons"]) ? $_POST["numPersons"] : '';
        $numBags = isset($_POST["numBags"]) ? $_POST["numBags"] : '';
        $flightId = isset($_POST["flightId"]) ? $_POST["flightId"] : '';
        $status = isset($_POST["status"]) ? $_POST["status"] : '';
        $location = isset($_POST["location"]) ? $_POST["location"] : '';
        $lat = isset($_POST["lat"]) ? $_POST["lat"] : '';
        $long = isset($_POST["long"]) ? $_POST["long"] : '';


        $query="SELECT * FROM flights WHERE id=:id;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":id",$flightId);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            header("location:./Booking.php");
            die();
        }

        $results=$stmt->fetchAll();

        $airportFrom = $results[0]["f_from"];
        $airportTo = $results[0]["f_to"];

        $flightDepartureDate = $results[0]["f_date"];
        $flightDepartureTime = $results[0]["f_time"];
        $flightDuration = $results[0]["f_timeTaken"];


        
        $origin = urlencode("40.6655101,-73.89188969999998");
        $destination = urlencode("40.6905615,-73.9976592");

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=AIzaSyDJs1Pk4vKCGlr9RFXgxF7rOJ1ToG3jAew";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!empty($data['rows'][0]['elements'][0]['distance'])) {
            $distance = $data['rows'][0]['elements'][0]['distance']['text'];
            echo "The driving distance is: $distance";
        } else {
            echo "Error: Something went wrong";
        }
        


        $meetCaptinDate = date("Y-m-d",strtotime($flightDepartureDate));
        $meetCaptinTime = date("H:i:s",strtotime($flightDepartureTime."- 2 hours"));

        echo $meetCaptinDate. " ".$meetCaptinTime;


        if(($numPersons==='' || $numBags==='' ||  $flightId==='' || $status ===''|| $location===''|| $lat==='' || $long==='')){
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
            <p style="margin-top: 5px ;"><?php
            $letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
            $numbers = substr(str_shuffle("0123456789"), 0, 5);
            $TicketID = $letters . $numbers;

            echo $TicketID;
?></p>

      </div>


    </div>
    <!-- level 2 -->
    <div id="level2">
       
    <p><?php      
    if($status == "Returning"){
        echo $airportTo." Airport";
        
    }else{
        echo $location;
     } ?></p>

     <img src="icons/Car.svg" alt="car" id="Car">

     <p id="Ltext"><?php
     
     if($status == "Returning"){
         echo $location;
         
    }else{
        echo $airportFrom." Airport";
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