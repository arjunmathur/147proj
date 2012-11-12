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
		
		<div data-role="fieldcontain">
			<form action="createAccount.php" method="post">
				<label for="usernameBox">Username:</label>
				<input type="text" name="username" id="usernameBox">
				<label for="passwordBox">Password:</label>
				<input type="password" name="password" id="passwordBox">
				<label for="passwordBox2">Confirm Password:</label>
				<input type="password" name="passwordConfirm" id="passwordBox2">
				<label for="emailBox">E-Mail Address:</label>
				<input type="email" name="email" id="emailBox">
				<input type="submit" value="Create Account">
			</form>
		</div>	
		<div id="info">
			<?php
			if($_POST)
			{	
				include("config.php");
				$createFlag = true;
				$username = $_POST["username"];
				$password = $_POST["password"];
				$passwordConfirm = $_POST["passwordConfirm"];
				$email = $_POST["email"];
				
				if($username == ""){
					$createFlag = false;
					echo "<div>\n";
					echo "<font color='red'>Please enter a username\n</font>";
					echo "</div>";
				}
				if($password == NULL){
					$createFlag = false;
					echo "<div>\n";
					echo "<font color='red'>Please enter a password\n</font>";
					echo "</div>";
				}
				if($passwordConfirm == NULL){
					$createFlag = false;
					echo "<div>\n";
					echo "<font color='red'>Please confirm your password\n</font>";
					echo "</div>";
				}
				
				if($password != $passwordConfirm){
					$createFlag = false;
					echo "<div>\n";
					echo "<font color='red'>Your password and confirm do not match, please try again</font>";
					echo "</div>";
				}
				if($email == NULL){
					$createFlag = false;
					echo "<div>\n";
					echo "<font color='red'>Please enter an email address\n</font>";
					echo "</div>";
				}
				
				if(	$createFlag){
					$existingUserQuery = "SELECT * FROM users WHERE username = '".$username."'";
					$result = mysql_query($existingUserQuery);
					if(mysql_num_rows($result) > 0){
						$createFlag = false;
						echo "<div>\n";
						echo "\n<font color='red'>Sorry, that username is taken! Please try another one\n</font>";
						echo "</div>";
					}
				}
				if(	$createFlag){
				$insertQuery = sprintf("INSERT INTO users " .
								 " (username, password, cur_trip_id, email_address) " .
								 " VALUES ('%s', '%s', NULL, '%s');",
								 mysql_real_escape_string($username),
								 mysql_real_escape_string($password),
								 mysql_real_escape_string($email));
								 
				$result = mysql_query($insertQuery);
				?>
				<script type="text/javascript">
				// Save the username in local storage. That way you
				// can access it later even if the user closes the app.
				localStorage.setItem('username', '<?=$_POST["username"]?>');
				$.mobile.changePage("index.php", { transition: "flip", reloadPage: true} );
				alert("Welcome to GrouPS!");
				</script>
				<?php
				}
				
			}
			?>
			
		
		</div>	
	
	</div><!-- /content -->

    
	<script type="text/javascript">
	</script>
	<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
		<ul>
			<li><a href="login.php" id="home" data-ajax="false" data-icon="home" >Log In</a></li>
			<li><a href="#" id="key" data-icon="plus" class="ui-btn-active ui-state-persist">Create Account</a></li>
			
		</ul>
		</div>
	</div>
	
</div><!-- /page -->

</body>
</html>