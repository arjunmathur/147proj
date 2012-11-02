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
		<h1>My Title</h1>
		<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">	
		
		<?php
		include("config.php");
		$query = "SELECT * FROM users WHERE username = '".$_POST["username"]."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if (($_POST["username"] == "test" && $_POST["password"] == "test") || $row['password'] == $_POST["password"]) {
			?>
			<script type="text/javascript">
				// Save the username in local storage. That way you
				// can access it later even if the user closes the app.
				localStorage.setItem('username', '<?=$_POST["username"]?>');
			</script>
			<?php
			echo "<p>Thank you, <strong>".$_POST["username"]."</strong>. You are now logged in.</p>";
		} else {
			echo "<p>There seems to have been an error.</p>";
		}
		
		?>
	</div><!-- /content -->

	<script type="text/javascript">
		$("#logout").click(function() {
			localStorage.removeItem('username');
			$("#form").show();
			$("#logout").hide();
		});
	</script>
</div><!-- /page -->

</body>
</html>