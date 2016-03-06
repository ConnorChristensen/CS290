<?php 
header('Content-type: application/json;charset=UTF-8');
?>
<?php include("main/_header.php");?>
<?php
# I'm assuming the session variable for their id is called this.
//$uid = $_SESSION['uid'];
$uid = 5;

$badges = array();
# Get the badge IDs of their current badges from table User_Badges
$sql = "select badgeid from User_Badges where uid = '$uid'";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
	# Get badge information associated with each badge ID from Badges table	
	$bid = $row['badgeid'];
	$sql2 = "select * from Badges where badgeid = '$bid'";
	$result2 = mysqli_query($con, $sql2) or die("Error: " . mysqli_error($con));

	while ($row2 = mysqli_fetch_array($result2)) {
		$temp = array(
			"name" => $row2['name'],
			"description" => $row2['description'],
			"date_added" => $row2['date_added'],
			"image" => $row2['image']
		);

		array_push($badges, $temp);
	}

}

echo json_encode($badges);
?>
