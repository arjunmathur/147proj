<?php
include("config.php");
$destName = $_POST["destName"];
$destAddr = $_POST["destAddr"];
$destLat = $_POST["destLat"];
$destLng = $_POST["destLng"];

$user = $_POST["user"];
$status = 1;

$tripsQuery = sprintf("INSERT INTO trips " .
		 " (trip_id, dest_name, dest_address, dest_lat, dest_lng) " .
		 " VALUES (NULL, '%s', '%s', '%s', '%s');",
		 mysql_real_escape_string($destName),
		 mysql_real_escape_string($destAddr),
		 mysql_real_escape_string($destLat),
		 mysql_real_escape_string($destLng));

$result = mysql_query($tripsQuery);
$trip_id = mysql_insert_id();

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

$userQuery = sprintf("UPDATE users SET  cur_trip_id = '%s' WHERE username = '%s';",
		 mysql_real_escape_string($trip_id),
		 mysql_real_escape_string($user));
		 
$result1 = mysql_query($userQuery);
		 
$participantsQuery = sprintf("INSERT INTO trip_participants " .
		 " (trip_id, username, STATUS, TRAVEL_STATUS, time_to_dest, dist_to_dest) " .
		 " VALUES ('%s', '%s', '%s', NULL, NULL, NULL);",
		 mysql_real_escape_string($trip_id),
		 mysql_real_escape_string($user),
		 mysql_real_escape_string($status));

$result2 = mysql_query($participantsQuery);
?>