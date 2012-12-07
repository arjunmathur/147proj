<?php
header("Cache-Control: no-cache");			 
include("config.php");
$username = $_POST["username"];
$tripId = $_POST["trip_id"];


$query = "UPDATE users SET cur_trip_id=$tripId WHERE username='".$username."'";
$result = mysql_query($query);
$query2 = "UPDATE trip_participants SET STATUS=1 WHERE trip_id=$tripId AND username='".$username."'";
$result2 = mysql_query($query2);
echo result;
?>