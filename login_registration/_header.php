<?php
session_start();
function connect_db(){
	$db = new mysqli('oniddb.cws.oregonstate.edu','buffumw-db','PizSfykTJBUp3NbW','buffumw-db');
	if($db->connect_errno){
		die('Sorry, page unavailable');
	}else{
		return $db;
	}
}
?>
