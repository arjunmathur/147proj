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
                <a href="#" id="logout" data-theme="b" data-icon="arrow-l">Log Out</a>
				<h1>GrouPS</h1>
				<a href="#help" data-rel="popup" data-theme="c" data-transition="flow" data-icon="info">Help</a>
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
			
			<div data-role="popup" id="respond" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>GrouPS Request</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">Would you like to join this group navigation?</h3>
					<fieldset class="ui-grid-a">
						<div class="ui-block-a" ><a class="accept" data-role="button" id="acceptbutton" data-theme="b">Accept</a></div>
						<div class="ui-block-b"><a class="deny" href="#" data-role="button" data-theme="c">Deny</a></div> 
					</fieldset>
				</div>
			</div>
			
            <div data-role="content">
            	<h3 style="text-align: center;"><span id="status">""</span></h3>
				<a id="searchDestLink" href="searchDest.php" data-theme="b" data-ajax="false" data-position-to="window" data-role="button"  data-transition="flow">Start New Navigation</a>
				<h4>Navigation Invitations:</h4>
				<ul data-role="listview" class="invitationList" data-inset="true">
					
				</ul>
				
            </div>
            
            <script type="text/javascript">
				var trip;
	           	$("#logout").click(function(){
	            	localStorage.removeItem('username');
					window.clearTimeout(t);
	            	$.mobile.changePage("login.php");	
	            });
				
				$(document).bind('pageinit',function(event){
					var user = localStorage.getItem('username');
					if(!user) $.mobile.changePage("login.php");
					
					$('#status').html("Welcome, "+localStorage.getItem('username')+".");
					
					$(".accept").bind("click", function(){
						$.post("acceptInvitation.php", {username: localStorage.getItem('username'), trip_id: trip}, function(data){
							window.clearTimeout(t);
							event.preventDefault();
							window.location.assign("show_replies.php");	
						});
					});
					$(".deny").bind("click", function(){
						$.post("denyInvitation.php", {username: localStorage.getItem('username'), trip_id: trip}, function(data){
							$.mobile.changePage("#");
						});
					});
				});
				
				
				
				$(document).ready(function(){
					$('#searchDestLink').click(function(event){
						window.clearTimeout(t);
						event.preventDefault();
						window.location.assign($(this).attr('href'));
					});
				});
				
				
				function timedCount()
				{ 
					updateInvitations();
					t=setTimeout("timedCount()",1000);
				}
				function updateInvitations(){
					$.post("refreshInvitations.php", {username: localStorage.getItem('username')}, function(data) {
						$('.invitationList').children().remove();
						$('.invitationList').append(data);
						$('.invitationList').listview('refresh');
						$(".trip").bind("click", function(){
							trip = $(this).attr("data-trip");
						});
					});
					
					
				}

				// Kick off the timer
				t=setTimeout("timedCount()",1000);
				
           </script> 
           
        </div>
    </body>
</html>