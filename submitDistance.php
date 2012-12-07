<?php
header("Cache-Control: no-cache");
include("config.php");

$query1 = "SELECT cur_trip_id from users WHERE username = '".$_POST["username"]."'";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1);

$tripId = $row1['cur_trip_id'];
$username = $_POST["username"];
$time = $_POST["time"];
$dist = $_POST["distance"];
$timeValue = $_POST["time_value"];
$distValue = $_POST["dist_value"];

$query = "UPDATE trip_participants SET time_to_dest='".$time."', dist_to_dest='".$dist."' , time_to_dest_value_seconds='".$timeValue."', dist_to_dest_value_meters='".$distValue."' WHERE trip_id=".$tripId." AND username='".$username."'";

$result = mysql_query($query);
?>