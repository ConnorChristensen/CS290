<?php 
header('Content-type: application/json;charset=UTF-8');

include("../_header.php");


$images = array();

$sql = "SELECT * FROM Badges";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
	$temp = array(
		"name" => $row['name'],
        "latitude" => $row['latitude'],
        "longitude" => $row['longitude'],
        "range" => $row['range'],
        "public" => $row['enabled'],
	);

	array_push($images, $temp);
	}

echo json_encode($images);
?>
