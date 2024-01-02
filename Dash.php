<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Dash.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php
        include("./nav.php");
        include("./backend/conn.php");

    ?>

    <div class="mn">
        <p style="font-size:50px; color:#003F60">
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
                <p style="color:white;font-size:28px;margin-top:20px;margin-bottom:5px">Date</p>
                <p style="color:#DFF6FF; font-size:25px;margin-top:2px"><?php echo date("d/m/Y", strtotime($row["T_date"])); ?></p>
            </div>

            <div id="level2">
            <img src="icons/logo.png" alt="logo" style="width: 213px ; height: 100px ; margin-left: 20px ">
            </div>

            <div id="level3">
                <p style="color:white;font-size:28px;margin-top:5px;margin-bottom:5px">Your Ticket ID</p>
                <p style="color:white;font-size:25px;margin-top:5px;margin-bottom:5px"><?php echo $row["TicketID"] ?></p>
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