<?php 
	include "include/configSession.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	
	<title>404 page</title>
	<?php 
		include 'include/include.css.php';
	?>
</head>
<body class="error-body">

<?php 
		include "include/header.php"; 
?>
	<div class="error-circle">
		<div class="error404-circle-content">
			<h2>Ooops !</h2>
			<h2>404 ERROR</h2>
			<h3>Page not found</h2>
		</div>
	</div>

	<h2 class="back">Back <a href="index">Home</a></h2>

<?php include"include/footer.php"; ?>

</body>
</html>
<?php include 'include/include.js.php'; ?>