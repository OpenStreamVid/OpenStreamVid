<?php 
	if(!isset($_SESSION['id']))
	{	
		header('Location : error.php',true,303);
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 

	<title>Personal page</title>

<?php
	require_once ROOT.'include/include.css.php';
?>
</head>
<body>
<?php
	include ROOT.'include/header.php';
	include ROOT.'modal/edit-user-modal.html';
	include ROOT.'modal/edit-content-modal.php';
	include ROOT.'modal/add-new-modal.php';
?>
	<div id="container">

<?php
if(isset($param[1]))
{
	if($param[2] == 'added')
	{?>
		<div data-alert class="alert-box success">
			<span >You successfully added your content.</span>
			<a href="" class="close">&times;</a>
		</div>
	<?php 
	}
	else if ($param[2] == 'edit')
	{?>
			<div data-alert class="alert-box success">
				<span >You successfully edited your content.</span>
				<a href="" class="close">&times;</a>
			</div> 
	<?php
	}
	else if ($param[2] == 'delete')
	{?>
			<div data-alert class="alert-box success">
				<span >You successfully deleted your content.</span>
				<a href="" class="close">&times;</a>
			</div> 
	<?php
	}
	else
	{?>
			<div data-alert class="alert-box success">
				<span >You successfully changed your <?php print $param[2] ?>.</span>
				<a href="" class="close">&times;</a>
			</div> 
	<?php
	}
}	
?>

		<dl class="accordion" data-accordion>
			<dd id="accordion-1" class="accordion-navigation">
				<a href="#panel1"><span id="accordion-1-name">Personnal page</span></a>
				<div id="panel1" class="content"> 
				</div>
			</dd>

			<dd id="accordion-2" class="accordion-navigation"> 
				<a href="#panel2"><span id="accordion-2-name">Your videos</span></a> 
				<div id="panel2" class="content"> 

					<a data-reveal-id="addNew" class='button'>Add new video</a>
				
					<table id="user-content-table">
<?php 
	foreach ($row as $key => $value) 
	{
?>						
						<tr id="<?php echo $value['contentid']; ?>">								
							<td class="td-thumbnail"><a href="video/<?php echo $value['contentid'];?>"><img class="td-thumbnail" src="videos/<?php echo $_SESSION['nickname'];?>/<?php echo $value['contentid'];?>/thumbnail.jpg"></a></td>
							<td class="td-description">
								<p><a href="video/<?php echo $value['contentid'];?>">
									<span><b><?php echo $value['contenttitle']; ?></b></span><br>
									<span>
<?php	
		$value['contentdescription'] = (strlen($value['contentdescription']) > 150) ? substr($value['contentdescription'],0,150) : $value['contentdescription'];

										echo $value['contentdescription'];?></span>
									<span class="description-complete" style="display:none"><?php echo $value['contentdescription'];?></span>
									<a href="video.php?content=<?php echo $value['contentid']; ?>"></a>
								</p>
							</td>
							<td class="td-evaluation">
								<p>
									<span><?php echo $value['contentviews'];?><b> Views </b></span><br>
									<span><?php echo $value['likes'];?><b> Likes </b></span><br>
									<span><?php echo $value['dislikes'];?><b> Dislikes </b></span>
								</p>
							</td>
							<td class="td-tag">
								<span><?php echo $value['tagname'];?></span>
							</td>
							<td class="td-licence">
								<span class="licence-id"><?php echo explode('</a>',$value['licenceurl'])[0]; ?></span>
							</td>
							<td class="td-date">
								<span><?php echo $value['contentdateupload']; ?></span>
							</td>
							<td class="td-delete">
								<a class="button alert delete-content-button">Delete</a>
							</td>
							<td class="td-edit">
								<a class="button edit-modal-trigger">Edit</a>
							</td>
						</tr>
<?php 
	} 
?>
					</table>

				</div> 
			</dd>

			<dd id="accordion-3" class="accordion-navigation"> 
				<a href="#panel3"><span id="accordion-3-name">Edit account</span></a> 
				<div id="panel3" class="content"> 
					<h5>Your information</h5>
					<div id="account-description">
						<img src="img/user/<?php print $_SESSION['nickname'] ?>/profile.jpg" id="account-picture" data-reveal-id="user-modal">
						<div id="account-information">
							<a id="change-nickname" data-reveal-id="user-modal">
								<?php print $_SESSION['nickname']; ?> <small>modify</small>
							</a><br>
							<a id="change-email" data-reveal-id="user-modal"></a>
							<br><br>
						</div>
						<span>Password : 
							<a id="change-password" data-reveal-id="user-modal">change your password</a>
						</span><br> 
					</div>
				</div> 
			</dd> 
		</dl>
	</div>

<?php
	include ROOT.'include/footer.php';	
?>
</body>
</html>