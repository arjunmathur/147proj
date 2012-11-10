<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Navigation</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<link rel="stylesheet" href="gmaps.css" type='text/css'/>
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
		
    </head>
    <body>
        <div data-role="page" id="navigation" data-theme="a">
            <div data-theme="a" data-role="header">
                <a href="#confirmCancel" data-rel="popup" data-theme="c" data-transition="flow" data-icon="delete">Cancel</a>
				<h1>GrouPS</h1>
				<a href="groupStatus.php" data-theme="b" data-transition="flip" data-icon="info">Group Status</a>
            </div>
            
			
			<div data-role="popup" id="confirmCancel" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
				<div data-role="header" data-theme="e" class="ui-corner-top">
					<h1>Confirm</h1>
				</div>
				<div data-role="content" data-theme="a" class="ui-corner-bottom ui-content">
					<h3 class="ui-title">Are you sure you'd like to leave group navigation?</h3>
					<p>Your invited friends will be notifed that you are no longer navigating.</p>
					<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Return</a>    
					<a href="index.php" data-role="button" data-ajax="false" data-inline="true"  data-transition="flip" data-theme="b">Leave Group</a>  
				</div>
			</div>
			
			<div data-role="content" style="width:100%; height:100%; padding:0;"> 


				<section id="wrapper" style="width:100%; height:100%;">
					<fieldset class="ui-grid-a">
						<div class="ui-block-a"><button id="prev" data-icon= "arrow-l" data-mini="true" type="submit" data-theme="b">Prev</button></div>
						<div class="ui-block-b"><button id="next" data-icon="arrow-r" data-iconpos="right" data-mini="true" type="submit" data-theme="b">Next</button></div>	   
					</fieldset>
					<p><span id="stepinstruction" align="center">Tap Next to Begin</span></p>
					<article>
					  <p><span id="status">Locating...</span></p>
					  <div id="instructions"></div>
					  <div id="map"></div>
					</article>
					<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  					<script type="text/javascript" src="https://raw.github.com/HPNeo/gmaps/master/gmaps.js"></script>
  					<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
					
					<script type="text/javascript">
						var service; var map; var mapcanvas; var latlng; var markersArray = []; var myLat; var myLng; var bluedot; var custompin; var custompinshadow; var destLat; var destLng;
		
						
						$(window).bind( 'orientationchange', function(e){

						    if ($.event.special.orientationchange.orientation() == "portrait") {
						        mapcanvas.style.height = '355px'; //TODO: how to make 100%
						  		mapcanvas.style.width = '320px';
						    } else {
						        mapcanvas.style.height = '200px'; //TODO: how to make 100%
						  		mapcanvas.style.width = '480px';
						    }
						});
												
						
						$(document).bind('pageinit',function(event){
							navigator.geolocation.getCurrentPosition(success, error);
												
				            $.post("getDest.php", {username: localStorage.getItem('username')}, function(data) {
				            		destLat = data.lat;
				            		destLng = data.lng;
				            	
											}, "json");
											
							var watchId = navigator.geolocation.watchPosition(updateLocation);
								
						});
						
						function updateLocation(position){
							
							map.removeMarkers();
							
							map.addMarker({
						  		lat: destLat,
  								lng: destLng, //Union Square dummy data
  								icon: custompin,
  								shadow: custompinshadow,
  								title: "Destination",
								});
							
							
							map.addMarker({
						  		lat: position.coords.latitude,
  								lng: position.coords.longitude,
  								icon: bluedot,
  								title: "You are here!",
								});
							
						}
						
						function success(position) {
						  
						  $('#status').html("");
						  
						 latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
						 myLat = position.coords.latitude;
						 myLng = position.coords.longitude;
						  
						 mapcanvas = document.createElement('div');
						  mapcanvas.id = 'mapcanvas';
						  mapcanvas.style.height = '355px'; 
						  mapcanvas.style.width = '320px';
						 
						  $('article').append(mapcanvas);
						  
						  map = new GMaps({
        				   div: '#mapcanvas',
       					   lat: myLat,
      					   lng: myLng
     					  });
     					  service = new google.maps.places.PlacesService(map.map);
 
	     					  custompin = new google.maps.MarkerImage(
	  							'custompin.png',
	  							 new google.maps.Size(20,34),
	  							 new google.maps.Point(0,0),
	 							 new google.maps.Point(10,34)
								);
	
							   custompinshadow = new google.maps.MarkerImage(
	 							 'custompinshadow.png',
	  							  new google.maps.Size(40,34),
	 							  new google.maps.Point(0,0),
	 							  new google.maps.Point(10,34)
							  );
	     					  
	     					  bluedot = new google.maps.MarkerImage(
								'bluedot.png',
								null, // size
								null, // origin
								new google.maps.Point( 8, 8 ), // anchor (move to center of marker)
								new google.maps.Size( 17, 17 ) // scaled size (required for Retina display icon)
								);
								
						google.maps.event.addListener(map.map, 'idle', function() {
							
	
								
							map.drawRoute({
								origin:[myLat, myLng],
								destination:[destLat, destLng],
								travelMode: 'driving',
								strokeColor: '#00AAFF',
								strokeOpacity: 0.6,
								strokeWeight: 8
							});
							
							var bounds = new google.maps.LatLngBounds();
							mylatlng = new google.maps.LatLng(myLat, myLng);
							destlatlng = new google.maps.LatLng(destLat, destLng);
							bounds.extend(mylatlng);
							bounds.extend(destlatlng);
							map.fitBounds(bounds);
									
							map.getRoutes({
					          origin: [myLat, myLng],
					          destination: [destLat, destLng], 
					          travelMode: 'driving',
					          callback: function(e){
					            route = new GMaps.Route({
					              map: map,
					              route: e[0],
					              strokeColor: '#1A235E',
					              strokeOpacity: 0.6,
					              strokeWeight: 8
					            });
					          }
					        });
									
									
							google.maps.event.clearListeners(map.map, 'idle');
							$('#next').click(function(e){
							
							  map.setZoom(16);
								
					          e.preventDefault();
					          route.forward();
					         
					          if(route.step_count < route.steps_length){
					          	$("#stepinstruction").html(""+route.steps[route.step_count].instructions);    	
					         	 map.map.setCenter(new google.maps.LatLng( route.steps[route.step_count-1].end_location.lat(),  route.steps[route.step_count-1].end_location.lng()));
					          } else {
					          	
					          	map.map.setCenter(new google.maps.LatLng(destLat,destLng));
					          }
					          
					        });
					        
					        $('#prev').click(function(e){
					          e.preventDefault();
					          route.back();
					
					          if(route.step_count >= 0){
					          	$("#stepinstruction").html(""+route.steps[route.step_count-1].instructions);
					          	map.map.setCenter(new google.maps.LatLng( route.steps[route.step_count-1].end_location.lat(),  route.steps[route.step_count-1].end_location.lng()));
					          }
					        });
				        
				        });
				      
								
							
						}
						
						function error(msg) {
						  var s = document.querySelector('#status');
						  s.innerHTML = typeof msg == 'string' ? msg : "failed";
						  s.className = 'fail';
						}
						
						
					</script>
				</section>	
			</div>
			
			
			
        </div>
    </body>
</html>