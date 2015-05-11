<?php 
	require_once 'include/config.php';

/**
		Add new content
**/
	if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['licence']) && !empty($_POST['title']) && !empty($_POST['licence']))
	{
	var_dump($_FILES);
	var_dump($_POST);
		$title = htmlspecialchars($_POST['title']);
		$base64title = base64_encode($_POST['title']);
		try
		{
			$sql='INSERT INTO content VALUES (:id, :title, :description, 0, :date, :user, :licence)';
			$req= $co->prepare($sql);

			$req->bindValue(':id',      		$base64title, PDO::PARAM_STR);
			$req->bindValue(':title',    		$title, PDO::PARAM_STR);
			$req->bindValue(':description',     htmlspecialchars($_POST['description']), PDO::PARAM_STR);
			$req->bindValue(':date',      		date ("Y-m-d H:i:s"), PDO::PARAM_STR);
			$req->bindValue(':user',   	  		$_SESSION['id'], PDO::PARAM_STR);
			$req->bindValue(':licence',      	$_POST['licence'], PDO::PARAM_STR);

			$req->execute();


			$sql='INSERT INTO contenttag VALUES (:id, :tag)';
			$req= $co->prepare($sql);

			$req->bindValue(':id',        	 $base64title, PDO::PARAM_STR);
			$req->bindValue(':tag',      	 $_POST['tagid'], PDO::PARAM_STR);

			$req->execute();
		}
		catch( PDOException $e ) 
		{
			echo "Registration impossible : ", $e->getMessage();
		}	

		$path1 = 'videos/'.htmlspecialchars($_SESSION['nickname']).'/'.$base64title;

		if(!is_dir($path1))
		{
			mkdir($path1);
		}




		$error = true;	
		$thumbnailname = 'thumnail.jpg';
		$contentname = $title;
 		$path = 'videos/'.htmlspecialchars($_SESSION['nickname']).'/'.$base64title.'/';

		$path_thumbnail = $path.'thumbnail.jpg';

 		if(!empty($_FILES['thumbnail']['name']))
 		{
 			if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path_thumbnail)) {
 				$error = 'uploaded';
 			}
 			else{
 				$error = 'upload error 1';
 			}
		}
		else
		{
			$defaultpath = 'videos/default.jpg';
			if (copy($defaultpath, $path_thumbnail)) {
 				$error = 'uploaded 2';
 			}
 			else
 			{
 				$error = 'upload error 2';
 			}
		}

		if(!empty($_FILES['content']['name']))
		{
 			$path_video = $path.$title.'.mp4';
			if (move_uploaded_file($_FILES['content']['tmp_name'], $path_video)) {
 				$error = 'uploaded videos';
 			}
 			else{
 				$error = 'upload error 1';
 			}
		}
		else
		{	
			$error .= 'erreor upload video';
		}
		echo $error;
		header('Location: user-page.php?new=file');
	}	

/**
		Test existing content
**/
	else if(isset($_GET['title']) && !empty($_GET['title']))
	{
		$sql = 'SELECT COUNT(contentid) as contentexisting FROM content WHERE contenttitle = :title';
		$req = $co->prepare($sql);

		$req->bindValue(':title',$_GET['title']);

		$req->execute();

		$row = $req->fetch(PDO::FETCH_ASSOC);
		// var_dump($row['userexisting']);
		
		echo $row['contentexisting'];
	}


/**
		Edit content
**/
	if(isset($_POST['title-edit']) && isset($_POST['description-edit']) && isset($_POST['licence-edit']) && isset($_POST['id-edit']) && !empty($_POST['id-edit']) && !empty($_POST['title-edit']) && !empty($_POST['licence-edit']))
	{
		$newtitle = htmlspecialchars($_POST['title-edit']);
		$newbase64title = base64_encode($_POST['title-edit']);

		try
		{
			$sql='UPDATE content SET contentid = :newid, contenttitle = :title, contentdescription = :description, contentlicenceid = :licence WHERE contentid = :oldid';
			$req= $co->prepare($sql);


			$req->bindValue(':oldid',   	  	$_POST['id-edit'], PDO::PARAM_STR);
			$req->bindValue(':newid',      		$newbase64title, PDO::PARAM_STR);
			$req->bindValue(':title',    		$newtitle, PDO::PARAM_STR);
			$req->bindValue(':description',     htmlspecialchars($_POST['description-edit']), PDO::PARAM_STR);
			$req->bindValue(':licence',      	$_POST['licence-edit'], PDO::PARAM_STR);

			$req->execute();


			$sql='UPDATE contenttag SET contentid = :newid, tagid = :tag WHERE contentid = :oldid';
			$req= $co->prepare($sql);

			$req->bindValue(':oldid',   $_POST['id-edit'], PDO::PARAM_STR);
			$req->bindValue(':newid',   $newbase64title, PDO::PARAM_STR);
			$req->bindValue(':tag',     $_POST['tagid'], PDO::PARAM_STR);

			$req->execute();
		}
		catch( PDOException $e ) 
		{
			echo "Registration impossible : ", $e->getMessage();
		}	

		$path_old = 'videos/'.htmlspecialchars($_SESSION['nickname']).'/'.$_POST['id-edit'];
		$path_new = 'videos/'.htmlspecialchars($_SESSION['nickname']).'/'.$newbase64title;

		if(!is_dir($path_old))
		{
			rename($path_old,$path_new);
		}

		$error = true;	

 		if(!empty($_FILES['thumbnail']['name']))
 		{
			$path_thumbnail = $path_new.'/thumbnail.jpg';
 			if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path_thumbnail)) {
 				$error = 'uploaded';
 			}
 			else{
 				$error = 'upload error 1';
 			}
		}

		echo $error;
		header('Location: user-page.php?new=edit');
	}	

/**
		Delete content
**/
	if(isset($_GET['delete']) && $_GET['delete'] == '0')
	{
		$sql = 'DELETE c, ct
				FROM content c
				JOIN contenttag ct ON c.contentid = ct.contentid
				WHERE c.contentid = :id';
		$req= $co->prepare($sql);

		$req->bindValue(':id', $_GET['contentid'], PDO::PARAM_STR);

		$req->execute();

		$dir='videos/'.htmlspecialchars($_SESSION['nickname']).'/'.$_GET['contentid'];

		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {

				if ($object != "." && $object != "..") {
						unlink($dir."/".$object);
				}
			}
			reset($objects);		
			if(rmdir($dir))
			{
				header('Location: user-page.php?new=edit');
			}
			else
			{
				echo 'directory not removed';
			}
		}


	}

?>