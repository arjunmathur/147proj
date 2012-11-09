<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Group Status</title>
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
                <a href="navigation.php" data-theme="b" data-transition="flip" data-icon="arrow-l">Back</a>
				<h1>GrouPS</h1>
            </div>
            
            
            <div data-role="content">
				
				<h2>My Group's Status</h2>
				<ol data-role="listview" data-inset="true">
					<li>
						<h3>Andy Elder</h3>
						<p class="ui-li-aside"><strong>7 Minutes Ahead</strong></p>
						<p><strong>Enroute.   </strong>15 Miles (32 Minutes)</p>
					</li>
					<li>
						<h3><FONT COLOR="38C5FC">Kevin Ho (You)</FONT></h3>
						<p class="ui-li-aside"><strong>On Time</strong></p>
						<p><strong>Enroute.   </strong>7 Miles (15 Minutes)</p>
					</li>
					<li>
						<h3>Stephanie Harris</h3>
						<p class="ui-li-aside"><strong>5 Minutes Behind</strong></p>
						<p><strong>Enroute.   </strong>4 Miles (8 Minutes)</p>
					</li>
					<li>
						<h3>Jason Armstrong</h3>
						<p class="ui-li-aside"><strong>Waiting to Leave</strong></p>
						<p><strong>Waiting to Leave.   </strong>2 Miles (5 Minutes)</p>
					</li>
				</ol>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>