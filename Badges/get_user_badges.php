<?php 
header('Content-type: application/json;charset=UTF-8');

include("main/_header.php");

$user_badges = array();

$uid = $_SESSION["uid"];

$sql = "select * from User_Badges where uid='$uid'";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
	$temp = array(
		"badgeid" => $row['badgeid'],
		"obtained" => $row['obtained'],
		"unlocked" => $row['unlocked'],
	);

	array_push($user_badges, $temp);
}

echo json_encode($user_badges);
?>
