<?php
header("Cache-Control: no-cache");
			 
include("config.php");
$username = $_POST["username"];
$tripId = $_POST["trip_id"];


$query = "UPDATE trip_participants SET STATUS=2 WHERE username='".$username."' AND trip_id=$tripId";
$result = mysql_query($query);
echo $result;

?>