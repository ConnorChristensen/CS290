<?php

function connect_db($db_host, $db_name, $db_user, $db_password){
	$mysql_handle = mysqli_connect($db_host, $db_user, $db_password)
		    or die("Error connecting to database server");

	mysqli_select_db($mysql_handle, $db_name)
		    or die("Error selecting database: $db_name");

	echo 'Successfully connected to database!';

	return $mysql_handle;
}

?>
