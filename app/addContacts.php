<!DOCTYPE html>
<html>
    <head>
        <title>Add Contacts</title>
		<meta charset="utf-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="addContacts" data-theme="a">
            <div data-theme="a" data-role="header">
                <a href="index.html" data-icon="home">back</a>
				<h1>GrouPS</h1>
				<a href="wait_replies.html" data-icon="arrow-r">Invite</a>
            </div>
            <div data-role="content">
				<script type="text/javascript"> var retrievedObject = localStorage.getItem('username'); </script>
				
				<label for="addedList"> Added: </h3>
				<ul data-role="listview" data-inset="true" class="addedList"></ul>
				<div data-role="collapsible">
					<h3> Add Friends for Navigation </h3>
					<ul data-role="listview" data-inset="false" data-filter="true" data-autodividers="true" class="contacts">
						<?php
							include("config.php");
							$query = "SELECT * FROM contacts WHERE user = \"test\" ORDER BY user_contact ASC";
							$result = mysql_query($query);
							while($row = mysql_fetch_assoc($result)){
								$contactName = $row["user_contact"];
								echo "<li onclick = \"add(this)\"><a>$contactName</a></li>";
							}
						?>
					</ul>
				</div>
				
            </div>
        </div>
        <script>
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
    </body>
</html>