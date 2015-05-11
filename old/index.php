<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 

	<title> Welcome </title>

	<?php
		require_once 'include/config.php';
		require_once 'include/include.css.php';
	?>
</head>
<body>

<?php
	include "include/header.php";

	if(isset($_GET['registered']))
	{
	?>	<div id="registeredModal" class="reveal-modal welcome-modal" data-reveal-ajax>
				<fieldset>
					<legend>Registered</legend>
					<div>
						<h2>Welcome on <img src="img/site/logo2.png"/> </h2>
						<h3>You are now a registered user</h3>	
					</div>
					<div class="modal-buttons">
						<a href="index.php" class="button radius close">Close</a>
					</div>
				</fieldset>
			</div>
		<script type="text/javascript"> $("#registeredModal").foundation("reveal", "open"); </script>
	<?php}
?>		
<!-- 
		BODY 
				-->

	<div class="main">
		<div class="media-content">
			<!-- Accordion per Tag Names -->
<?php
$query = "SELECT tagid, tagname FROM Tag";
$tag = $co->query($query)->fetchAll(PDO::FETCH_ASSOC);

foreach ($tag as $key => $value) {
			$tagid=$value['tagid'];
 	 		echo'
 	 		<div class="tag">
				<div class="title-banner">
					<h3 class="banner-name"><a class="banner-name" href="channel.php?type=tag&id='.$value['tagname'].'">'.$value['tagname'].'</a></h3>
				</div>
				<div id="panel'.$key.'" class="panel panel-content">';
					
	 				require ('get_new_content.php');

			echo'</div>
			</div>';
}

?>

		</div>
	</div>	

<?php
	include "include/footer.php";
?>	
</body>
</html>
<?php include 'include/include.js.php'; ?>
<?php include 'js/index.js.php'; ?>