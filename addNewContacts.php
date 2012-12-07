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
                <a href="searchDest.php" data-icon="home">back</a>
				<h1>GrouPS</h1>
            </div>
            <div data-role="content">
					
				<input type="search"  id="searchBox" placeholder=" Enter a Friend's Username" value="" />
				<a id="addButton" data-theme="b" data-role="button" >Add</a>
				<script type="text/javascript">
					$("#searchBox").live("change", function(event, ui) {
						
					});
					$("#addButton").click(function(){
							$.post("findUser.php", {username: localStorage.getItem('username'), search_username: 
						document.getElementById("searchBox").value}, function(data) {
								if(data != document.getElementById("searchBox").value)
									alert(data);
								else alert(data+" was added to your contacts!");
						});
					 });
					 
				</script>
				<div data-role="footer" data-id="samebar" data-position="fixed" data-tap-toggle="false">
					<div data-role="navbar" class="nav" data-grid="a">
						<ul>
							<li><a id="addFriends" data-rel="back" data-icon="plus" >Add Friends</a></li>
							<li><a id="newFriendsLink" href="#" id="searchNewFriends" data-icon="search" class="ui-btn-active ui-state-persist">Search New Friends</a></li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>