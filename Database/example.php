<?php
# view here: https://web.engr.oregonstate.edu/~claytonh/view.php
# connects to database or kills program
$con = mysqli_connect('oniddb.cws.oregonstate.edu', 'claytonh-db', 'jx8DSk1EJTf2NTdh', 'claytonh-db') or die("Error connecting to database server");

$sql = "SELECT * FROM Badges";

# sends query to mysql
$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

echo "<b>Badges Available</b><br>";

# loops through mysql result and prints each column
while ($row = mysqli_fetch_array($result)) {
	echo "Badge ID: ";
	echo $row['badgeid'];
	echo "<br>Description: ";
	echo $row['description'];
	echo "<br>Date created: ";
	echo $row['date_created'];
	echo "<br>Number of people who have this badge: ";
	echo $row['num_owners'];
	echo "<br><br>";
}

$sql = "SELECT * FROM User";
$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));;

echo "<b>All Current Users</b><br>";

while ($row = mysqli_fetch_array($result)) {
	$uid = $row['userid'];	
	echo "User ID: ";
	echo $row['userid'];
	echo "<br>Username: ";
	echo $row['username'];
	echo "<br>Number of Badges: ";
	echo $row['numbadges'];
	echo "<br>Current badges: ";
	
	$sql2 = "select * from Badges, User_Badges where User_Badges.badgeid = Badges.badgeid and User_Badges.userid = '$uid'";	
	$result2 = mysqli_query($con, $sql2) or die("Error: " . mysqli_error($con));
	
	# gets all badges associated with certain user id and prints them
	while ($row2 = mysqli_fetch_array($result2)) {
		echo $row2['badgeid'];
		echo " ";
	}
	
	echo "<br><br>";
}

# close connection
mysqli_close()
?>
