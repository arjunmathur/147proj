<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Group Navigation Overview</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		
    </head>
    <body>
        <div data-role="page" id="nav_overview" data-theme="a">
            <div data-theme="a" data-role="header">
                <a href="#confirmCancel" data-rel="popup" data-theme="c" data-transition="flow" data-icon="delete">Cancel</a>
				<h1>GrouPS</h1>
            </div>
            
            <div data-role="popup" id="confirmCancel" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="e" class="ui-corner-top">
					<h1>Confirm</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">Are you sure you'd like to leave group navigation?</h3>
					<p>Your invited friends will be notifed that you are no longer navigating.</p>
					<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Return</a>    
					<a href="index.php" data-ajax="false" data-role="button" data-inline="true"  data-transition="flip" data-theme="b">Leave Group</a>  
				</div>
			</div>
			
			<div data-role="popup" id="startEarly" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Confirm</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">Start early?</h3>
					<p>You still have 15 minutes to leave. Do you want to start early?</p>
					<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancel</a>    
					<a href="navigation.php" data-ajax="false" data-role="button" data-inline="true"  data-transition="slide" data-theme="b">Start Navigation</a>  
				</div>
			</div>
			
			
			
            <div data-role="content">
				<a href="#startEarly" data-theme="b" data-rel="popup" data-position-to="window" data-role="button"  data-transition="flow">Start</a>
				<h2>Leave in: 15 minutes</h2>
				<ol data-role="listview" data-inset="true">
					<li>
						<h3>Andy Elder</h3>
						<p class="ui-li-aside"><strong>15 Minutes Behind</strong></p>
						<p><strong>Travelling to destination: 15 mi/30 min</strong></p>
						<p>Andy is currently 15 Minutes	behind</p>
					</li>
					<li>
						<h3><FONT COLOR="38C5FC">Kevin Ho (You)</FONT></h3>
						<p><strong>Waiting. 7 mi/15 min</strong></p>
						<p>Waiting for 15 minutes.</p>
					</li>
					<li>
						<h3>Stephanie Harris</h3>
						<p><strong>Waiting. 4 mi/8 min</strong></p>
						<p>Waiting for 22 minutes.</p>
					</li>
					<li>
						<h3>Jason Armstrong</h3>
						<p><strong>Waiting. 2 mi/5 min</strong></p>
						<p>Waiting for 25 minutes.</p>
					</li>
				</ol>
            </div>
			<script type = "text/javascript">
				$(document).bind('pageinit',function(event){		
					$.post("getDest.php", {username: localStorage.getItem('username')}, function(data) {
							destLat = data.lat;
							destLng = data.lng;
					}, "json");
						
				});
			</script>
        </div>
       
    </body>
</html>