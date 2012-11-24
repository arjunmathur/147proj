<?php
include("config.php");

$query1 = "SELECT cur_trip_id from users WHERE username = '".$_POST["username"]."'";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1);
$tripId = $row1['cur_trip_id'];
$travelStatus = $_POST["status"];

$query = "UPDATE trip_participants SET TRAVEL_STATUS='.$travelStatus.' WHERE trip_id=".$tripId." AND username='".$_POST["username"]."'";

$result = mysql_query($query);
?>