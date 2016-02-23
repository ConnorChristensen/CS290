<?php 
header('Content-type: application/json;charset=UTF-8');
?>
<?php include("_header.php");?>
<?php

$badge = array();

$badgeid = $_GET['badgeid'];

$sql = "select name, description from Badges where badgeid='$badgeid'";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
	$temp = array(
		"name" => $row['name'],
		"description" => $row['description']
	);

	array_push($badge, $temp);
	}

echo json_encode($badge);
?>
