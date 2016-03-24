<?php 
header('Content-type: application/json;charset=UTF-8');

include("../_header.php");

if(!isset($_SESSION["uid"])){
    header("Location: http://web.engr.oregonstate.edu/~chriconn/login_registration/login.php");
}

$user_badges = array();

$uid = $_SESSION["uid"];

$sql = "select * from User_Badges where uid='$uid'";

$result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));

//while ($row = mysqli_fetch_array($result)) {
//	$temp = array(
//		"badgeid" => $row['badgeid'],
//		"obtained" => $row['obtained'],
//		"unlocked" => $row['unlocked'],
//	);
//
//	array_push($user_badges, $temp);
//}

if($query = mysqli_query($con, "SELECT * FROM Badges")) {
    $badgesNumber = mysqli_num_rows($query);
}
else {
    echo "It returned nothing";
}

for($x = 1; $x <= $badgesNumber; $x++) {
    $content = mysqli_query($con, "SELECT obtained FROM User_Badges WHERE badgeid='$x' AND uid=$uid");
    if ($validNumber = mysqli_num_rows($content)) {
        $date = mysqli_fetch_array($content);
        $temp = array(
            "badgeid" => "$x",
            "obtained" => $date['obtained'],
            "unlocked" => "1",
        );
        array_push($user_badges, $temp);
    }
    else {
        $temp = array(
            "badgeid" => "$x",
            "obtained" => "2016-03-23 15:10:23",
            "unlocked" => "0",
        );
        array_push($user_badges, $temp);
    }
}


echo json_encode($user_badges);
?>