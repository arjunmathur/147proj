<?php
include("config.php");
$username = $_POST["username"];
$toAdd = $_POST["toAdd"];

$status = 0; //waiting for reply

$query1 = "SELECT cur_trip_id from users WHERE username = '".$_POST["username"]."'";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1);
$tripId = $row1['cur_trip_id'];

$insertQuery = sprintf("INSERT INTO trip_participants " .
		 " (trip_id, username, STATUS, TRAVEL_STATUS, time_to_dest, dist_to_dest) " .
		 " VALUES (%d, '%s', %d, NULL, NULL, NULL);",
		 mysql_real_escape_string($tripId),
		 mysql_real_escape_string($toAdd),
		 mysql_real_escape_string($status));

$result = mysql_query($insertQuery);
$data = array('trip_id' => "$tripId");
echo json_encode($data);


?>