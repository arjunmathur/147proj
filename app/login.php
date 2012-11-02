<!DOCTYPE html> 
<html>

<head>
	<title>GrouPS | Login</title> 
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
	<h1>Log in</h1>
	<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">
	
		<div data-role="fieldcontain">
			<form action="submit.php" method="post">
				<label for="usernameBox">Username:</label>
				<input type="text" name="username" id="usernameBox">
				<label for="passwordBox">Password:</label>
				<input type="password" name="password" id="passwordBox">
				<input type="submit" value="Login">
			</form>
		</div>	
	
		<div id="info"></div>	
	</div><!-- /content -->

    
	<script type="text/javascript">
	$("#logout").hide();
	$("#info").hide();
	var retrievedObject = localStorage.getItem('username');
	/*if (retrievedObject != "") {
		$("#form").hide();	
		$("#logout").show();
		$("#info").show();
	}
	$("#logout").click(function() {
		localStorage.removeItem('username');
		$("#form").show();
		$("#logout").hide();
		$("#info").hide();
	});*/
	</script>
</div><!-- /page -->

</body>
</html>