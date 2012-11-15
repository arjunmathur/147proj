<?php

						 
include("config.php");
$query0 = "SELECT * FROM trip_participants WHERE (trip_id = ".$_POST["trip_id"]." AND STATUS=0)";
$result0 = mysql_query($query0);
$waiting = "";
while($row = mysql_fetch_assoc($result0)){
	$username = $row['username'];
	$waiting .= "<li>$username</li>";

}


$query1 = "SELECT * FROM trip_participants WHERE (trip_id = ".$_POST["trip_id"]." AND STATUS=1)";
$result1 = mysql_query($query1);
$accepted = "";
while($row = mysql_fetch_assoc($result1)){
	$username = $row['username'];
	$accepted .= "<li>$username</li>";
}

$query2 = "SELECT * FROM trip_participants WHERE (trip_id = ".$_POST["trip_id"]." AND STATUS=2)";
$result2 = mysql_query($query2);
$denied = "";
while($row = mysql_fetch_assoc($result2)){
	$username = $row['username'];
	$denied .= "<li>$username</li>";
}



$data = array('waiting' => "$waiting", 'accepted' => "$accepted", 'denied' => "$denied");
echo json_encode($data);
?>