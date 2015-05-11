<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 

 	<title>Favorites</title>

<?php
	require_once 'include/include.css.php';
?>
</head>
<body>
	<?php
		include "include/header.php";
	?>
 	<div id="favorites-wrapper">
 		<div class="title-banner">
 			<h3 class="banner-name">The videos you liked <i class="fi-heart"></i></h3>
 		</div>
 		<div class="panel panel-content">
	 		<table id="favorites-table">
	 		<?php 
	 		
				foreach ($row as $key => $value) {
					echo'<tr id="'.$value['contentid'].'">
							<td><a href="video/'.$value['contentid'].'"><img style="width:180px; height:130px;" src="videos/'.$value['usernickname'].'/'.$value['contentid'].'/thumbnail.jpg"></a></td>
			 				<td class="favorites-content-name"><a href="video.php/'.$value['contentid'].'"><b>'.$value['contenttitle'].'</b></a></td>
			 				<td><a href="channel/user/'.$value['usernickname'].'">'.$value['usernickname'].'</a></td>
			 				<td>'.$value['contentviews'].'</td>
			 				<td>'.$value['datelike'].'</td>
			 				<td class="delete-favorites"><span data-tooltip title="Click here to delete the video from the list"  class="has-tip fi-x"></span></td>
			 			</tr>';
				}
	 		?>

	 		</table>
	 		<div class="button button-more radius">
					<p>Show more</p>
			</div>
	 	</div>	
 	</div>

	<?php 
		include "include/footer.php";
	?>
</body>
</html>
<?php include 'include/include.js.php'; ?>
<?php include 'js/favorites.js.php'; ?>