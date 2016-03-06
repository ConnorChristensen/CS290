<?php
include(../_header.php);
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
		printf("script is started");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success);
				navigator.geolocation.getCurrentPosition(ShowPosition);
				
				printf("func getLocation was called");
				
				function success(pos){
					var crd = pos.coords;
					
					var userlati = crd.latitude;
					var userlong = crd.longitude;
					
					var lat1 = userlati;
					var long1 = userlong;
					
					
					printf("func success was called");
					
					var R = 6371000; // metres
					var φ1 = lat1.toRadians();
					var φ2 = lat2.toRadians();
					var Δφ = (lat2-lat1).toRadians();
					var Δλ = (lon2-lon1).toRadians();

					var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
							Math.cos(φ1) * Math.cos(φ2) *
							Math.sin(Δλ/2) * Math.sin(Δλ/2);
					var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

					var d = R * c;
					
					<?php
						$con = mysqli_connect('oniddb.cws.oregonstate.edu','buffumw-db','PizSfykTJBUp3NbW','buffumw-db') or die("Can't connect to database.");
						while ($row = mysqli_fetch_array($result)) {
							
							# Get badge information associated with each badge ID from Badges table	
							// $bid = $row['badgeid'];
							// $sql2 = "select * from Badges where badgeid = '$bid'";
							// $r = 0;
							$badgerange = "select range from Badges";
							$badgelati = "select latitude from Badges";
							$badgelongi = "select longitude from Badges";
							
							// $badgerange = $row['range'];
							// $badgelati = $row['latitude'];
							// $badgelongi = $row['longitude'];
							
							
							// distance formula (likely wont work with degrees):
							 // $distance = sqrt(((x-a)^2) + ((y-b)^2))
							$distance = sqrt( (((userlati - latitude)^2) + ((userlong - latitude)^2)) );
							
							// use this one:
							// calculate distance between two 3D points in degrees such as GPS, using the Great Circle Distance formula:
							// delta(sigma) = arcos( sin(userlati)*sin(badgelati) + cos(userlong)*cos(badgelong) * cos(delta(gamma)) )
							$thingy = acos( (sin(userlati)*sin(badgelati) + cos(userlong)*cos(badgelong) * cos(	)) );
							
							
							if ((userlati == $badgelongi) && (userlong == $badgelati) || (distance <= badgerange)){
								$mysqli->query("update Badges set enabled = '1'");
							}
						}
					?>
				}
				
				 // navigator.geolocation.getCurrentPosition(success);
				 
				
		
				array_push($badges, $temp);
				
				
				
				navigator.geolocation.getCurrentPosition(success, error);
            }else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
		}
        

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        }
    </script>

</body>

</html>

<?php

$sql = "SELECT * FROM Badges";
$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

# loops through mysql result
while ($row = mysqli_fetch_array($result)) {
	
	
}
?>