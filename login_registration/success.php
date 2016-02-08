<?php
session_start();
?>
<html>

    <title>Success!</title>
    <h1>SUCCESS</h1>
    <p>You can now search for badges, check into locations using our geo-app to get badges, and view your badge profile!</p>
    <link rel="stylesheet" type="text/css" href="./sucess.css">
	<h3><?php //echo "<br>Session: " . $_SESSION["uid"] . "<br>";
			echo "<br>Welcome, your session has been set<br>";
		?>
	</h3>

</html>
