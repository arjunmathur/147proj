<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Group Status</title>
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
                <a href="navigation.php" data-theme="b" data-transition="flip" data-icon="arrow-l">Back</a>
				<h1>GrouPS</h1>
            </div>
            
            
            <div data-role="content">
				
				<h2>My Group's Status</h2>
				<ol class="statusList" data-role="listview" data-inset="true">
				</ol>
				<script type="text/javascript">
		            function updateLists(){
							
							$.post("getGroupStatus.php", {username: localStorage.getItem('username')}, function(data) {
								$('.statusList').children().remove();
								$('.statusList').append(data.listData);
								$('.statusList').listview('refresh');
							}, "json");	
						}
						
						
						function timedCount(){
							
							updateLists();
							t=setTimeout("timedCount()",1000);
						}
						
						t=setTimeout("timedCount()",1000);
		        </script>

				
            </div>
        </div>
      </body>
</html>