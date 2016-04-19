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

if($unlockedBadges = mysqli_query($con, "SELECT * FROM User_Badges WHERE uid=$uid")) {
    $badgesNumber = mysqli_num_rows($unlockedBadges);
}

for($x = 1; $x <= $badgesNumber; $x++) {
    $unlockedInfo = mysqli_fetch_assoc($unlockedBadges);
    $temp = array(
        "badgeid" => $unlockedInfo["badgeid"],
        "obtained" => $unlockedInfo["obtained"],
        "unlocked" => "1",
    );
    array_push($user_badges, $temp);
}
echo json_encode($user_badges);
?>