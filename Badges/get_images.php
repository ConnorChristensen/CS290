<?php 
header('Content-type: application/json;charset=UTF-8');

include("../_header.php");

if(!isset($_SESSION["uid"])){
    header("Location: http://web.engr.oregonstate.edu/~chriconn/login_registration/login.php");
}


$images = array();

$sql = "SELECT image FROM Badges";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
	$temp = array(
		"image" => $row['image']
	);

	array_push($images, $temp);
	}

echo json_encode($images);
?>
