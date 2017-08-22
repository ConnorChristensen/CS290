<?php

/* #TODO
 * Insert is not secure at the moment, must fix
 *
 *
 */

include 'connect_db.php';

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'buffumw-db';
$dbuser = 'buffumw-db';
$dbpass = 'PizSfykTJBUp3NbW';
 
$db_conn = connect_db($dbhost, $dbname, $dbuser, $dbpass);

$user_credentials["username"] = htmlspecialchars($_POST["username"]);
$user_credentials["password"] = htmlspecialchars($_POST["password"]);
$user_credentials["email"] 	= htmlspecialchars($_POST["email"]);

$sql = "INSERT INTO Users (`username`, `email`, `password`, `date_created`) VALUES ('" .
			  $user_credentials["username"] .
	"','" . $user_credentials["email"] .
	"','" . $user_credentials["password"] .
	"',"  . $_SERVER['REQUEST_TIME'] . ")";
 
if(!mysqli_query($db_conn, $sql)){
	echo "<br>Error: " . mysqli_error($db_conn, $sql);
}

mysql_close($db_conn);
?>
