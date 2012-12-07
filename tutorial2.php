<!DOCTYPE html> 
<html>

<head>
	<title>GrouPS | Tutorial</title> 
	<meta charset="utf-8">
	<link rel="apple-touch-startup-image" href="startup.png">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

</head>  
<body> 

<div data-role="page" style="background: transparent url('tutorial2.png') no-repeat;" data-theme="a">

	<div data-role="header">
	<h1>Tutorial 2 of 3</h1>
	</div><!-- /header -->

	<div data-role="content">

		<fieldset class="ui-grid-a">
			<div class="ui-block-a" id="skip"><button data-icon= "arrow-l" data-mini="true" data-theme="b">Back</button></div>
			<div class="ui-block-b" id="next"><button data-icon="arrow-r" data-mini="true" data-iconpos="right" data-theme="b">Next</button></div>	   
		</fieldset>
	 
	</div><!-- /content -->

    
	<script type="text/javascript">
	
	$(document).bind('pageinit',function(event){
		//if(localStorage.getItem("username") != "") $.mobile.changePage("index.php");
	});
	
	$(document).ready(function(){
	    $('#skip').click(function(event){
	        event.preventDefault();
	        window.location.assign("tutorial1.php");
	    });
	    
	     $('#next').click(function(event){
	        event.preventDefault();
	        window.location.assign("tutorial3.php");
	    });
	});
	
	</script>

</div><!-- /page -->

</body>
</html>