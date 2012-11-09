<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Home</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="apple-touch-startup-image" href="startup.png">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		
    </head>
    <body>
        <div data-role="page" id="nav_overview" data-theme="a">
            <div data-theme="a" data-role="header">
                <a href="#help" data-rel="popup" data-theme="c" data-transition="flow" data-icon="info">Help</a>
				<h1>GrouPS</h1>
            </div>
			
			<div data-role="popup" id="help" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Help</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">GrouPS allows your group of friends to all arrive at the same time. </h3>
					<p><FONT COLOR="FFFFFF"> To create a new Group Navigation, click <strong></FONT><FONT COLOR="38C5FC">Start New Navigation. </strong></FONT><FONT COLOR ="FFFFFF"> To join a group someone else created, find it under the </FONT><strong><FONT COLOR="38C5FC">Navigation Requests</strong></FONT><FONT COLOR ="FFFFFF"> header. </FONT></p>
					<a href="#" data-role="button" data-rel="back" data-theme="c">Close</a>    
				</div>
			</div>
			
            <div data-role="content">
				<a href="searchDest.php" data-theme="b" data-ajax="false" data-position-to="window" data-role="button"  data-transition="flow">Start New Navigation</a>
				<h3>Navigation Requests:</h3>
				<ul data-role="listview" data-inset="true">
					<li><a href="nav_overview.php">Tom Rowe invited you to Union Square</a></li>
					<li><a href="nav_overview.php">Jenna Smith invited you to Ike's Lair</a></li>
				</ul>
				
            </div>
        </div>
        <script>
            /* On page load, get geolocation and create map */
						$(document).bind('pageinit',function(event){
							var user = localStorage.getItem('username');
							//alert(user);
							if(!user) $.mobile.changePage("login.php");
						});
        </script>
    </body>
</html>