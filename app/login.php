<!DOCTYPE html> 
<html>

<head>
	<title>GrouPS | Login</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

</head>  
<body> 

<div data-role="page" data-theme="a">

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
	localStorage.removeItem('username');
	$(document).bind('pageinit',function(event){
		
		$("#logout").hide();
		$("#info").hide();
	});
	
	var retrievedObject = localStorage.getItem('username');
	if (retrievedObject != "") {
		$("#form").hide();	
		$("#logout").show();
		$("#info").show();
	}
	$("#logout").click(function() {
		localStorage.removeItem('username');
		$("#form").show();
		$("#logout").hide();
		$("#info").hide();
	});
	</script>
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
		<ul>
			<li><a href="#" id="login" data-icon="home" class="ui-btn-active ui-state-persist">Log In</a></li>
			<li><a href="createAccount.php" id="createaccount" data-icon="plus" >Create Account</a></li>
			
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>