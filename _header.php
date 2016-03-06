<?php
    session_start();
    ini_set('display_errors', 'On'); 
    $con = mysqli_connect('oniddb.cws.oregonstate.edu','buffumw-db','PizSfykTJBUp3NbW','buffumw-db') or die("Can't connect to database.");

    function connect_db(){
        $db = new mysqli('oniddb.cws.oregonstate.edu','buffumw-db','PizSfykTJBUp3NbW','buffumw-db');
        if($db->connect_errno){
            die('Sorry, page unavailable');
        }else{
            return $db;
        }
    }
?>