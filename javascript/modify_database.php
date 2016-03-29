<?php 
include("../_header.php");
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="stylesheet.css">
<?php
    
//if(!isset($_SESSION["uid"])){
//    header("Location: http://web.engr.oregonstate.edu/~chriconn/login_registration/login.php");
//}

$update = array(
    array('name'        => "Oregon",
          'description' => "The scenic 33rd state",
          'lat'         => 44.132080,      
          'long'        => -120.541674,    
          'range'       => 370653,
          'image'       => ""),
    
    array('name'        => "Oregon State University", 
          'description' => "The scenic 33rd state",
          'lat'         => 44.563036,      
          'long'        => -123.281925,    
          'range'       => 955,
          'image'       => ""),
    
    array('name'        => "Kelly Engineering Center",        
          'description' => "The scenic 33rd state",
          'lat'         => 44.567193,      
          'long'        => -123.278480,    
          'range'       => 58,
          'image'       => ""),
    
    array('name'        => "The Memorial Union",
          'description' => "The scenic 33rd state",
          'lat'         => 44.565118,      
          'long'        => -123.278900,    
          'range'       => 70,
          'image'       => ""),
    
    array('name'        => "Reser Stadium",   
          'description' => "The scenic 33rd state",
          'lat'         => 44.559464,      
          'long'        => -123.280878,    
          'range'       => 132,
          'image'       => ""),
    
    array('name'        => "Goss Stadium",  
          'description' => "The scenic 33rd state",
          'lat'         => 44.562892,      
          'long'        => -123.277066,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Weatherford Hall", 
          'description' => "The scenic 33rd state",
          'lat'         => 44.564046,      
          'long'        => -123.280613,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Valley Library",                  
          'description' => "The scenic 33rd state",
          'lat'         => 44.565185,      
          'long'        => -123.275987,    
          'range'       => 55,
          'image'       => ""),
    
    array('name'        => "Weniger Hall",                    
          'description' => "The scenic 33rd state",
          'lat'         => 44.567898,      
          'long'        => -123.277389,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Dearborn Hall",      
          'description' => "The scenic 33rd state",
          'lat'         => 44.567204,      
          'long'        => -123.275530,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Learning Innovation Center",  
          'description' => "The scenic 33rd state",    
          'lat'         => 44.565782,      
          'long'        => -123.281725,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Corvallis Waterfront", 
          'description' => "The scenic 33rd state",
          'lat'         => 44.564798,      
          'long'        => -123.257869,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Qdoba",         
          'description' => "The scenic 33rd state",
          'lat'         => 44.568183,      
          'long'        => -123.275449,    
          'range'       => 25,
          'image'       => ""),
    
    array('name'        => "Chipotle",      
          'description' => "The scenic 33rd state",
          'lat'         => 44.569051,      
          'long'        => -123.279108,    
          'range'       => 25,
          'image'       => ""),
    
    array('name'        => "Avery Park",  
          'description' => "The scenic 33rd state",
          'lat'         => 44.553933,      
          'long'        => -123.273736,    
          'range'       => 40,
          'image'       => ""),
    
    array('name'        => "Broken Yolk", 
          'description' => "The scenic 33rd state",
          'lat'         => 44.563892,      
          'long'        => -123.260820,    
          'range'       => 25,
          'image'       => ""),
    
    array('name'        => "Darkside Theatre",   
          'description' => "Cool kid movie place",
          'lat'         => 44.563280,      
          'long'        => -123.262443,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Chip Ross Park",   
          'description' => "Best traveled to at 1:00 AM after a rainstorm",
          'lat'         => 44.608263,      
          'long'        => -123.281640,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "University of Oregon", 
          'description' => "The scenic 33rd state",
          'lat'         => 44.043793,      
          'long'        => -123.073169,    
          'range'       => 666,
          'image'       => ""),
    
    array('name'        => "Deschutes Brewery",  
          'description' => "The scenic 33rd state",
          'lat'         => 45.524612,      
          'long'        => -122.681889,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Cannon Beach",        
          'description' => "The scenic 33rd state",
          'lat'         => 45.887668,      
          'long'        => -123.961955,    
          'range'       => 20,
          'image'       => ""),
    
    array('name'        => "Washington Monument",  
          'description' => "First president",
          'lat'         => 38.889469,      
          'long'        => -77.035236,     
          'range'       => 100,
          'image'       => ""),
    
    array('name'        => "Eiffel Tower",        
          'description' => "Good radio tower",
          'lat'         => 48.858020,      
          'long'        => 2.294813,       
          'range'       => 200,
          'image'       => "http://web.engr.oregonstate.edu/~chriconn/Images/Badges/France/Ile-de-France/Paris/eiffel_tower.png"),
    
    array('name'        => "Rotterdam",        
          'description' => "Newest city in the Netherlands",
          'lat'         => 51.921600, 
          'long'        => 4.477702,             
          'range'       => 500,
          'image'       => ""),
    
    array('name'        => "Sinclair House",        
          'description' => "8 years and counting",
          'lat'         => 45.366019, 
          'long'        => -122.608531,        
          'range'       => 22,
          'image'       => ""),
);

