<?php
header("Cache-Control: no-cache");
?>
<!DOCTYPE html> 
<html>

<head>
	<title>GrouPS | Submit</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<link rel="stylesheet" href="themes/GrouPSTheme.css" />
	<link rel="stylesheet" href="style.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Welcome!</h1>
		

	</div><!-- /header -->

	<div data-role="content">	
	
		
		<?php
		include("config.php");
		$query = "SELECT * FROM users WHERE username = '".$_POST["username"]."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if (!is_null($row['username']) AND ($row['username'] == $_POST["username"]) AND $row['password'] == $_POST["password"]) {
			?>
			<script type="text/javascript">
				
				// Save the username in local storage. That way you
				// can access it later even if the user closes the app.
				localStorage.setItem('username', '<?=$_POST["username"]?>');
				event.preventDefault();
      	  		window.location.assign("index.php");
				//$.mobile.changePage("index.php", { reloadPage: true} );
				
			</script>
			<?php
			//echo "<p>Welcome <strong>".$_POST["username"]."</strong>.</p>";
		} else {
			 echo "<p>The username password combination is incorrect.</p>";
			 ?><script type="text/javascript">$.mobile.changePage("login.php");</script>
			 <?php
		}
		?>
	</div><!-- /content -->


</div><!-- /page -->

</body>
</html>