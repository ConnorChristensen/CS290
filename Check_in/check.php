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
        <script type="text/javascript" src="../javascript/jquery-1.12.0.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
        
        <script type="text/javascript" src="../javascript/check.js"></script>
        
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
                
                if($query = mysqli_query($con, "SELECT * FROM Badges")) {
                    $badgesNumber = mysqli_num_rows($query);
                }
                else {
                    echo "It returned nothing";
                }
                
                $time = date("Y-m-d H-i-s", time());
                for ($i = 0; $i < $badgesNumber; $i++) {
                    $info = mysqli_query($con, "SELECT  * FROM  `Badges` WHERE  `badgeid`=$i");
                    $info = mysqli_fetch_assoc($info);

                    $latRange = $info["range"] / 111132; 
                    $longRange = $info["range"] / ((cos(abs($info["latitude"])) * 111)*1000);
                    
                    $lowerLat = $info["latitude"]-$latRange;
                    $upperLat = $info["latitude"]+$latRange;

                    $lowerLong = $info["longitude"]-$longRange;
                    $upperLong = $info["longitude"]+$longRange;
                    
                    if ($latitude >= $lowerLat and $latitude <= $upperLat and $longitude >= $lowerLong and $longitude <= $lowerLat) {
                        $findID = mysqli_query($con, "SELECT  `badgeid`, `name`, `image` FROM Badges WHERE `badgeid` =$i");
                
                        $rows = mysqli_fetch_row($findID);
                        if ($rows[0]) {
                            $result = mysqli_query($con, "SELECT unlocked FROM User_Badges WHERE uid=$uid and badgeid='$rows[0]'");
                            $unlocked = mysqli_fetch_row($result);

                            if (!$unlocked[0]) {
                                echo "<p class='big'>You unlocked ".$rows[1]."!</p>";
//                                mysqli_query($con, "UPDATE User_Badges SET unlocked=1, obtained='$time' WHERE badgeid=$rows[0] AND uid=$uid");
                                mysqli_query($con, "INSERT INTO User_Badges(badgeid, uid, obtained, unlocked) VALUES ('$rows[0]', '$uid', '$time', '1')");
                                echo "<img src=$rows[2]>";
                                break;
                            }
                            else {
                                echo "<p class='big'>You already unlocked ".$rows[1]."</p>";
                            }
                        }
                        else {
                            echo "<p class='big'>You are not in a location that has a badge!</p>";
                            break;
                        }
                    }
                }
            }
        ?>
    </body>

    </html>
