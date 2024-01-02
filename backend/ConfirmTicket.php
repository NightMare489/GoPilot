<?php

include 'conn.php';

if($_SERVER["REQUEST_METHOD"] =="POST"){
    session_start();

    $numPersons = isset($_POST["numPersons"]) ? $_POST["numPersons"] : '';
    $numBags = isset($_POST["numBags"]) ? $_POST["numBags"] : '';
    $flightId = isset($_POST["flightId"]) ? $_POST["flightId"] : '';
    $locationFrom = isset($_POST["locationFrom"]) ? $_POST["locationFrom"] : '';
    $locationTo = isset($_POST["locationTo"]) ? $_POST["locationTo"] : '';
    $lat = isset($_POST["lat"]) ? $_POST["lat"] : '';
    $long = isset($_POST["long"]) ? $_POST["long"] : '';
    $price = isset($_POST["price"]) ? $_POST["price"] : '';
    $TicketID = isset($_POST["TicketID"]) ? $_POST["TicketID"] : '';
    $date = isset($_POST["date"]) ? $_POST["date"] : '';
    $time = isset($_POST["time"]) ? $_POST["time"] : '';
    $duration = isset($_POST["duration"]) ? $_POST["duration"] : '';

    

    if(($numPersons==='' || $numBags==='' ||  $flightId==='' || $locationFrom==='' || $locationTo ===''|| $lat==='' || $long===''   
    || $price==='' || $TicketID==='' || $date==='' || $time==='' || $duration==='')){
        header("location:../Booking.php");
    }


    $query="insert into tickets (TicketID ,T_date,T_Time ,T_Persons ,T_bags ,T_ET ,T_Price ,T_from,T_To ,lat  ,lon ,T_userRef ,T_FlightID )
     values (:TicketID ,:T_date,:T_Time ,:T_Persons ,:T_bags ,:T_ET ,:T_Price ,:T_from,:T_To ,:lat  ,:lon ,:T_userRef ,:T_FlightID )";


    $stmt=$pdo->prepare($query);
    $stmt->bindParam(":TicketID",$TicketID);
    $stmt->bindParam(":T_date",$date);
    $stmt->bindParam(":T_Time",$time);
    $stmt->bindParam(":T_Persons",$numPersons);
    $stmt->bindParam(":T_bags",$numBags);
    $stmt->bindParam(":T_ET",$duration);
    $stmt->bindParam(":T_Price",$price);
    $stmt->bindParam(":T_from",$locationFrom);
    $stmt->bindParam(":T_To",$locationTo);
    $stmt->bindParam(":lat",$lat);
    $stmt->bindParam(":lon",$long);
    $stmt->bindParam(":T_userRef",$_SESSION["usernameID"]);
    $stmt->bindParam(":T_FlightID",$flightId);

    $stmt->execute();


    header("Location: ../Dash.php");



}


?>