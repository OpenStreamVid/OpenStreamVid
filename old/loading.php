<!DOCTYPE html>
<html>
	<head>
		<title> Loading </title>
		<link href="css/personalized.css" rel="stylesheet">
	</head>
	<body>

		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>

	<?php 
	if(isset($_GET['content']) && !empty($_GET['content']))
	{
		include 'content.php';
	}
	else
	{
		include 'user.php'; 
	}
	?>

	</body>

<script type="text/javascript">
	window.setTimeout(function(){
		window.location.replace('index.php?registered=on');
	}, 5000);
</script>	
</html>