<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="./Dash.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="goicons/favicon.png" type="image/x-icon">

</head>
<body>
    <?php
        include("./nav.php");
        include("./backend/conn.php");

    ?>

    <div class="mn">
        <p id="Header">
            Your Dashboard
        </p>

        <?php

            if($_SERVER["REQUEST_METHOD"] !=="GET"){
                header("location:./Dash.php");
                
            }
                $usernameID = $_SESSION["usernameID"];
                $query="SELECT * FROM tickets WHERE  T_userRef =:U_id;";
            


                $stmt=$pdo->prepare($query);
                $stmt->bindParam(":U_id",$usernameID);
                $stmt->execute();
                $results = $stmt->fetchAll();

                foreach($results as $row) :


        ?>
        <div class="ticket" value="<?php echo $row["TicketID"]?>" onclick="handleClick(this)" >

            <div id="level1">
                <p class="label" style="margin-top:20px;">Date</p>
                <p class="value" style="color:#DFF6FF; font-size:25px;margin-top:2px"><?php echo date("d/m/Y", strtotime($row["T_date"])); ?></p>
            </div>

            <div id="level2">
            <img src="goicons/logo.png" alt="logo">
            </div>

            <div id="level3">
                <p class="label" >Ticket ID</p>
                <p class="value" style="color:white;margin-bottom:5px"><?php echo $row["TicketID"] ?></p>
            </div>
        </div>
        <?php
    
        endforeach;
        ?>
    </div>

    <script>
        function handleClick(element){
            let ticketID = element.getAttribute("value");
            window.location.href = "./Ticket.php?TicketID="+ticketID;
        }
    </script>


</body>
</html>