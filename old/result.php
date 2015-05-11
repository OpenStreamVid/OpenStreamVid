<?php
	if(isset($_GET['search']) && !empty($_GET['search']))
	{ 

		include "include/config.php";
?>
<html>
<head>
	<meta charset="utf-8">

	<title>Result of your research</title>

	<?php include "include/include.css.php"; ?>
</head>
<body>
	<?php include "include/header.php"; ?>

	<?php include "include/footer.php"; ?>
</body>
</html>
<?php 
	}
	else
	{
		header('Location: error.php');
	} 
 include 'include/include.js.php'; 
 include 'js/result.js.php';
?>	