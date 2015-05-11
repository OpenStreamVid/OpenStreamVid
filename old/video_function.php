<?php 

include "include/config.php";

/**
	Proccessing likes and dislikes
**/

if(isset($_POST['countlike']) && isset($_POST['countdislike']))
{
	$countlike = $_POST['countlike'];
	$countdislike = $_POST['countdislike'];
}

if(isset($_POST['contentid']) && !empty($_POST['contentid']))
{
	
	$i = array();

	if(isset($_SESSION['id']) && !empty($_SESSION['id']))
	{
		$userid = $_SESSION['id'];
	}
	else
	{
		$userid = null;
	}

	if(isset($_POST['erase_like']) && $_POST['erase_like'] == 1)
	{
		$sql = 'DELETE FROM likes WHERE ContentLikeId = :contentid AND UserLikeId = :userid';
		$req = $co->prepare($sql);

		$req->bindValue(':contentid', $_POST['contentid']);
		$req->bindValue(':userid', $_SESSION['id']);


		$req->execute();	

		exit;
	}
	else if (isset($_POST['like']) && $_POST['like'] == 1)
	{	
		try 
		{	
			$sql = 'SELECT count(*) 
					FROM likes 
					WHERE contentlikeid = :contentid
					AND userlikeid = :userid';
			$req = $co->prepare($sql);

			$req->bindValue(':contentid',$_POST['contentid'], PDO::PARAM_STR);
			$req->bindValue(':userid',   $userid, PDO::PARAM_INT);


			$req->execute();

			$count = $req->fetchAll();	

			if($count[0][0] == 0)
			{   
				$sql = "INSERT INTO likes VALUES ( NULL,:contentid, :userid, :date)";
				$req = $co->prepare($sql);

				$req->bindValue(':contentid',$_POST['contentid'], PDO::PARAM_STR);
				$req->bindValue(':userid',   $userid, PDO::PARAM_INT);	
				$req->bindValue(':date',     date("Y-m-d H:i:s"), PDO::PARAM_STR);

				$req->execute();	

				$countlike = 0;
			}
			else
			{
				exit;
			}
		}
		catch (PDOException $e) 
		{
			echo "Connection impossible : ", $e->getMessage();
		}
		
	}

	else if(isset($_POST['dislike']) && $_POST['dislike'] == 1)
	{
		try 
		{
			$sql = 'SELECT count(*) 
					FROM dislikes 
					WHERE contentdislikeid = :contentid
					AND userdislikeid = :userid';
			$req = $co->prepare($sql);

			$req->bindValue(':contentid',$_POST['contentid'], PDO::PARAM_STR);
			$req->bindValue(':userid',   $userid, PDO::PARAM_INT);


			$req->execute();

			$count = $req->fetchAll();	

			if($count[0][0] == 0)
			{   
				$sql = "INSERT INTO dislikes VALUES ( NULL,:contentid, :userid, :date)";
				$req = $co->prepare($sql);

				$req->bindValue(':contentid',$_POST['contentid'], PDO::PARAM_STR);
				$req->bindValue(':userid',   $userid, PDO::PARAM_INT);	
				$req->bindValue(':date',     date("Y-m-d H:i:s"), PDO::PARAM_STR);

				$req->execute();	

				$countlike = 0;
			}
			else
			{
				exit;
			}

		}
		catch (PDOException $e) 
		{
			echo "Connection impossible : ", $e->getMessage();
		}
	}

	if(isset($countlike))
	{
		$sql='SELECT COUNT(*) as likes FROM Likes WHERE ContentLikeId = :contentid';
		$req= $co->prepare($sql);

		$req->bindValue(':contentid', $_POST['contentid'], PDO::PARAM_STR);
		
		$req->execute();
		$req = $req->fetchAll();	

		array_push($i, $req[0]);
	}
	if(isset($countdislike))
	{
		$sql='SELECT COUNT(dislikeid) as dislikes FROM Dislikes WHERE ContentDislikeId = :contentid';
		$req= $co->prepare($sql);

		$req->bindValue(':contentid', $_POST['contentid'], PDO::PARAM_STR);
		
		$req->execute();
		$req = $req->fetchAll();	

		array_push($i, $req[0]);
	}


/**
		Processing Views
**/
	if(isset($_POST['views']) && $_POST['views']==1)
	{
		try 
		{
			$sql = "UPDATE content SET contentviews = contentviews + 1 WHERE contentid = :id";
			$req = $co->prepare($sql);

			$req->bindValue(':id',$_POST['contentid'], PDO::PARAM_STR);
			$req->execute();

			$sql='SELECT contentviews as views FROM Content WHERE Contentid = :id';
			$req= $co->prepare($sql);

			$req->bindValue(':id', $_POST['contentid'], PDO::PARAM_STR);
			
			$req->execute();
			$req = $req->fetchAll();	

			array_push($i, $req[0]);
			
		} catch (PDOException $e) {
			echo "Connection impossible : ", $e->getMessage();
		}



	}

	echo json_encode($i);
}

?>