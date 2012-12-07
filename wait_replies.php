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
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
		<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    </head>
    <body>
        <div data-role="page" id="waitReplies" data-theme="a">
            <div data-theme="a" data-role="header">
                <a href="#confirmCancel" data-rel="popup" data-role="button"  data-transition="flow" data-icon="delete">Cancel</a>
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
					<a class="confirmCancelButton" data-ajax="false" data-role="button" data-inline="true"  data-transition="flip" data-theme="b">Leave Group</a>  
				</div>
				<script type="text/javascript">
					$('.confirmCancelButton').click(function(){
						$.post("updateInviteStatus.php", {username: localStorage.getItem('username'), status: 2}, function(){
								event.preventDefault();
								window.location.assign("index.php");	
						});
					});
				</script>
			</div>
			
			<div data-role="popup" id="confirmStart" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="a" class="ui-corner-top">
					<h1>Confirm</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">Would you like continue?</h3>
					<p>People who haven't joined will not be able to join after you start.</p>
					<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancel</a>    
					<a id="NavOverviewLink" data-role="button" data-inline="true" data-theme="b">Continue</a>  
				</div>
			</div>
			
            <div data-role="content">
				<a href="#confirmStart" data-theme="b" data-rel="popup" data-position-to="window" data-role="button"  data-transition="flow">Calculate Group Navigation</a>
				<h3 id="acceptedHeader"> Accepted: </h3>
				<ul data-role="listview" class="acceptedList" data-inset="false" data-theme="b" data-mini=true>
					
				</ul>
				<h3 id="waitingHeader"> Waiting For Reply: </h3>
				<ul data-role="listview" class="waitingList" data-inset="false" data-theme="e" data-mini=true>
					
				</ul>
				<h3 id="deniedHeader"> Denied: </h3>
				<ul data-role="listview" class="deniedList" data-inset="false" data-mini=true>
					
				</ul>
            </div>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            
			<script type="text/javascript">
			var myLat; var myLng; var destLat; var destLng; var destLatLng; var tripId; var destlatlng;
			
				$(document).bind('pageinit',function(event){
					$.post("getDest.php", {username: localStorage.getItem('username')}, function(data) {
						tripId = data.tripId;
					}, "json");
					
					$('#NavOverviewLink').bind("click", function(){
		      		 	sendInfo();
					});
					
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(success, error, {timeout:10000});
					} else {error('not supported');}
					
				});
				function success(position){	
					myLat = position.coords.latitude;
					myLng = position.coords.longitude;		
				}
				
				function sendInfo(){
					$.post("getDest.php", {username: localStorage.getItem('username')}, function(data) {
						
						destLat = data.lat;
						destLng = data.lng;
						tripId = data.tripId;
						destlatlng = new google.maps.LatLng(destLat, destLng);
						var matrixService = new google.maps.DistanceMatrixService();
						var checkLatLng = new google.maps.LatLng(myLat, myLng);
						matrixService.getDistanceMatrix(
						  {
							origins: [checkLatLng],
							destinations: [destlatlng],
							travelMode: google.maps.TravelMode.DRIVING,
							unitSystem: google.maps.UnitSystem.IMPERIAL,
							avoidHighways: false,
							avoidTolls: false
						  }, callback);
					}, "json");
					
					
					
				}
								
				function callback(response, status) {
				    if (status == google.maps.DistanceMatrixStatus.OK) {
						var results = response.rows[0].elements;
						var element = results[0];
						var destDistance = element.distance.text; //This is the line having a problem with web app iOS
						var destDuration = element.duration.text;
						var destDistanceValue = element.distance.value;	
						var destDurationValue = element.duration.value;
						$.post("submitDistance.php", {username: localStorage.getItem('username'), time: destDuration, distance: destDistance, time_value: destDurationValue, dist_value: destDistanceValue}, function(data){
							window.clearTimeout(t);
						//event.preventDefault();
							
							window.location.assign("nav_overview.php");	
						});  		    
					}
				  else{
				  	alert("Distance and estimated time could not be found.");	
				  }
				  
				}
				
				
				function timedCount()
				{ 
					updateLists();
					t=setTimeout("timedCount()",1000);
				}
				
				function updateLists(){
					$.post("refreshReplies.php", {trip_id: tripId}, function(data) {
						$('.waitingList').children().remove();
						$('.acceptedList').children().remove();
						$('.deniedList').children().remove();
						
						$('.waitingList').append(data.waiting);
						$('.acceptedList').append(data.accepted);
						$('.deniedList').append(data.denied);
						
						if($('.waitingList').children().size() < 1) 
							$('#waitingHeader').hide();
						else $('#waitingHeader').show();
						if($('.acceptedList').children().size() < 1)
							$('#acceptedHeader').hide();
						else $('#acceptedHeader').show();
						if($('.deniedList').children().size() < 1)
							$('#deniedHeader').hide();
						else $('#deniedHeader').show();
							
						$('.waitingList').listview('refresh');
						$('.acceptedList').listview('refresh');
						$('.deniedList').listview('refresh');
					}, "json");
				}
				
				function error(msg) {
						  var s = document.querySelector('#status');
						  s.innerHTML = typeof msg == 'string' ? msg : "failed";
						  s.className = 'fail';
				}

				// Kick off the timer
				t=setTimeout("timedCount()",1000);
			</script>
        </div>
        
    </body>
</html>