$locationNumber = count($update);
$printed = false;

echo "<table>";
for ($x = 0; $x < $locationNumber; $x++) {
    
    $name   = $update[$x]['name'];
    $desc   = $update[$x]['description'];
    $lats   = $update[$x]['lat'];
    $longs  = $update[$x]['long'];
    $ranges = $update[$x]['range'];
    $image  = $update[$x]['image'];
    
    
    $return = mysqli_query($con, "SELECT * FROM Badges WHERE name = '$name'");
    $didReturn = mysqli_num_rows($return);
    if ($didReturn) {
        $dbValues = mysqli_fetch_assoc($return);
        

        echo "<tr>";
        if (($dbValues['latitude'] != $lats) or ($dbValues['longitude'] != $longs) 
            or ($dbValues['range'] != $ranges) or ($dbValues['description'] != $desc)
           or ($dbValues['image'] != $image)) {
            $query = "UPDATE Badges SET `latitude`='$lats', `longitude`='$longs',`range`='$ranges',`description`= '$desc',`image`='$image' WHERE `name`='$name'";
            if($success = mysqli_query($con, $query)) {
                echo "<td>".$name."</td>";
                echo "<td>Latitude is now: ".$lats."</td>";
                echo "<td>Longitude is now: ".$longs."</td>";
                echo "<td>Range is now: ".$ranges."</td>";
                echo "<td>Description is now: ".$desc."</td>";
                echo "<td>Image is now: ".$image."</td>";
                $printed = true;
                echo "</tr>";
            }
        }
    }
    else {
        $nextNumber = mysqli_query($con, "SELECT MAX(badgeid) AS recentBadge FROM Badges");
        $nextNumber = mysqli_fetch_assoc($nextNumber);
        $nextNumber['recentBadge'] += 1;
        $nextNumber = $nextNumber['recentBadge'];
        $currentTime = date('Y-m-d h:m:s');
        $enabled = 1;
        
        $categories = "(`badgeid` ,`name` ,`description` ,`date_added` ,`enabled` ,`latitude` ,`longitude` ,`range` ,`image`)";
        $values     = "($nextNumber,  '$name',  '$desc',  '$currentTime',  '$enabled',  '$lats',  '$longs',  '$ranges',  '$image')";
        $query = "INSERT INTO Badges $categories VALUES $values";
        if($success = mysqli_query($con, $query)) {
            printf("badgeid\tname\t\t\tdescription\tdate_added\tenabled\tlatitude\tlongitude\trange\timage\n");
            echo $nextNumber."\t".$name."\t".$desc."\t".$currentTime."\t".$enabled."\t".$lats."\t".$longs."\t".$ranges."\t".$image."\n";
            $printed = true;
        }
    }
}
echo "</table>";
if($printed == false) {
    echo "No database changes were made";
}

?>
</html>