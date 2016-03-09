<?php
include("../_header.php");
if(!isset($_SESSION["uid"])){
    echo "<script type=\"text/javascript\">document.location.href=\"http://web.engr.oregonstate.edu/~chriconn/login_registration/login.php\";</script>";
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Validate</title>
        <link rel="stylesheet" href="check.css">
        <script type="text/javascript" src="../javascript/check.js"></script>
        <script type="text/javascript" src="../javascript/jquery-1.12.0.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <a href="../Badges/badge.php" id="home">
            <div class="box">BACK</div>
        </a>
        <div class="box" id="center" onclick="getLocation()">
            <p>Validate my Location</p>
        </div>
        <div id="demo"></div>
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
                var lat = position.coords.latitude;
                var long = position.coords.longitude;
                x.innerHTML = "Latitude: " + lat + "<br>Longitude: " + long;
                post("http://web.engr.oregonstate.edu/~chriconn/Check_in/check.php", {
                    Lats: lat,
                    Longs: long
                })
            }

            // Post to the provided URL with the specified parameters.
            function post(path, parameters) {
                var form = $('<form></form>');

                form.attr("method", "post");
                form.attr("action", path);

                $.each(parameters, function (key, value) {
                    var field = $('<input></input>');

                    field.attr("type", "hidden");
                    field.attr("name", key);
                    field.attr("value", value);

                    form.append(field);
                });

                // The form needs to be a part of the document in
                // order for us to be able to submit it.
                $(document.body).append(form);
                form.submit();
            }
        </script>

        <?php
        
            //meters per degree of lattitude at 45 degrees: 111131.745
            //.0001deg ~=~ 11.11m
            if($_POST) {
                $uid = $_SESSION['uid'];
                
                $latitude = $_POST["Lats"];
                $longitude = $_POST["Longs"];

                echo "<p>Latitude: $latitude<br>Longitude: $longitude</p>";
                
                $lowerLat = $latitude-.0005;
                $upperLat = $latitude+.0005;

                $lowerLong = $longitude-.0005;
                $upperLong = $longitude+.0005;
                
                $time = date("Y-m-d H-i-s", time());
                
                $findID = mysqli_query($con,"SELECT badgeid, name, image FROM Badges WHERE (longitude BETWEEN '$lowerLong' AND '$upperLong') AND (latitude BETWEEN '$lowerLat' AND '$upperLat')");
                $rows = mysqli_fetch_row($findID);
                if ($rows[0]) {
                    $unlocked = mysqli_query($con, "SELECT unlocked FROM User_Badges WHERE uid=$uid");
                    if ($unlocked) {
                        echo "<p class='big'>You unlocked ".$rows[1]."!</p>";
                        mysqli_query($con, "UPDATE User_Badges SET unlocked=1, obtained='$time' WHERE badgeid=$rows[0] AND uid=$uid");
                        echo "<img src=$rows[2]>";
                    }
                    else {
                        echo "<p class='big'>You already unlocked ".$rows[1]."</p>";
                    }
                }
                else {
                    echo "<p class='big'>You are not in a location that has a badge!</p>";
                }
            }
       ?>
    </body>

    </html>