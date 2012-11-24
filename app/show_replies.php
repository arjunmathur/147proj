<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Show Replies</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="showReplies" data-theme="a">
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
			
            <div data-role="content">
            	<h4>Please wait while group members respond.</h4>
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
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
			<script type="text/javascript">
			var myLat; var myLng; var destLat; var destLng; var destLatLng; var tripId; var destlatlng;
			
				$(document).bind('pageinit',function(event){
					
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(success, error, {timeout:10000});
					} else {
							error('not supported');
					}
					

								
				});
				
				function success(position){
					
					myLat = position.coords.latitude;
					myLng = position.coords.longitude;
										
					$.post("getDest.php", {username: localStorage.getItem('username')}, function(data) {
						destLat = data.lat;
						destLng = data.lng;
						tripId = data.tripId;
						localStorage.setItem('dest', data.name);
						
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
				    var destDistance = element.distance.text;
				    var destDuration = element.duration.text;
				    var destDistanceValue = element.distance.value;
				    var destDurationValue = element.duration.value;
				    $.post("submitDistance.php", {username: localStorage.getItem('username'), time: destDuration, distance: destDistance, time_value: destDurationValue, dist_value: destDistanceValue}); 		    
				}
				  else{
				  	alert("Distance and estimated time could not be found.");	
				  }
				}
				
				
				function timedCount()
				{ 
					$.post("check_redirect.php", {trip_id: tripId}, function(data) {
						if(data){
							window.clearTimeout(t);
							$.mobile.changePage("nav_overview.php");
						}
						
					});
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