<!DOCTYPE html>
<html>
	<head>
		<title>GrouPS | Search Destination</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		
		<link rel="stylesheet" href="gmaps.css" type='text/css'/>
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  		
	</head>	
	
	<body>
		<div data-role="page" data-theme="a" id="home" style="width:100%; height:100%;">
			<div data-role="header">
				<a href="settings.php" data-icon="gear" >Settings</a>
				<h1>GrouPS</h1>
				<a href="addContacts.php" data-ajax="false" data-icon="arrow-r" data-transition="slide" class="ui-btn-right">Add Friends</a>
			</div>
			
			<div data-role="content" style="width:100%; height:100%; padding:0;"> 

				<section id="wrapper" style="width:100%; height:100%;">
					<label for="searchbar"></label>
					<input type="search" name="searchbar" id="searchbar" placeholder=" Address or Destination" value=""  />
					
					<article>
					  <p><span id="status">Locating...</span></p>
					  <div id="map"></div>
					</article>
					
					<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
  					<script type="text/javascript" src="https://raw.github.com/HPNeo/gmaps/master/gmaps.js"></script>
  					
					
					<script type="text/javascript">
						var service; var map; var searchBox; var latlng; var placesArray = []; var myLat; var myLng; var bluedot; var custompin; var custompinshadow;
						
						$(window).bind( 'orientationchange', function(e){
						    if ($.event.special.orientationchange.orientation() == "portrait") {
						        mapcanvas.style.height = '355px'; //TODO: how to make 100%
						  		mapcanvas.style.width = '320px';
						    } else {
						        mapcanvas.style.height = '200px'; //TODO: how to make 100%
						  		mapcanvas.style.width = '480px';
						    }
						});
						
						/* On page load, get geolocation and create map */
						$(document).bind('pageinit',function(event){
							var user = localStorage.getItem('username');
							if(!user) $.mobile.changePage("login.php");
						  if (navigator.geolocation) {
							navigator.geolocation.getCurrentPosition(success, error, {timeout:10000});
							} else {
							error('not supported');
						}
						});
						
						/* On search enter, search for places and put markers */
						$("#searchbar").live("change", function(event, ui) {
							$('#map').focus();
							map.removeMarkers();
							search();
     					 	 map.addMarker({
						  		lat: myLat,
  								lng: myLng,
  								icon: bluedot,
  								title: "You are here!",
								});
							
							return true;
							});
							
						function search() {
							
							var request = {
								location: latlng,
								radius: '1000',
								query: document.getElementById("searchbar").value
							};
							service.textSearch(request, pinSearchResults);
							
						}
							
							
						function pinSearchResults(results, status) {
							placesArray = [];
							var bounds = new google.maps.LatLngBounds();
						  if (status == google.maps.places.PlacesServiceStatus.OK) {
							for (var i = 0; i < results.length; i++) {
							  var place = results[i];
							  placesArray.push(place);
							  var html = '<FONT COLOR="004FA3"><p><strong>' + 
  									place.name + 
  									'</strong></p><p>' + 
  									place.formatted_address + 
  									'</p></FONT>' + 
                 					"<tr><td></td><td><input type='button' value='Navigate Here' onclick='foundDest(" + i + ")'/></td></tr>";
							  
							  map.addMarker({
							  	animation: google.maps.Animation.DROP,
  							  	lat: place.geometry.location.lat(),
 							  	lng: place.geometry.location.lng(),
 							  	icon: custompin,
  								shadow: custompinshadow,
							  	title: place.name,
							  	infoWindow: {
  									content: html
								}
							  });
							  	
								bounds.extend(place.geometry.location);
								
							}
							 map.fitBounds(bounds);
						  }
						}
							
						
						function foundDest(placesIndex){
							var place = placesArray[placesIndex];
							var destName = place.name;
							var destAddr = place.formatted_address;
							var destLat = place.geometry.location.lat();
							var destLng = place.geometry.location.lng();
							$.post("submitDest.php", {destName: destName, destAddr: destAddr, destLat:destLat, destLng:destLng, user: "test"}, function(data) {
				
							});
							
							$.mobile.changePage("addContacts.php", {reloadPage: true});
						}
						
						
						
						function success(position) {
						  
						  $('#status').html("");
						 latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
						 myLat = position.coords.latitude;
						 myLng = position.coords.longitude;
						  
						 var mapcanvas = document.createElement('div');
						  mapcanvas.id = 'mapcanvas';
						  mapcanvas.style.height = '355px'; //TODO: how to make 100%
						  mapcanvas.style.width = '320px';
							
						  $('article').append(mapcanvas);
						  
						  map = new GMaps({
        				   div: '#mapcanvas',
       					   lat: position.coords.latitude,
      					   lng: position.coords.longitude
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
							
							
     					  
     					  map.addMarker({
						  		lat: myLat,
  								lng: myLng,
  								icon: bluedot,
  								title: "You are here!",
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