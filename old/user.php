<?php
	require_once 'include/config.php';

	// var_dump($_REQUEST);
	
/**
		Add a new user in database and create own repertories
**/

	if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && isset($_POST['nickname']) && isset($_POST['password']) && !empty($_POST['nickname']) && !empty($_POST['password']) && empty($_POST['age']))
	{
		try
		{
			$sql='INSERT INTO User VALUES (null, :nickname, :email, :password, null)';
			$req= $co->prepare($sql);

			$req->bindValue(':nickname',     	$_POST['nickname'], PDO::PARAM_STR);
			$req->bindValue(':email',       $_POST['email'], PDO::PARAM_STR);
			$req->bindValue(':password',    sha1($_POST['password']), PDO::PARAM_STR);

			$req->execute();
		}
		catch( PDOException $e ) 
		{
			echo "Registration impossible : ", $e->getMessage();
		}	

		$path1 = 'videos/'.htmlspecialchars($_POST['nickname']);
		$path2 = 'img/user/'.htmlspecialchars($_POST['nickname']);

		if(!is_dir($path1))
		{
			mkdir($path1);
		}
		
		if(!is_dir($path2))
		{
			mkdir($path2);
		}

		// $subject = 'Validation of Open StreamVid account';
		
		// $message = 'Hi '.htmlspecialchars($_POST['nickname']).',\n\n
		// 			You have just created an account ';

		// $headers = 'From: webmaster@example.com' . "\r\n" .
		// 		   'Reply-To: webmaster@example.com' . "\r\n" .
		// 		   'X-Mailer: PHP/' . phpversion();

		// mail($_POST['email'], $subject, $message, $headers);

		
	}
	else if (!empty($_POST['age']))
	{
		echo '<script type="text/javascript"> window.location.replace("error.php"); </script>';	
	}


/**
		Add or change profile picture to userss
**/
	if(isset($_FILES['profile-picture']) && isset($_POST['nickname']))
	{
 		$error = true;	
		$filename = 'profile.jpg';
 		$path = 'img/user/'.htmlspecialchars($_POST['nickname']).'/'.$filename;	

 		if(!empty($_FILES['profile-picture']['name'])){
 			if (move_uploaded_file($_FILES['profile-picture']['tmp_name'], $path)) {
 				$error = 'uploaded';
 			}
 			else{
 				$error = 'upload error 1';
 			}
		}
		else{
			$defaultpath = 'img/user/'.$filename;
			if (copy($defaultpath, $path)) {
 				$error = 'uploaded 2';
 			}
 			else
 			{
 				$error = 'upload error 2';
 			}
		}
	}


/**
		Connect the user
**/	
	else if( (isset($_POST['idco']) && isset($_POST['passwordco']) && !empty($_POST['idco']) && !empty($_POST['passwordco'])))
	{	
		try
		{
			$sql = 'SELECT userid, usernickname From user WHERE userpasswd = :password AND useremail = :id';
			$req = $co->prepare($sql);

			$req->bindValue(':id', 			$_POST['idco'], PDO::PARAM_STR);
			$req->bindValue(':password', 	sha1($_POST['passwordco']), PDO::PARAM_STR);

			$req->execute();
			$req = $req->fetchAll();

			if(!empty($req))
			{
				$value = $req[0];	

				$_SESSION['id'] = $value['userid'];
				$_SESSION['nickname'] = $value['usernickname'];

				echo $_SESSION['id'];
			}
			else
			{
				echo 'not found';
			}

		}
		catch( PDOException $e ) 
		{
			echo "Connection impossible : ", $e->getMessage();
		}
	}
	// else
	// {
	// 	// echo '<script type="text/javascript"> window.location.replace("error.php"); </script>';	
	// }

/**
		Test username
**/	
	else if(isset($_GET['nickname']) && !empty($_GET['nickname']))
	{
		$sql = 'SELECT COUNT(userid) as userexisting FROM user WHERE usernickname = :nickname';
		$req = $co->prepare($sql);

		$req->bindValue(':nickname',$_GET['nickname']);

		$req->execute();

		$row = $req->fetch(PDO::FETCH_ASSOC);
		// var_dump($row['userexisting']);
		
		echo $row['userexisting'];
	}

/**
		Test user email
**/	
	else if(isset($_GET['email']) && !empty($_GET['email']))
	{
		$sql = 'SELECT COUNT(userid) as userexisting FROM user WHERE useremail = :email';
		$req = $co->prepare($sql);

		$req->bindValue(':email',$_GET['email']);

		$req->execute();

		$row = $req->fetch(PDO::FETCH_ASSOC);
		// var_dump($row['userexisting']);
		
		echo $row['userexisting'];
	}	

/**
		Get User info
**/
	else if(isset($_POST['get_info_of']) && !empty($_POST['get_info_of']))
	{
		$sql = 'SELECT useremail as email FROM user WHERE userid = :id';
		$req = $co->prepare($sql);

		$req->bindValue(':id',$_POST['get_info_of'], PDO::PARAM_STR);

		$req->execute();

		$row = $req->fetchAll();

		echo json_encode($row);
	}

/**
		Change User Nickname
**/
	else if(isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['change']) && $_POST['change'] == 1)
	{
		try 
		{
			$sql = "UPDATE user SET usernickname = :nickname WHERE userid = :id";
			$req = $co->prepare($sql);

			$req->bindValue(':nickname',$_POST['nickname'], PDO::PARAM_STR);
			$req->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
			$req->execute();

			$path1 = 'img/user/';
			$path2 = 'videos/';
			rename($path1.$_SESSION['nickname'], $path1.htmlspecialchars($_POST['nickname']));
			rename($path2.$_SESSION['nickname'], $path2.htmlspecialchars($_POST['nickname']));
			$_SESSION['nickname'] = htmlspecialchars($_POST['nickname']);


			echo 0;
		} 
		catch (PDOException $e) 
		{
			echo "Connection impossible : ", $e->getMessage();
		}

	}


/**
		Change User email
**/
	else if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['change']) && $_POST['change'] == 2)
	{
		try 
		{
			$sql = "UPDATE user SET useremail = :email WHERE userid = :id";
			$req = $co->prepare($sql);

			$req->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
			$req->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
			$req->execute();

			echo 0;
		} 
		catch (PDOException $e) 
		{
			echo "Connection impossible : ", $e->getMessage();
		}

	}

/**
		Change User password
**/
	else if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['email']) && !empty($_POST['email']) &&  isset($_POST['change']) && $_POST['change'] == 3)
	{
		try 
		{
			$sql = "UPDATE user SET userpasswd = :password WHERE userid = :id";
			$req = $co->prepare($sql);

			$req->bindValue(':password',sha1($_POST['password']), PDO::PARAM_STR);
			$req->bindValue(':id',$_SESSION['id'], PDO::PARAM_STR);
			$req->execute();

			echo 0;
		} 
		catch (PDOException $e) 
		{
			echo "Connection impossible : ", $e->getMessage();
		}

	}	


?>
