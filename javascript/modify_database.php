<?php 
include("../_header.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <script src="jquery-1.12.0.min.js"></script>
</head>
<body>
    
<?php
    
if(!isset($_SESSION["uid"])){
    header("Location: http://web.engr.oregonstate.edu/~chriconn/login_registration/login.php");
}

$update = array(
    array('name'        => "Oregon",
          'description' => "The scenic 33rd state",
          'lat'         => 43.793948,      
          'long'        => -120.606365,    
          'range'       => 200000,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/oregon_badge.png"),
    
    array('name'        => "Oregon State University", 
          'description' => "Go School!",
          'lat'         => 44.563036,      
          'long'        => -123.281925,    
          'range'       => 955,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/OSU.png"),
    
    array('name'        => "Kelly Engineering Center",        
          'description' => "",
          'lat'         => 44.567186,
          'long'        => -123.278658,
          'range'       => 58,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/kelly.png"),
    
    array('name'        => "The Memorial Union",
          'description' => "",
          'lat'         => 44.565118,      
          'long'        => -123.278900,    
          'range'       => 70,
          'image'       => ""),
    
    array('name'        => "Reser Stadium",   
          'description' => "",
          'lat'         => 44.559464,      
          'long'        => -123.280878,    
          'range'       => 132,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/reser_stadium.png"),
    
    array('name'        => "Goss Stadium",  
          'description' => "",
          'lat'         => 44.562892,      
          'long'        => -123.277066,    
          'range'       => 100,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/goss_stadium.png"),
    
    array('name'        => "Weatherford Hall", 
          'description' => "",
          'lat'         => 44.564046,      
          'long'        => -123.280613,    
          'range'       => 60,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/weatherford.png"),
    
    array('name'        => "Valley Library",                  
          'description' => "",
          'lat'         => 44.565185,      
          'long'        => -123.275987,    
          'range'       => 55,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/valley_libarary.png"),
    
    array('name'        => "Weniger Hall",                    
          'description' => "",
          'lat'         => 44.567898,      
          'long'        => -123.277389,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Dearborn Hall",      
          'description' => "",
          'lat'         => 44.567204,      
          'long'        => -123.275530,    
          'range'       => 20,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/dearborn.png"),
    
    array('name'        => "Learning Innovation Center",  
          'description' => "",
          'lat'         => 44.565782,      
          'long'        => -123.281725,    
          'range'       => 20,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/linc.png"),
    
    array('name'        => "Corvallis Waterfront", 
          'description' => "",
          'lat'         => 44.564798,      
          'long'        => -123.257869,    
          'range'       => 20,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/water_front.png"),
    
    array('name'        => "Qdoba",         
          'description' => "",
          'lat'         => 44.568183,      
          'long'        => -123.275449,    
          'range'       => 10,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/qdoba.png"),
    
    array('name'        => "Chipotle",      
          'description' => "The scenic 33rd state",
          'lat'         => 44.569051,      
          'long'        => -123.279108,    
          'range'       => 10,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/chipotle.png"),
    
    array('name'        => "Avery Park",  
          'description' => "",
          'lat'         => 44.553933,      
          'long'        => -123.273736,    
          'range'       => 40,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/avery_park.png"),
    
    array('name'        => "Broken Yolk", 
          'description' => "Thats some pretty good breakfast",
          'lat'         => 44.563892,      
          'long'        => -123.260820,    
          'range'       => 25,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/broken_yolk.png"),
    
    array('name'        => "Darkside Theatre",   
          'description' => "Cool kid movie place",
          'lat'         => 44.563280,      
          'long'        => -123.262443,    
          'range'       => 20,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/movie.png"),
    
    array('name'        => "Chip Ross Park",   
          'description' => "Best traveled to at 1:00 AM after a rainstorm",
          'lat'         => 44.608263,      
          'long'        => -123.281640,    
          'range'       => 200,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/chip_ross.png"),
    
    array('name'        => "University of Oregon", 
          'description' => "Rival school of OSU hosing fellow Oregonians and academics",
          'lat'         => 44.043793,      
          'long'        => -123.073169,    
          'range'       => 666,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Eugene/UO.png"),
    
    array('name'        => "Deschutes Brewery",  
          'description' => "Portland craft beer",
          'lat'         => 45.524612,      
          'long'        => -122.681889,    
          'range'       => 20,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Corvallis/brewery.png"),
    
    array('name'        => "Cannon Beach",        
          'description' => "Location of famous Haystack rock",
          'lat'         => 45.887668,      
          'long'        => -123.961955,    
          'range'       => 1000,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/Cannon_Beach/canon_beach.png"),
    
    array('name'        => "Washington Monument",  
          'description' => "First president",
          'lat'         => 38.889469,      
          'long'        => -77.035236,     
          'range'       => 40,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Washington_DC/washington_monument.png"),
    
    array('name'        => "Eiffel Tower",        
          'description' => "Good radio tower",
          'lat'         => 48.858020,      
          'long'        => 2.294813,       
          'range'       => 50,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/France/Ile-de-France/Paris/eiffel_tower.png"),
    
    array('name'        => "Rotterdam",        
          'description' => "Newest city in the Netherlands",
          'lat'         => 51.921600, 
          'long'        => 4.477702,             
          'range'       => 500,
          'image'       => ""),
    
    array('name'        => "Sinclair House",        
          'description' => "8 years and counting",
          'lat'         => 45.366019, //45.366019
          'long'        => -122.608531,        
          'range'       => 22,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/USA/Oregon/West%20Linn/Sinclair%20House.png"),
    
    array('name'        => "Buchanan House",        
          'description' => "Don't let your memes be dreams",
          'lat'         => 44.576033, 
          'long'        => -123.263667,        
          'range'       => 22,
          'image'       => ""),
    
    array('name'        => "Bald Hill",        
          'description' => "Hiking",
          'lat'         => 44.565304,
          'long'        => -123.336340,        
          'range'       => 250,
          'image'       => ""),
    
    array('name'        => "Reykjavík",        
          'description' => "",
          'lat'         => 64.117712,
          'long'        => -21.900057,        
          'range'       => 5000,
          'image'       => ""),
    
    array('name'        => "Blue Lagoon",        
          'description' => "",
          'lat'         => 63.879190,
          'long'        => -22.445711,
          'range'       => 1000,
          'image'       => ""),
    
     array('name'        => "Gullfoss",        
          'description' => "",
          'lat'         => 64.327340,
          'long'        => -20.121599,
          'range'       => 200,
          'image'       => ""),
    
    array('name'        => "Dettifoss",        
          'description' => "",
          'lat'         => 65.814028, 
          'long'        => -16.384920,
          'range'       => 200,
          'image'       => ""),
);

    
$locationNumber = count($update);
$printed = false;


echo "<table>";

echo '<th colspan="6">Elements modified</th>';
echo "<tr>";
echo "<td>Name:</td>";
echo "<td>Latitude is now:</td>";
echo "<td>Longitude is now:</td>";
echo "<td>Range is now:</td>";
echo "<td>Description is now:</td>";
echo "<td>Image is now:</td>";
echo "</tr>";

for ($x = 0; $x < $locationNumber; $x++) {

    $name   = $update[$x]['name'];
    $desc   = $update[$x]['description'];
    $lats   = $update[$x]['lat'];
    $longs  = $update[$x]['long'];
    $ranges = $update[$x]['range'];
    $image  = $update[$x]['image'];

    //if there is an element in the database that has the same name as one of the entries
    $return = mysqli_query($con, "SELECT * FROM Badges WHERE name = '$name'");
    $didReturn = mysqli_num_rows($return);
    if ($didReturn) {
        $dbValues = mysqli_fetch_assoc($return);


        //If any of the following elements differ from what is in the database then update the database with this info
        if (($dbValues['latitude'] != $lats) or ($dbValues['longitude'] != $longs) 
            or ($dbValues['range'] != $ranges) or ($dbValues['description'] != $desc)
           or ($dbValues['image'] != $image)) {
            $query = "UPDATE Badges SET `latitude`='$lats', `longitude`='$longs',`range`='$ranges',`description`= '$desc',`image`='$image' WHERE `name`='$name'";
            if($success = mysqli_query($con, $query)) {
                echo "<tr>";
                echo "<td>".$name."</td>";
                echo "<td>".$lats."</td>";
                echo "<td>".$longs."</td>";
                echo "<td>".$ranges."</td>";
                echo "<td>".$desc."</td>";
                echo "<td>".$image."</td>";
                $printed = true;
                echo "</tr>";
            }
        }
    }
    //otherwise it means the information needs to be added or deleted
    else {
        //this next line works
        $nextNumber = mysqli_query($con, "SELECT MAX(badgeid) AS recentBadge FROM Badges");
        //this one will be better if it works
//        $nextNumber = mysqli_query($con, "SELECT COUNT(*) AS recentBadge FROM Badges");
        $nextNumber = mysqli_fetch_assoc($nextNumber);
        $nextNumber['recentBadge'] += 1;
        $nextNumber = $nextNumber['recentBadge'];
        $currentTime = date('Y-m-d h:m:s');
        $enabled = 1;

        $categories = "(`badgeid` ,`name` ,`description` ,`date_added` ,`enabled` ,`latitude` ,`longitude` ,`range` ,`image`)";
        $values     = "($nextNumber,  '$name',  '$desc',  '$currentTime',  '$enabled',  '$lats',  '$longs',  '$ranges',  '$image')";
        $query = "INSERT INTO Badges $categories VALUES $values";
        if($success = mysqli_query($con, $query)) {
            echo '<th colspan="8">Elements added</th>';
            echo "<tr>";
            echo "<td>BadgeId</td>";
            echo "<td>Name</td>";
            echo "<td>Description</td>";
            echo "<td>Date Added</td>";
            echo "<td>Enabled</td>";
            echo "<td>Latitude</td>";
            echo "<td>Longitude</td>";
            echo "<td>Range</td>";
            echo "<td>Image</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>".$nextNumber."</td>";
            echo "<td>".$name."</td>";
            echo "<td>".$desc."</td>";
            echo "<td>".$currentTime."</td>";
            echo "<td>".$enabled."</td>";
            echo "<td>".$lats."</td>";
            echo "<td>".$longs."</td>";
            echo "<td>".$ranges."</td>";
            echo "<td>".$image."</td>";
            $printed = true;
            echo "</tr>";
        }
    }
}
echo "</table>";
if($printed == false) {
    echo "No database changes were made";
}
?>
</body>
</html>