<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Add Contacts</title>
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
        <!-- Home -->
        <div data-role="page" id="addContacts" data-theme="a">
            <div data-theme="a" data-role="header">
                <a data-rel="back" data-icon="arrow-l">back</a>
				<h1>GrouPS</h1>
				<a href="#" id="inviteButton"  data-transition="slide" data-icon="arrow-r">Invite</a>
            </div>
            <div data-role="content">
					<h3 style="text-align: center;"><FONT COLOR="38C5FC"><span id="status">""</span></FONT></h3>
					<label for="addedList"> Added: </label>
					<div data-role="collapsible" data-collapsed="false" >
						<h3> Added Friends </h3>
						<ul data-role="listview" data-inset="false" class="addedList"></ul>
					</div>
					<div data-role="collapsible" data-collapsed="false" >
						<h3> Add Friends for Navigation </h3>
						<ul data-role="listview" data-inset="false" data-filter="true" data-autodividers="true" class="contacts">
							
						</ul>
					</div>
            </div>
			<script type="text/javascript">
			$(document).bind('pageinit',function(event){
				$.post("getContacts.php", {username: localStorage.getItem('username')}, function(data) {
					$('.contacts').append(data);
					$('.contacts').listview('refresh');
				});
				
				$('#status').html(""+localStorage.getItem('dest'));
				
			});
			$("#inviteButton").click(function(){
				var toAdd = $('.addedList').children();
				if(toAdd.length == 0){
					alert("Please click on friends to invite");
					return;
				}
				var username = localStorage.getItem('username');
				var trip_id;
				for (var i = 0; i < toAdd.length; i++){
					$.post("submitFriends.php", {username: username, toAdd:toAdd[i].getAttribute('value')}, function(data) {
						if(i == toAdd.length){
							trip_id = data.trip_id;
							event.preventDefault();
							window.location.assign("wait_replies.php");
						}
					}, "json");
				}
				
	         });
	         
	         
	         $(document).ready(function(){
		         $('#newFriendsLink').click(function(event){
		       		 event.preventDefault();
		      		 window.location.assign("addNewContacts.php");
		  		  });
		  		  
	         });
			
			
			function sortContacts() {
			  var lis = $('.contacts').children();
			  var vals = [];
				
			  // Populate the array
			  for(var i = 0, l = lis.length; i < l; i++)
				vals.push(lis[i].innerHTML);

			  // Sort it
			  vals.sort();

			  // Change the list on the page
			  for(var i = 0; i < lis.length; i++)
				lis[i].innerHTML = vals[i]; 
			}
						
			function add(toAdd){
				var x = $(toAdd).clone();
				$(toAdd).remove(); // Hide it
				$(x).attr("onclick", "remove(this)");
				$('.addedList').append(x); // Add it to the second list
				 $('.contacts').listview('refresh');
				 $('.addedList').listview('refresh');
			}
			
			function remove(toRemove){
				
				var x = $(toRemove).clone();
				$(toRemove).remove(); // Hide it
				$(x).attr("onclick", "add(this)");
				$('.contacts').append(x); // Add it to the first list
				//sortContacts();
				 $('.addedList').listview('refresh');
				 $('.contacts').listview('refresh');
			}
			</script>
			<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false">
				<div data-role="navbar" class="nav" data-grid="a" data-mini="true">
				<ul>
					<li><a href="#" id="addFriends" data-icon="plus" class="ui-btn-active ui-state-persist">Add Friends</a></li>
					<li><a id="newFriendsLink" data-icon="search" >Search New Friends</a></li>
					
				</ul>
				</div>
			</div>
        </div>
        
    </body>
</html>