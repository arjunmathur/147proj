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
		
		
		<div data-role="popup" id="popupCreateAccount" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
			<form>
				<div style="padding:10px 20px;">
				  <h3>Create New Account</h3>
		          <label for="un" class="ui-hidden-accessible">Username:</label>
		          <input type="text" name="user" id="un" value="" placeholder="Username" data-theme="a" />

		          <label for="pw" class="ui-hidden-accessible">Password:</label>
		          <input type="password" name="pass" id="pw" value="" placeholder="Password" data-theme="a" />
		          
		          <label for="pw2" class="ui-hidden-accessible">Confirm Password:</label>
		          <input type="password" name="pass2" id="pw2" value="" placeholder="Confirm Password" data-theme="a" />
		          
		          <label for="em" class="ui-hidden-accessible">E-Mail Address:</label>
		          <input type="email" name="email" id="em" value="" placeholder="E-Mail Address" data-theme="a" />

		    	  <button type="submit" data-theme="b">Create Account</button>
				</div>
			</form>
		</div>
		
		
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
		
		<a href="#popupCreateAccount" data-icon="plus" id="newAccount" data-role="button" data-rel="popup" data-theme="c" data-transition="flow">Create New Account</a>
	
	</div><!-- /content -->

    
	<script type="text/javascript">
	$(document).bind('pageinit',function(event){
		localStorage.removeItem('username');
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