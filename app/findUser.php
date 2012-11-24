<?php
include("config.php");
$username = $_POST["username"];
$toFind = $_POST["search_username"];

if($username == $toFind) echo "Sorry, you cannot add yourself.";
else{

	$query = "SELECT * FROM users WHERE username='".$toFind."'";
	$result = mysql_query($query);
	$numRows = mysql_num_rows($result);
	$row = mysql_fetch_assoc($result);

	if($numRows == 0) echo "Sorry, there is no user by that name.";
	else{
		$checkQuery = "SELECT * FROM contacts WHERE (user='".$username."' AND user_contact='".$toFind."')";
		$result1 = mysql_query($checkQuery);
		$numRows1 = mysql_num_rows($result1);
		if($numRows1 > 0) echo "You are already friends with ".$toFind.".";
		else{
			$addQuery = "INSERT INTO contacts (user, user_contact) VALUES ('".$username."', '".$toFind."')";
			$result2 = mysql_query($addQuery);
			echo $toFind;
		}
	}
}


?>