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
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
		<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
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
					<a id="indexLink" data-role="button" data-inline="true"  data-transition="flip" data-theme="b">Leave Group</a>  
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
					<a href="navigation.php" data-role="button" data-inline="true"  data-transition="slide" data-theme="b">Start Navigation</a>  
				</div>
			</div>
			
			
			
			
			
            <div data-role="content">
            	<h3 style="text-align: center;"><FONT COLOR="38C5FC"><span id="status">""</span></FONT></h3>
				<a data-theme="b" id="start" data-position-to="window" data-role="button"  data-transition="flow">Start</a>
				<div class="leaveIn"></div>
				<ol class="overviewList" data-role="listview" data-inset="true">
				</ol>
            </div>
			<script type = "text/javascript">
				$(document).bind('pageinit',function(event){
					$.post("update_nav.php", {username: localStorage.getItem('username'), status: 0});
					
					$('#start').click(function(event){
						window.clearTimeout(t);
	      				window.location.assign("navigation.php");
	   				 });
	   				 
	   				 $('#indexLink').click(function(event){
						window.clearTimeout(t);
	      				window.location.assign("index.php");
	   				 });
				
					$('#status').html(""+localStorage.getItem('dest'));
					
				});
				
				function updateLists(){
					
					$.post("getNavOverview.php", {username: localStorage.getItem('username')}, function(data) {
						$('.overviewList').children().remove();
						var minutes = data.leaveTime/60;
						minutes = Math.round(minutes);
						if(minutes == 0){
							$('.leaveIn').html("<h2>Leave now</h2>");
						}else{
							$('.leaveIn').html("<h2>Leave in "+minutes+" minutes");
						}
						$('.overviewList').append(data.listData);
						$('.overviewList').listview('refresh');
					}, "json");	
				}
				
				
				function timedCount(){
					updateLists();
					t=setTimeout("timedCount()",1000);
				}
				
				t=setTimeout("timedCount()",1000);
				
			</script>
        </div>
       
    </body>
</html>