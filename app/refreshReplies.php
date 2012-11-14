<?php

include("config.php");
$query = "SELECT * FROM trip_participants WHERE (trip_id = ".$_GET["trip_id"]." AND STATUS=1)";
$result = mysql_query($query);
$data = "";
while($row = mysql_fetch_assoc($result)){
	$username = $row['username'];
	$data .= "<li>$username</li>";
}
echo $data
?>