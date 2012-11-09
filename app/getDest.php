<?php
				include("config.php");
				//$user = $_POST["username"];
				$query1 = "SELECT cur_trip_id from users WHERE username = '".$_POST["username"]."'";
				$result1 = mysql_query($query1);
				$row1 = mysql_fetch_array($result1);
				$tripId = $row1['cur_trip_id'];
				$query2 = "SELECT * FROM trips WHERE trip_id = '".$tripId."'";
				$result2 = mysql_query($query2);
				
				$row2 = mysql_fetch_array($result2);
				$lat = $row2['dest_lat'];
				$lng = $row2['dest_lng'];
				
				$arr = array('lat' => $lat, 'lng' => $lng);

				echo json_encode($arr);
	
?>