<?php
header("Cache-Control: no-cache");
include("config.php");

$tripId = $_POST["trip_id"];
$query1 = "SELECT * FROM trip_participants WHERE trip_id = $tripId AND TRAVEL_STATUS = 0";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1);

echo $row1['time_to_dest'];


?>