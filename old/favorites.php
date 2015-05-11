<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 

 	<title>Favorites</title>

 	<?php
	require_once 'include/config.php';
	require_once 'include/include.css.php';

	if(!isset($_SESSION['id']))
	{
		echo'<script type="text/javascript">history.go(-1); </script>';
	}
	else
	{
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
	 			$sql = 'SELECT contentid, contenttitle, usernickname, contentviews, datelike 
	 					FROM likes, content, user
	 					WHERE contentlikeid = contentid
	 					AND contentuser = userid
	 					AND userlikeid = :id';

				$req = $co->prepare($sql);

				$req->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
				$req->execute();							

				$row = $req->fetchAll();

				foreach ($row as $key => $value) {
					echo'<tr id="'.$value['contentid'].'">
							<td><a href="video.php?content='.$value['contentid'].'"><img style="width:180px; height:130px;" src="videos/'.$value['usernickname'].'/'.$value['contentid'].'/thumbnail.jpg"></a></td>
			 				<td class="favorites-content-name"><a href="video.php?content='.$value['contentid'].'"><b>'.$value['contenttitle'].'</b></a></td>
			 				<td><a href="channel.php?type=user&id='.$value['usernickname'].'">'.$value['usernickname'].'</a></td>
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
<?php 
	}
?>
</html>
<?php include 'include/include.js.php'; ?>
<?php include 'js/favorites.js.php'; ?>