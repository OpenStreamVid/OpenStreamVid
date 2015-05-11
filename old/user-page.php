<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 

	<title>Personal page</title>

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
	include "include/user-modal.html";
	include "add_new.php";
	include "edit_content.php";
?>
	<div id="container">
		<h3>Personnal page</h>
		<?php 
		if(isset($_GET['new']) && ($_GET['new'] == 'password' || $_GET['new'] == 'file')){?>
			<div data-alert class="alert-box success">
				<span >You successfully changed your <?php print $_GET['new']?>.</span>
				<a href="" class="close">&times;</a>
			</div> 
		<?php
		} 
		else if (isset($_GET['new']) && $_GET['new'] == 'edit')
		{?>
			<div data-alert class="alert-box success">
				<span >You successfully edited your content.</span>
				<a href="" class="close">&times;</a>
			</div> 
		<?php
		}else if (isset($_GET['new']) && $_GET['new'] == 'delete')
		{?>
			<div data-alert class="alert-box success">
				<span >You successfully deleted your content.</span>
				<a href="" class="close">&times;</a>
			</div> 
		<?php
		}
		?>
		<dl class="accordion" data-accordion> 
			<dd id="accordion-1" class="accordion-navigation"> 
				<a href="#panel1"><span id="accordion-1-name">Your videos</span></a> 
				<div id="panel1" class="content"> 

					<a data-reveal-id="add_new" class='button'>Add new video</a>
				
					<table id="user-content-table">
						<?php 
							$sql = 'SELECT c.contentid, contenttitle, contentdescription, contentviews, contentdateupload, licenceid, licencename, tagname 
							FROM Content c, contenttag ct, tag t , licence
							WHERE contentuser = :user
							AND c.contentid = ct.contentid
							AND ct.tagid = t.tagid
							AND contentlicenceid = licenceid
							ORDER BY contentdateupload DESC';

							$req = $co->prepare($sql);

							$req->bindValue(':user',$_SESSION['id'], PDO::PARAM_STR);
							$req->execute();							

							$row = $req->fetchAll();

							foreach ($row as $key => $value) {
								//GET CONTENT LIKES
								$sqllike =' SELECT count(likeid) as likes
											FROM likes
											WHERE contentlikeid = :contentid';
								$req = $co->prepare($sqllike);

								$req->bindValue(':contentid',$value['contentid'], PDO::PARAM_STR);
								$req->execute();							

								$resultlike = $req->fetchAll();

								// GET CONTENT DISLIKES
								$sqldislike= 'SELECT count(dislikeid) as dislikes
												FROM dislikes
												WHERE contentdislikeid = :contentid';
								$req = $co->prepare($sqldislike);

								$req->bindValue(':contentid',$value['contentid'], PDO::PARAM_STR);
								$req->execute();							

								$resultdislike = $req->fetchAll();

								echo'<tr id="'.$value['contentid'].'">								
										<td class="td-thumbnail"><a href="video.php?content='.$value['contentid'].'"><img class="thumbnail-user-content" src="videos/'.$_SESSION['nickname'].'/'.$value['contentid'].'/thumbnail.jpg"></a></td>
										<td class="description-user-content"><p><a href="video.php?content='.$value['contentid'].'"><span><b>'.$value['contenttitle'].': </b></span>
											<span><br>';
											if(strlen($value['contentdescription']) > 150)
											{
												echo substr($value['contentdescription'],0,150).'</span><span class="description-complete" style="display:none">'.$value['contentdescription'].'</span>';
											}
											else
											{
												echo $value['contentdescription'].'</span><span class="description-complete" style="display:none">'.$value['contentdescription'].'</span>';
											}
									echo	'<a href="video.php?content='.$value['contentid'].'"></p></td>
										<td class="evaluation-user-content"><p><span>'.$value['contentviews'].'<b> Views </b></span> <br>
											<span>'.$resultlike[0]['likes'].'<b> Likes </b></span> <br>
											<span>'.$resultdislike[0]['dislikes'].'<b> Dislikes </b></span></p>
										</td>
										<td><span>'.$value['tagname'].'</span></td>
										<td><span>'.$value['licencename'].'</span><span class="licence-id" style="display:none;">'.$value['licenceid'].'</span></td>
										<td><span>'.$value['contentdateupload'].'</span></td>
										<td><a class="button edit-modal-trigger">Edit</a></td>
										<td><a class="button alert delete-content-button">Delete</a></td>
									</tr>';
							}
						?>
					</table>
				</div> 
			</dd>
			<dd id="accordion-2" class="accordion-navigation"> 
				<a href="#panel2"><span id="accordion-2-name">Edit account</span></a> 
				<div id="panel2" class="content"> 
					<h5>Your information</h5>
					<div id="account-description">
						<img src="img/user/<?php print $_SESSION['nickname'] ?>/profile.jpg" id="account-picture" data-reveal-id="user-modal">
						<div id="account-information">
							<a id="change-nickname" data-reveal-id="user-modal"><?php print $_SESSION['nickname'] ?> <small>modify</small></a><br>
							<a id="change-email" data-reveal-id="user-modal"></a><br><br>
						</div>
						<span>Password : <a href="password.php">change your password</a></span><br> 
					</div>
				</div> 
			</dd> 
		</dl>
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
<?php include 'js/user-page.js.php'; ?>
<script src="js/add_new.js"></script>
<script src="js/edit_content.js"></script>
<script src="js/user-modal.js"></script>