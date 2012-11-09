<!DOCTYPE html> 
<html>

<head>
	<title>GrouPS | Create Account</title> 
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
	<h1>Create Account</h1>
	</div><!-- /header -->

	<div data-role="content">
		<div data-role="popup" id="submit" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
			<div data-role="header" data-theme="a" class="ui-corner-top">
				<h1>Confirm</h1>
			</div>
			<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
				<h3 class="ui-title">Would you like to start?</h3>
				<p>People who haven't joined will not be able to join after you start.</p>
				<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancel</a>    
				<a href="nav_overview.html" data-role="button" data-inline="true"  data-transition="slide" data-theme="b">Start Navigation</a>  
			</div>
		</div>
		<div data-role="fieldcontain">
			<form action="submit.php" method="post">
				<label for="usernameBox">Username:</label>
				<input type="text" name="username" id="usernameBox">
				<label for="passwordBox">Password:</label>
				<input type="password" name="password" id="passwordBox">
				<label for="passwordBox2">Confirm Password:</label>
				<input type="password" name="password2" id="passwordBox2">
				<label for="emailBox">E-Mail Address:</label>
				<input type="email" name="email" id="emailBox">
				<input type="submit" value="Create Account">
			</form>
		</div>	
		<div id="info">hey</div>	
	
	</div><!-- /content -->

    
	<script type="text/javascript">
	$("#logout").hide();
	$("#info").hide();
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
			<li><a href="#" id="home" data-icon="home" >Log In</a></li>
			<li><a href="#" id="key" data-icon="plus" class="ui-btn-active ui-state-persist">Create Account</a></li>
			
		</ul>
		</div>
	</div>
	
</div><!-- /page -->

</body>
</html>