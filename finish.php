<!DOCTYPE html>
<html>
    <head>
        <title>GrouPS | Arrived</title>
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
        <div data-role="page" id="finish" data-theme="a">
            <div data-theme="a" data-role="header">
				<h1>GrouPS</h1>
            </div>
            
            
            <div data-role="content">
				
				<h3 style="text-align: center;"><span id="arrived_info">""</span></h3>
				<ol class="statusList" data-role="listview" data-inset="true">
				</ol>
				<script type="text/javascript">
					$(document).bind('pageinit',function(event){
						$('#arrived_info').html("Arrived at "+localStorage.getItem('dest')+".");
						$.post("update_nav.php", {username: localStorage.getItem('username'), status: 2});
						
						$("#return").click(function(){
			            	localStorage.removeItem('dest');
							window.clearTimeout(t);
			            	window.location.assign("index.php");	
			            });
					
					
					});
				
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
		       	<a id="return" data-role="button" data-theme="c">Return to Main Menu</a>

				
            </div>
        </div>
      </body>
</html>