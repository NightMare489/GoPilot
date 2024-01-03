<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Booking</title>
    <link rel="stylesheet" href="./Booking.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="icons/favicon.png" type="image/x-icon">
  <script type="text/javascript" src="Booking.js" defer></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJs1Pk4vKCGlr9RFXgxF7rOJ1ToG3jAew&callback=initMap" async defer></script>

  </head>
<body>
  <?php
  include "nav.php";

  ?>
  
  <div class="mn">

      <div class="main">  

  <form action="./Date.php" onsubmit="return validateBooking()">

        <div class="maindiv">
          <div class="radio-inputs">
            <label>
              <input checked="" class="radio-input" type="radio" name="status" value="Traveling" onchange="handleLocation()">
              <span class="radio-tile">
                <span class="radio-label">Traveling</span>
                <span class="radio-icon">
                  <img src="./icons/airplane-takeoff.svg" alt="" width="40px" height="40px">
                </span>
              </span>
            </label>
            <label>
              <input  class="radio-input" type="radio" value="Returning" name="status"  onchange="handleLocation()">
              <span class="radio-tile">
                <span class="radio-icon">
                  <img src="./icons/airplane-arrival.svg" alt="" width="40px" height="40px">
                </span>
                <span class="radio-label">Returning</span>
              </span>
            </label>



          </div>
          
          <select name="airport" class="select">
            <option value="0" selected disabled hidden aria-placeholder="Choose Your City">Choose The Airport</option>
            <option value="Cairo">Cairo</option>
            <option value="Aswan">Aswan</option>
            <option value="Sohag">Sohag</option>
            <option value="Hurghada">Hurghada</option>
            <option value="Sharm El Sheikh">Sharm El Sheikh</option>
          </select>
          


        </div>
        <div class="maindiv2">
  <input type="text" name="location" class="Location" readonly placeholder="Enter Your Location">
  <input type="text" name="lat" readonly hidden >
  <input type="text" name="long" readonly hidden >


  <span onclick="openMap()" href="" id="mapIcon" style=" margin-left: -200px;">
    <img src="icons/map.png" >
</span>


  <style>
		.leaflet-container {
			height: 75%;
			width: 75%;
			max-width: 100%;
			max-height: 100%;
      transition: 0s;
		}
    .leaflet-pane{
      transition: 0s;
    }
	</style>
<div id="Background" onclick="closeMap()"> </div>
<div id="map"></div>


  <script>
    function handleLocation(){

    let selectedValue = document.querySelector('input[name="status"]:checked').value;
    if(selectedValue=="Traveling"){
      document.querySelector(".Location").placeholder="Enter Your Location";
    }else{
      document.querySelector(".Location").placeholder="Enter Your Destination";
    }
  }

  let marker = null;
  let map =null;
  function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.089105, lng: 32.901920},
                zoom: 8,
                disableDefaultUI: true
            });

                // Add click event listener to the map
                google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng, map);
            });

            function placeMarker(location, map) {
                // Create a marker at the clicked location
                if(marker != null){
                  marker.setMap(null);
                }
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });


                 // Reverse geocoding
      fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${location.lat()}&lon=${location.lng()}`)
      .then(response => response.json())
      .then(data => {

        var country = data.address.country || '';
        var city = data.address.city || '';
        var state = data.address.state || '';
        var road = data.address.road || '';
        document.querySelector(".Location").value=country + " " + city + " "+state +" " + road;
        document.querySelector('input[name="lat"]').value=location.lat();
        document.querySelector('input[name="long"]').value=location.lng();

        console.log(data); 
      })
      .catch(error => console.error(error));
            }
        }
  function openMap(){
    document.getElementById("Background").style.display="inline";
    
    document.getElementById("map").style.display="inline";

    }
    
    function closeMap(){
      document.getElementById("map").style.display="none";
      document.getElementById("Background").style.display="none";
    }
    
    function validateBooking(){
      let selectedValue = document.querySelector('input[name="status"]:checked').value;
      let airport = document.querySelector('select[name="airport"]').value;
      
      let errmsg = '';

      if(selectedValue=="Traveling"){
        if(document.querySelector(".Location").value==""){
          errmsg="Please Enter Your Location";

        }
      }else{
        if(document.querySelector(".Location").value==""){
          errmsg="Please Enter Your Destination";

        }
      }

      if(airport == 0){
        errmsg="Please select an airport";

      }

      console.log(errmsg);

      if(errmsg){
          document.getElementById('errorBox').style.animation = 'slideInFromRight 1s forwards';
          document.getElementById('errorMsg').innerText = errmsg;
          document.getElementById('errorBox').style.display = 'block';

          setTimeout(function () {
            document.getElementById('errorBox').style.animation = 'slideOutToRight 1s forwards';
          }, 3000);

          return false;

      }
      return true;
    }
    function onMapClick(e) {
      if(marker != null){
        map.removeLayer(marker);
      }
      marker =  L.marker(e.latlng);
      marker.addTo(map);
      
     
    }
  </script>
</div>
<div class="maindiv2">
  <button type="submit" class="chooseBtn">
    Choose Your Trip
  </button>
</div>
</form>
</div>


<div id="Rdiv">
  <center>
  <p style="font-size:35px;font-weight:bold;color:black;">How to Use</p>    
  </center>
  <p class="bla">
<strong>Traviling:</strong> choose the 
airport that you will 
travel from and <em>in location</em> 
put your location that you will 
meet captain at
  </p>
  <p class="bla"><strong>Returning:</strong> chose the airport that 
your plane willl land in , <em>in location</em>
put your distination that you need
the captain to take you to</p>
</div>


</div>


<div id="errorBox" >
         <center> <p id="errorMsg"></p><center>
    </div>
</body>
</html>