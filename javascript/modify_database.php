<?php 
header('Content-type: application/json;charset=UTF-8');

include("../_header.php");

if(!isset($_SESSION["uid"])){
    header("Location: http://web.engr.oregonstate.edu/~chriconn/login_registration/login.php");
}


$update = array(
    array('name' => "Oregon",                          'lat' => 44.132080,      'long' => -120.541674,    'range' => 370653),
    array('name' => "Oregon State University",         'lat' => 44.563036,      'long' => -123.281925,    'range' => 955),
    array('name' => "Kelly Engineering Center",        'lat' => 44.567193,      'long' => -123.278480,    'range' => 58),
    array('name' => "The Memorial Union",              'lat' => 44.565118,      'long' => -123.278900,    'range' => 68),
    array('name' => "Reser Stadium",                   'lat' => 44.559464,      'long' => -123.280878,    'range' => 132),
    array('name' => "Goss Stadium",                    'lat' => 44.562892,      'long' => -123.277066,    'range' => 20),
    array('name' => "Weatherford Hall",                'lat' => 44.564046,      'long' => -123.280613,    'range' => 20),
    array('name' => "Valley Library",                  'lat' => 44.565185,      'long' => -123.275987,    'range' => 55),
    array('name' => "Wineger Hall",                    'lat' => 44.567898,      'long' => -123.277389,    'range' => 20),
    array('name' => "Dearborn Hall",                   'lat' => 44.567204,      'long' => -123.275530,    'range' => 20),
    array('name' => "Learning Innovation Center",      'lat' => 44.565782,      'long' => -123.281725,    'range' => 20),
    array('name' => "The Waterfront",                  'lat' => 44.564798,      'long' => -123.257869,    'range' => 20),
    array('name' => "Qdoba",                           'lat' => 44.568183,      'long' => -123.275449,    'range' => 25),
    array('name' => "Chipotle",                        'lat' => 44.569051,      'long' => -123.279108,    'range' => 25),
    array('name' => "Avery Park",                      'lat' => 44.553933,      'long' => -123.273736,    'range' => 40),
    array('name' => "Broken Yolk",                     'lat' => 44.563892,      'long' => -123.260820,    'range' => 20),
    array('name' => "Darkside Theatre",                'lat' => 44.563280,      'long' => -123.262443,    'range' => 20),
    array('name' => "Chip Ross Park",                  'lat' => 44.608263,      'long' => -123.281640,    'range' => 20),
    array('name' => "University of Oregon",            'lat' => 44.043793,      'long' => -123.073169,    'range' => 666),
    array('name' => "Deschutes Brewery",               'lat' => 45.524612,      'long' => -122.681889,    'range' => 20),
    array('name' => "Cannon Beach",                    'lat' => 45.887668,      'long' => -123.961955,    'range' => 20),
    array('name' => "Washington Monument",             'lat' => 38.889469,      'long' => -77.035236,     'range' => 100),
    array('name' => "Eiffel Tower",                    'lat' => 48.858020,      'long' => 2.294813,       'range' => 20)
);

$locationNumber = count($update);

for ($x = 0; $x < $locationNumber; $x++) {
    
    $name = $update[$x]['name'];
    if ($return = mysqli_query($con, "SELECT * FROM Badges WHERE name = '$name'")) {
        
        $lats  = $update[$x]['lat'];
        $longs = $update[$x]['long'];
        $ranges = $update[$x]['range'];
        $dbValues = mysqli_fetch_assoc($return);
        
        echo $name."\n".$dbValues['range']."\t".$ranges."\n";
        
        if (($dbValues['latitude'] != $lats) or ($dbValues['longitude'] != $longs) or ($dbValues['range'] != $ranges)) {
            $query = "UPDATE Badges SET latitude=$lats, longitude=$longs WHERE name='$name'";
//            
//            if($success = mysqli_query($con, $query)) {
//                printf("%s\t\tlatitude is now:%f\tlongitude is now:%frange is now:%d\n", $name, $lats, $longs, $ranges);
//            }
        }
    }
}
?>
