<?php 
header('Content-type: application/json;charset=UTF-8');
?>
<?php include("_header.php");?>
<?php

$images = array();

$sql = "select image from Badges";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
	$temp = array(
		"image" => $row['image']
	);

	array_push($images, $temp);
	}

echo json_encode($images);
?>
