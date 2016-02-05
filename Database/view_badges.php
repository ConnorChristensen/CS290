<?php

session_start();

$con = mysqli_connect('oniddb.cws.oregonstate.edu', 'claytonh-db', 'jx8DSk1EJTf2NTdh', 'claytonh-db') or die("Error connecting to database server");

# I'm assuming the session variable for their id is called this.
$uid = $_SESSION["userid"];

# Get the badge IDs of their current badges from table User_Badges
$sql = "select badgeid from User_Badges where userid = '$uid'";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
	# Get badge information associated with each badge ID from Badges table	
	$bid = $row['badgeid'];
	$sql2 = "select * from Badges where badgeid = '$bid'";
	$result2 = mysqli_query($con, $sql2) or die("Error: " . mysqli_error($con));

	while ($row2 = mysqli_fetch_array($result2)) {
		echo "Name: " . $row2['name'] . "<br>";
		echo "Description: " . $row2['description'] . "<br>";
		echo "Date Added: " . $row2['date_added'] . "<br>";
		echo "<br>";
	}

}

mysqli_close();

?>
