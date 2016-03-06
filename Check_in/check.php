<?php
session_start();
ini_set('display_errors', 'On'); 
$con = mysqli_connect('oniddb.cws.oregonstate.edu','buffumw-db','PizSfykTJBUp3NbW','buffumw-db') or die("Can't connect to database.");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="check.css">
    <script type="text/javascript" src="../javascript/check.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    <title>check</title>
</head>

<body>

    <p>Click the button to get your coordinates.</p>

    <button onclick="getLocation()">Validate my Location</button>

    <p id="demo"></p>

    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        }
    </script>
    <a href="../Badges/badge.php">Back To Badges Page</a>
</body>

</html>