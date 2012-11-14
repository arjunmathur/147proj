<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Wait Replies</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="waitReplies" data-theme="a">
            <div data-theme="a" data-role="header">
                <a href="#confirmCancel" data-rel="popup" data-role="button"  data-transition="flow" data-icon="back">Back</a>
				<h1>GrouPS</h1>
            </div>
            
            <div data-role="popup" id="confirmCancel" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="e" class="ui-corner-top">
					<h1>Confirm</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">Are you sure you'd like to leave group navigation?</h3>
					<p>Your invited friends will be notified that you are no longer navigating.</p>
					<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Return</a>    
					<a href="index.php" data-ajax="false" data-role="button" data-inline="true"  data-transition="flip" data-theme="b">Leave Group</a>  
				</div>
			</div>
			
			<div data-role="popup" id="confirmStart" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Confirm</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">Would you like continue?</h3>
					<p>People who haven't joined will not be able to join after you start.</p>
					<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancel</a>    
					<a href="nav_overview.php" data-role="button" data-inline="true"  data-transition="slide" data-theme="b">Continue</a>  
				</div>
			</div>
			
            <div data-role="content">
				<a href="#confirmStart" data-theme="b" data-rel="popup" data-position-to="window" data-role="button"  data-transition="flow">Calculate Group Navigation</a>
				<h3> Accepted: </h3>
				<ul data-role="listview" class="acceptedList" data-inset="false" data-theme="b" data-mini=true>
					
				</ul>
				<h3> Waiting For Reply: </h3>
				<ul data-role="listview" class="waitingList" data-inset="false" data-theme="e" data-mini=true>
					
				</ul>
				<h3> Denied: </h3>
				<ul data-role="listview" class="deniedList" data-inset="false" data-mini=true>
					
				</ul>
            </div>
			<script type="text/javascript">
				
				function timedCount()
				{ 
					refreshWaiting();
					refreshAccepted();
					//refreshDenied();
					t=setTimeout("timedCount()",1000);
				}
				
				function refreshWaiting()
				{
						$('.waitingList').children().remove();
						<?php 
							include("config.php");
							$query = "SELECT * FROM trip_participants WHERE (trip_id = ".$_GET["trip_id"]." AND STATUS=0)";
							$result = mysql_query($query);
							while($row = mysql_fetch_assoc($result)){
						?>
								//alert("alert!");
								$('.waitingList').append("<li><?=$row['username']?></li>");
								$('.waitingList').listview('refresh');
						<?php
							}
						?>
				}
				
				function refreshAccepted()
				{		
						$('.acceptedList').children().remove();
						<?php 
							include("config.php");
							$query = "SELECT * FROM trip_participants WHERE (trip_id = ".$_GET["trip_id"]." AND STATUS=1)";
							$result = mysql_query($query);
							while($row = mysql_fetch_assoc($result)){
						?>
								//alert('yolo');
								$('.acceptedList').append("<li><?=$row['username']?></li>");
								$('.acceptedList').listview('refresh');
						<?php
							}
						?>
				}
				
				// Kick off the timer
				t=setTimeout("timedCount()",1000);
			</script>
        </div>
        
    </body>
</html>