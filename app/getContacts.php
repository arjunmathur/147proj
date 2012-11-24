<?php
include("config.php");
$query = "SELECT * FROM contacts WHERE user = '".$_POST["username"]."' ORDER BY user_contact ASC";
$result = mysql_query($query);
while($row = mysql_fetch_assoc($result)){
	$contactName = $row["user_contact"];
	echo "<li value=\"$contactName\" onclick = \"add(this)\"><a>$contactName</a></li>";
}
?>