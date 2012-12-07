<?php
header("Cache-Control: no-cache");
			 
include("config.php");
$username = $_POST["username"];
$query = "SELECT trip_participants.trip_id, dest_name FROM trip_participants INNER JOIN trips ON trip_participants.trip_id = trips.trip_id WHERE trip_participants.STATUS=0 AND  trip_participants.username='".$username."'";
$result = mysql_query($query);
$data = "";
while($row = mysql_fetch_assoc($result)){
	$trip_id = $row['trip_id'];
	$dest_name = $row['dest_name'];
	$inviterQuery = "SELECT username FROM trip_participants WHERE trip_id = $trip_id AND TRAVEL_STATUS=0";
	$inviterResult = mysql_query($inviterQuery);
	$inviterRow = mysql_fetch_assoc($inviterResult);
	$inviter = $inviterRow['username'];
	if(!is_null($inviter) && $inviter != $username)
	$data = $data."<li ><a data-trip='$trip_id' class='trip' href='#respond' data-rel='popup'  data-transition='flow' data-position-to='window'><FONT COLOR='38C5FC'>$dest_name </FONT>with $inviter</a></li>";
}
echo $data;
?>