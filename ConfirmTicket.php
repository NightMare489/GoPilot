<?php

include 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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


    $mail = new PHPMailer(true);

    try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '123az.az.Az.yaser@gmail.com'; 
    $mail->Password   = 'bdbugkejdmitvncb'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('123az.az.Az.yaser@gmail.com', 'GoPilot');
    $mail->addAddress($_SESSION['userEmail']);


    // Content
    $mail->isHTML(true);
    $mail->Subject = "GoPilot";
    $mail->Body = "
    <p style='font-family: Arial, sans-serif; font-size: 16px;'>Dear ". $_SESSION["username"].",</p>

    <p style='font-family: Arial, sans-serif; font-size: 16px;'>We're thrilled to confirm your reservation with GoPilot! </p>
    
    <p style='font-family: Arial, sans-serif; font-size: 16px;'>Here are the details of your upcoming ride:</p>
    
    <table style='border: 1px solid #ccc; border-collapse: collapse; width: 100%;'>
    <tr style='border: 1px solid #ccc; padding: 10px;'>
    <th style='text-align: left; padding: 5px;'>Ticket ID</th>
    <td style='padding: 5px;'>$TicketID</td>
    </tr>
    <tr style='border: 1px solid #ccc; padding: 10px;'>
    <th style='text-align: left; padding: 5px;'>Meet Captain at</th>
    <td style='padding: 5px;'>$date at $time</td>
    </tr>
    <tr style='border: 1px solid #ccc; padding: 10px;'>
    <th style='text-align: left; padding: 5px;'>Number of Persons</th>
    <td style='padding: 5px;'>$numPersons</td>
    </tr>
    <tr style='border: 1px solid #ccc; padding: 10px;'>
    <th style='text-align: left; padding: 5px;'>Number of Bags</th>
    <td style='padding: 5px;'>$numBags</td>
    </tr>
    <tr style='border: 1px solid #ccc; padding: 10px;'>
    <th style='text-align: left; padding: 5px;'>Expected Time to Airport</th>
    <td style='padding: 5px;'>$duration</td>
    </tr>
    <tr style='border: 1px solid #ccc; padding: 10px;'>
    <th style='text-align: left; padding: 5px;'>Total Price</th>
    <td style='padding: 5px;'>$price L.E</td>
    </tr>
    </table>
    
    <p style='font-family: Arial, sans-serif; font-size: 16px;'>You may view your reservation <a href='http://localhost/GoPilot/Ticket.php?TicketID=".$TicketID."'>here</a></p>
    
    <p style='font-family: Arial, sans-serif; font-size: 16px;'>Please arrive at the designated meeting point with your Captain on time. Your Captain will be happy to assist you with any luggage or questions you may have.</p>
    
    <p style='font-family: Arial, sans-serif; font-size: 16px;'>We're committed to providing you with a seamless and unforgettable travel experience. If you have any questions or concerns, please don't hesitate to reach out to us.</p>
    
    <p style='font-family: Arial, sans-serif; font-size: 16px;'>Thank you for choosing GoPilot! We look forward to welcoming you on board soon.</p>
    
    <p style='font-family: Arial, sans-serif; font-size: 16px;'>Sincerely,<br>
    The GoPilot Team</p>
    
    ";

    $mail->send();


    } catch (Exception $e) {

    }

    header("Location: Dash.php");

}


?>