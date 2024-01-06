<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Date</title>
    <link rel="stylesheet" href="./Date.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="goicons/favicon.png" type="image/x-icon">
  <!-- <script type="text/javascript" src="Date.js" defer></script> -->

</head>
<body>
<!-- app bar -->
<?php
include "nav.php";
include 'backend/conn.php';

if($_SERVER["REQUEST_METHOD"] =="GET"){
    
  $status = $_GET["status"];
  $airport = $_GET["airport"];
  $lat = $_GET["lat"];
  $long = $_GET["long"];
  $location = $_GET["location"];
  $date = $_GET["date"]??"";

  if($date == ""){
    $date = date("Y-m-d");
  }

  if(!($status && $airport && $lat && $long)){
    header("location:./Booking.php");
  }

$clouseStatus = "f_from";

  if($status == "Returning"){
      $clouseStatus = "f_to"; 
  }
}


?>
<!-- end of app bar -->

<div class="mnn">
<!-- calender -->
      <div class="calendar-box">
        <p class="calendar-title" style="font-size:x-large; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Date of The Trip</p>
        <input type="text" id="dateInput" readonly placeholder="Select a date" value= <?php
              $formattedDate = new DateTime($date);
              echo $formattedDate->format('d/m/Y');;

        
        ?> >
        <div class="calendar" id="calendar">
          <div class="header">
            <button id="prevBtn">&lt;</button>
            <h2 id="monthYear">Month Year</h2>
            <button id="nextBtn">&gt;</button>
          </div>
          <div class="days" id="daysContainer"></div>
        </div>
      </div>
<!-- end of calender -->

 <!--Number of persons and bags  -->
<div class="chooser">
  <p style="font-size:large; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Number of Persons</p>
  <button class="bbtn" onclick="minus(0)">
    -
  </button>
  <input type="Number" onblur="checkNegativePerson(this)" class="NumOfPersons" value="1" style="text-align: center;">
  <button class="bbtn" onclick="plus(0)">
    +
  </button>
</div>
<div class="chooser" >
  <p style="font-size:large; font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-left:18px;">Number of Bags</p>
  <button class="bbtn" onclick="minus(1)">
    -
  </button>
  <input type="Number" onblur="checkNegativeBags(this)" class="NumOfPersons" value="0" style="text-align: center; ">
  <button class="bbtn" onclick="plus(1)">
    +
  </button>
</div>
 <!-- end of Number of  -->
 </div>


<?php
    $query="SELECT * FROM flights WHERE $clouseStatus = '$airport' AND f_date='$date';";

    $stmt=$pdo->prepare($query);
    $stmt->execute();
    
    $results=$stmt->fetchAll();
    

    foreach($results as $row) :

?>

<!-- flight card -->
<div onclick="handleBooking(<?php echo $row['id']; ?>)"  class="flightCard">
  <!-- Ldiv -->
    <div>
      <p>
        Flight Number: <?php echo $row['flightnumber']; ?><br>
      </p>
    </div>
<!--  -->
<!-- Mdiv -->
    <div>
        <p>
          Time: <?php echo $row['f_time'] ?><br>
        </p>
    </div>
<!--  -->
<!-- Rdiv -->
    <div style="display: flex; flex-direction:column;">
        <div class="dis">
          <p>
            From:
          </p>
          <p>
          <?php echo $row['f_from'] ?>
          </p>
        </div>

        <div class="dis">
          <p>
            To:
          </p>
          <p>
          <?php echo $row['f_to'] ?>
          </p>
        </div>

    </div>
<!--  -->

</div>

<?php
endforeach;
  
?>
<!-- end of flight card -->

<?php include "DateJS.php" ?>





</body>
</html>