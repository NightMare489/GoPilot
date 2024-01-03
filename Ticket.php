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
        
        

        
        $origin = null;
        $destination = null;


        $query="SELECT * FROM airports WHERE name=:airportname";
        $stmt=$pdo->prepare($query);

        if($status == "Traveling"){
            
            $stmt->bindParam(":airportname",$airportFrom);
            $stmt->execute();
            $results=$stmt->fetchAll();
            $origin = urlencode($results[0]["lat"].",".$results[0]["lon"]);
            $destination = urlencode($lat.",".$long);
        }else{
            $stmt->bindParam(":airportname",$airportTo);
            $stmt->execute();
            $results=$stmt->fetchAll();
            $origin = urlencode($lat.",".$long);
            $destination = urlencode($results[0]["lat"].",".$results[0]["lon"]);

        }
      
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=AIzaSyDJs1Pk4vKCGlr9RFXgxF7rOJ1ToG3jAew";
        
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        if (!empty($data['rows'][0]['elements'][0])) {
                $distanceVal = $data['rows'][0]['elements'][0]['distance']['value'];
                $distanceTxt = $data['rows'][0]['elements'][0]['distance']['text'];

                $durationVal = $data['rows'][0]['elements'][0]['duration']['value'];
                $durationTxt = $data['rows'][0]['elements'][0]['duration']['text'];
                
                
            }
            
                
        
        // travelling
        if($status == "Traveling"){
        $timestamp = strtotime($flightDepartureDate . " " . $flightDepartureTime . " - 2 hours -$durationVal seconds");
        $timestamp = floor($timestamp / (5 * 60)) * (5 * 60);
        $meetCaptinDateTime = date("Y-m-d H:i", $timestamp);
        }else{

        //returning          
        $meetCaptinDateTime = date("Y-m-d H:i:s", strtotime($flightDepartureDate . " " . $flightDepartureTime ."+ 15 minutes"));
        $flightDurationInSeconds = strtotime($flightDuration) - strtotime('00:00:00');
        $meetCaptinDateTime = date("Y-m-d H:i:s", strtotime($meetCaptinDateTime) + $flightDurationInSeconds );
        $rem = strtotime($meetCaptinDateTime) % 300;
        $meetCaptinDateTime = date("Y-m-d H:i:s", strtotime($meetCaptinDateTime) + (300-$rem) );
        }


        // price

        if($numPersons<=4){
            $price = $distanceVal/1000.0 *3 + $numBags*5 +25;
        }else if($numPersons<=8){
            $price = $distanceVal/1000.0 *3 + $numBags*5 +50;
        }else{
            $price = $distanceVal/1000.0 *2.5 + $numBags*5 +35;
        }

        $price = round($price,0);

        if(($numPersons==='' || $numBags==='' ||  $flightId==='' || $status ===''|| $location===''|| $lat==='' || $long==='')){
            header("location:./Booking.php");
        }


        //location
        if($status == "Returning"){
            $locationFrom = $airportTo." Airport";
            $locationTo = $location;
            
        }else{

            $locationFrom = $location;
            $locationTo = $airportFrom." Airport";
         }

         //ticket
         $letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
         $numbers = substr(str_shuffle("0123456789"), 0, 5);
         $TicketID = $letters . $numbers;
    }else{

        $TicketID = $_GET["TicketID"]??"";
        if($TicketID == ""){
            header("location:./Dash.php");
        }

        $query="SELECT * FROM tickets WHERE TicketID=:id;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":id",$TicketID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result)> 0){
            $numPersons = $result[0]["T_Persons"];
            $numBags = $result[0]["T_bags"];
            $price = $result[0]["T_Price"];
            $Date = $result[0]["T_date"];
            $Time = $result[0]["T_Time"];
            $durationTxt = $result[0]["T_ET"];
            $locationFrom = $result[0]["T_from"];
            $locationTo = $result[0]["T_To"];

            $meetCaptinDateTime = date("Y-m-d H:i:s",strtotime($Date." ".$Time));
        }else{
            header("location:./Dash.php");
        

        

    }
}

    ?>




    <div id="container">
    <!-- level 1 -->
    <div style="background-color: #003F60;" id="level1">
      <img src="icons/logo.png" alt="logo" >


      <div id="Llev1">
            <p style="margin-bottom: 0px;">Your Ticket ID</p>
            <p style="margin-top: 5px ;"><?php


            echo $TicketID;
?></p>

      </div>


    </div>
    <!-- level 2 -->
    <div id="level2">
       
    <p>
        <?php      
    echo $locationFrom;
    ?></p>

     <img src="icons/Car.svg" alt="car" id="Car">

     <p id="Ltext"><?php
     
        echo $locationTo;
     ?></p>

    </div>
    <!-- level 3 -->
    <div id="level3">
    <div class="conlev3" style="width: 50%; height:83%;background-color: #DFF6FF;">
        <p class="label" >Date</p>
        <p class="value" style="margin-bottom: 30px;">
        <?php
            echo Date("d/m/Y",strtotime($meetCaptinDateTime));

        ?></p>

        <p class="label" >Meet Captain at</p>
        <p class="value">
        <?php
            echo Date("h:i A",strtotime($meetCaptinDateTime));
            ?>
        </p>
    </div>

    <div class="conlev3" style="width: 50%; height:83%">
        <p class="label">Number of Persons </p>
        <p class="value" style="margin-bottom: 30px;"><?php echo $numPersons?></p>

        <p class="label">Number of Bags</p>
        <p class="value"><?php echo $numBags?></p>
    </div>
    
     <div class="conlev3" style="background-color: #DFF6FF; width:50%;height:83%">
     <p class="label">Expected Time</p>
        <p class="value" style="margin-bottom: 30px;"><?php echo $durationTxt ?></p>

        <p class="label">Price</p>
        <p class="value"><?php echo $price ?> L.E</p>
     </div>
    </div>
    <!-- level 4 -->
    <div id="level4">
        <div <?php 
            if($_SERVER["REQUEST_METHOD"] =="GET"){
                echo "style='display:none'";
            }
        
        ?> onclick="handleConfirmTicket()">
             Confirm
        </div>
    </div>


    </div>
    

     <script>

        function handleConfirmTicket() {
            let numPersons = "<?php echo $numPersons ?>";
            let numBags = "<?php echo $numBags ?>";
            let flightId = "<?php echo $flightId ?>";
            let locationFrom = "<?php echo $locationFrom ?>";
            let locationTo = "<?php echo $locationTo ?>";
            let lat = "<?php echo $lat ?>";
            let long = "<?php echo $long ?>";
            let price = "<?php echo $price ?>";
            let ticketId = "<?php echo $TicketID ?>";
            let date = "<?php echo Date("Y-m-d",strtotime($meetCaptinDateTime)); ?>";
            let time = "<?php echo Date("h:i:s",strtotime($meetCaptinDateTime)); ?>";
            let duration = "<?php echo $durationTxt ?>";

            let form = document.createElement('form');
            form.action = 'backend/ConfirmTicket.php';
            form.method = 'POST';
            form.style.display = 'none';

            let data = {
                'numPersons': numPersons,
                'numBags': numBags,
                'flightId': flightId,
                'locationFrom': locationFrom,
                'locationTo': locationTo,
                'lat': lat,
                'long': long,
                'price': price,
                'TicketID': ticketId,
                'date': date,
                'time': time,
                'duration': duration
            };

            for (let name in data) {
                let input = document.createElement('input');
                input.name = name;
                input.value = data[name];
                form.appendChild(input);
            }

            document.body.appendChild(form);

            form.submit();


        }

     </script>

</body>
</html>