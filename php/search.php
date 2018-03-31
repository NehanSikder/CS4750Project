<!DOCTYPE HTML>
<html>
<head>
  <title>Search Restaurant</title>
  <script src="../js/js/jquery-1.6.2.min.js" type="text/javascript"></script> 
	<script src="../js/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="stylesheet.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
	var user = "<?php echo $_POST['userName'] ?>";
	var password = "<?php echo $_POST['password'] ?>";
	if(user != null && password != null){
		$(document).ready(function() {
			$( "#input" ).change(function() {
				$.ajax({
					url: 'searchRestaurants.php', 
					data: {search: $( "#input" ).val()},
					success: function(res){
						$('#result').html(res);
					}
				});
			});
		});
	}
	</script>
</head>
<h1 class="text-center align-items-center">
    Search Restaurants
</h1>
<body>
<div class="text-center">
<div class="input-group mb-3">
<div class="centered">
	<input type="text" id= "input" class="form-control" placeholder="Search Restaurants" aria-label="Search Restaurants" aria-describedby="basic-addon2">
</div>
</div>
	<br/>
	<br/>
	<div id="result">Search Result</div>
</div>
</body>
</html>