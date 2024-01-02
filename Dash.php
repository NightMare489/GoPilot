<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Dash.css?v=php echo time(); ?>">
</head>
<body>
    <?php
        include("./nav.php");
    ?>

    <div class="mn">
        <p style="font-size:50px; color:#003F60">
            Your Dashboard
        </p>
        <div class="ticket">

            <div id="level1">
                <p style="color:white;font-size:28px;margin-top:20px;margin-bottom:5px">Date</p>
                <p style="color:#DFF6FF; font-size:25px;margin-top:2px">17/32/122</p>
            </div>

            <div id="level2">
            <img src="icons/logo.png" alt="logo" style="width: 213px ; height: 100px ; margin-left: 20px ">
            </div>

            <div id="level3">
                <p style="color:white;font-size:28px;margin-top:5px;margin-bottom:5px">Your Ticket ID</p>
                <p style="color:white;font-size:25px;margin-top:5px;margin-bottom:5px">211008545</p>
            </div>
        </div>
    </div>
</body>
</html>