<?php
header("Cache-Control: no-cache");
	include("config.php");
	$query1 = "SELECT cur_trip_id from users WHERE username = '".$_POST["username"]."'";
	$result1 = mysql_query($query1);
	$row1 = mysql_fetch_array($result1);
	$tripId = $row1['cur_trip_id'];	
	
	$query2 = "SELECT * FROM trip_participants WHERE trip_id = ".$tripId." AND STATUS=1 ORDER BY time_to_dest_value_seconds DESC";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_assoc($result2);
	$longestTime = $row2['time_to_dest_value_seconds'];
	$listData = "";
	$myTime;
	while($row2){
		$thisUser = $row2["username"];
		$dist = $row2["dist_to_dest"];
		$time = $row2["time_to_dest"];
		$status = $row2["TRAVEL_STATUS"];
		if($thisUser == $_POST["username"]){
			$thisUser = "<FONT COLOR='38C5FC'><h2>$thisUser</h2></FONT>";
			$myTime = $row2["time_to_dest_value_seconds"];
		} else {
			$thisUser = "<h2>$thisUser</h2>";
		}
		if($status == 0){
			$listData = $listData."<li><h3>$thisUser</h3><p><strong>$dist / $time</strong></p><p>Waiting to Leave</p></li>";
		}else if($status == 1){
			$listData = $listData."<li><h3>$thisUser</h3><p><strong>$dist / $time</strong></p><p>Travelling to Destination</p></li>";
		}else if($status == 2){
			$listData = $listData."<li><h3>$thisUser</h3><p>Arrived</p></li>";
		}else{
			$listData = $listData."<li><h3>$thisUser</h3><p><strong>$dist / $time</strong></p></li>";
		}
	
		$row2 = mysql_fetch_assoc($result2);
	}
	$leaveTime = $longestTime - $myTime;
	$data = array('listData' => "$listData", 'leaveTime' => "$leaveTime");
	echo json_encode($data);
	
	
?>