<!DOCTYPE html> 
<html>

<head>
	<title>GrouPS</title> 
	<meta charset="utf-8">
	<link rel="apple-touch-startup-image" href="startup.png">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon-precomposed" href="GrouPS_icon.png"/> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
</head>  
<body> 

<div data-role="page" style="background: #000000 url('GrouPS_background.png') repeat;" data-theme="a">

	<div data-role="header">
	<h1>Log in</h1>
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
	
	$(document).bind('pageinit',function(event){
		//if(localStorage.getItem("username") != "") $.mobile.changePage("index.php");
	});
	
	$(document).ready(function(){
	    $('#accountLink').click(function(event){
	        event.preventDefault();
	        window.location.assign($(this).attr('href'));
	    });
	});
	
	</script>
	
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
		<ul>
			<li><a href="#" id="login" data-icon="home" class="ui-btn-active ui-state-persist">Log In</a></li>
			<li><a id="accountLink" href="createAccount.php" data-ajax="false" id="createaccount" data-icon="plus" >Create Account</a></li>
			
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>