<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Date</title>
    <link rel="stylesheet" href="./Date.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon">
  <script type="text/javascript" src="Date.js" defer></script>

</head>
<body>
<!-- app bar -->
<?php
include"nav.php";
?>
<!-- end of app bar -->

<div class="mnn">
<!-- calender -->
      <div class="calendar-box">
        <p class="calendar-title" style="font-size:x-large; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Date of The Trip</p>
        <input type="text" id="dateInput" placeholder="Select a date" >
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
<div class="chooser" style="margin-top:110px; margin-left:250px">
  <p style="font-size:large; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Number of Persons</p>
  <button class="bbtn" onclick="minus(0)">
    -
  </button>
  <input type="Number" class="NumOfPersons" value="1" style="text-align: center;">
  <button class="bbtn" onclick="plus(0)">
    +
  </button>
</div>
<div class="chooser" style="margin-top:110px; margin-left:250px">
  <p style="font-size:large; font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-left:18px;">Number of Bags</p>
  <button class="bbtn" onclick="minus(1)">
    -
  </button>
  <input type="Number" class="NumOfPersons" value="1" style="text-align: center; ">
  <button class="bbtn" onclick="plus(1)">
    +
  </button>
</div>
 <!-- end of Number of  -->


 </div>



<!-- flight card -->
<div  class="flightCard" style="margin-top:120px;margin-left:100px; display:flex; flex-direction: row; align-items: center; gap: 120px;">
  <!-- Ldiv -->
    <div>
      <p>
        Flight Number:<br>
      </p>
    </div>
<!--  -->
<!-- Mdiv -->
    <div>
        <p>
          Date:<br>
        </p>
    </div>
<!--  -->
<!-- Rdiv -->
    <div style="display: flex; flex-direction:column;">
        <div style="display: flex; flex-direction:row; gap:30px;">
          <p>
            From:
          </p>
          <p>
            Bla Bla Bla
          </p>
        </div>

        <div style="display: flex; flex-direction:row;gap:30px;">
          <p>
            To:
          </p>
          <p>
            Bla Bla Bla
          </p>
        </div>

    </div>
<!--  -->

</div>
<!-- end of flight card -->








</body>
</html>