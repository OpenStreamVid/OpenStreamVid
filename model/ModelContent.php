<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/core/model.php');

class Content extends Model
{

/**
		Test if content exist
**/
	public function exist($title)
	{
		$query = 'SELECT contentid FROM content WHERE lower(contenttitle) = :title';
		$req = $this->co->prepare($query);

		$req->bindValue(':title', strtolower($title), PDO::PARAM_STR);

		$req->execute();
		return $req->fetch(PDO::FETCH_ASSOC);
	}

/**
		Add content to database
**/
	public function add($array)
	{
		$array['title'] = htmlspecialchars($array['title']);
		$array['base64title'] = base64_encode($array['title']);
		$array['path'] = 'videos/'.htmlspecialchars($array['nickname']).'/'.$array['base64title'].'/';

		try
		{
			$query='INSERT INTO content VALUES (:id, :title, :description, 0, :date, :user, :licence)';
			$req= $this->co->prepare($query);

			$req->bindValue(':id',      		$array['base64title'], PDO::PARAM_STR);
			$req->bindValue(':title',    		$array['title'], PDO::PARAM_STR);
			$req->bindValue(':description',     htmlspecialchars($array['description']), PDO::PARAM_STR);
			$req->bindValue(':date',      		date ("Y-m-d H:i:s"), PDO::PARAM_STR);
			$req->bindValue(':user',   	  		$array['user'], PDO::PARAM_STR);
			$req->bindValue(':licence',      	$array['licence'], PDO::PARAM_STR);

			$req->execute();


			$query='INSERT INTO contenttag VALUES (:id, :tag)';
			$req= $this->co->prepare($query);

			$req->bindValue(':id',        	 $array['base64title'], PDO::PARAM_STR);
			$req->bindValue(':tag',      	 $array['tagid'], PDO::PARAM_STR);

			$req->execute();
		}
		catch( PDOException $e ) 
		{
			echo "Registration impossible : ". $e->getMessage();
		}

		$this->upload($array);
	}


/**
		Upload content
**/
	private function upload($array)
	{
		include('/openstreamvid/include/ffmpeg/src');

		$ffmpeg = FFMpeg::create();
		$video 	= $ffmpeg->open('video.mpg');
		$video 	-> filters() -> resize(new Coordinate\Dimension(320, 240)) -> synchronize();
		$video 	-> frame(Coordinate\TimeCode::fromSeconds(10)) -> save('frame.jpg');
		$video 	-> save(new Format\Video\WebM(), 'export-webm.webm');

		if(!is_dir($array['path']))
		{
			mkdir($array['path']);
		}

		$path_thumbnail = $array['path'].'thumbnail.jpg';
		$error = null;

 		if(!empty($array['file']['thumbnail']['name']))
 		{
 			if (move_uploaded_file($array['file']['thumbnail']['tmp_name'], $path_thumbnail)){}
 			else{
 				$error = 'upload error 1';
 			}
		}
		else
		{
			$defaultpath = 'videos/default.jpg';
			if (copy($defaultpath, $path_thumbnail)){}
 			else
 			{
 				$error = 'upload error 2';
 			}
		}

		if(!empty($array['file']['content']['name']))
		{
 			$path_video = $array['path'].$array['title'].'.mp4';
			if (move_uploaded_file($array['file']['content']['tmp_name'], $path_video)){}
 			else{
 				$error = 'upload error 1';
 			}
		}
		else
		{	
			$error .= 'error upload video';
		}
		return $error;
	}

/**	
		Load content
**/

	public function load($id)
	{
		$query = "SELECT contenttitle, contentdescription, contentviews, contentdateupload, t.tagid, tagname, usernickname, licencename, licenceurl 
		FROM content c, contenttag ct, tag t, user, licence 
		WHERE c.contentid = ct.contentid 
		AND contentlicenceid = licenceid
		AND t.tagid = ct.tagid 
		AND userid = contentuser 
		AND c.contentid = :id ";
		
		$req = $this->co->prepare($query);

		$req->bindValue(':id',		$id, PDO::PARAM_STR);

		$req->execute();
		return $req->fetchAll();
	}

/**
		Search content
**/
	public function search($title,$limit = null)
	{
		$query = 'SELECT contentID, contentTitle 
			  	  FROM content
			  	  WHERE lower(contentTitle) LIKE :search '.$limit;

		$req= $this->co->prepare($query);

		$req->bindValue(':search',  "%$title%", PDO::PARAM_STR);

		// Do Search
		$req->execute();
		return $req->fetchAll();	
	}


/**
		Get user's content
**/
public function get($id)
{
	$query = 'SELECT c.contentid, contenttitle, contentdescription, contentviews, contentdateupload, licenceid, licenceurl, tagname 
			  FROM Content c, contenttag ct, tag t , licence
			  WHERE contentuser = :user
			  AND c.contentid = ct.contentid
			  AND ct.tagid = t.tagid
			  AND contentlicenceid = licenceid
			  ORDER BY contentdateupload DESC';

	$req = $this->co->prepare($query);

	$req->bindValue(':user',$id, PDO::PARAM_STR);
	$req->execute();							

	return $req->fetchAll();
}


/**
		Get the favorite content of user
**/
	public function get_favorites($id)
	{
		$sql = 'SELECT contentid, contenttitle, usernickname, contentviews, datelike 
				FROM likes, content, user
				WHERE contentlikeid = contentid
				AND contentuser = userid
				AND userlikeid = :id';

		$req = $this->co->prepare($sql);

		$req->bindValue(':id',$id, PDO::PARAM_STR);
		$req->execute();							

		return $req->fetchAll();
	}

/**
		Edit content and files
**/

	public function edit($array)
	{
		$newtitle = htmlspecialchars($array['title-edit']);
		$newbase64title = base64_encode($array['title-edit']);

		try
		{
			$query='UPDATE content SET contentid = :newid, contenttitle = :title, contentdescription = :description, contentlicenceid = :licence WHERE contentid = :oldid';
			$req= $this->co->prepare($query);


			$req->bindValue(':oldid',   	  	$array['id-edit'], PDO::PARAM_STR);
			$req->bindValue(':newid',      		$newbase64title, PDO::PARAM_STR);
			$req->bindValue(':title',    		$newtitle, PDO::PARAM_STR);
			$req->bindValue(':description',     htmlspecialchars($array['description-edit']), PDO::PARAM_STR);
			$req->bindValue(':licence',      	$array['licence-edit'], PDO::PARAM_STR);

			$req->execute();


			$query='UPDATE contenttag SET contentid = :newid, tagid = :tag WHERE contentid = :oldid';
			$req= $this->co->prepare($query);

			$req->bindValue(':oldid',   $array['id-edit'], PDO::PARAM_STR);
			$req->bindValue(':newid',   $newbase64title, PDO::PARAM_STR);
			$req->bindValue(':tag',     $array['tagid'], PDO::PARAM_STR);

			$req->execute();
		}
		catch( PDOException $e ) 
		{
			echo "Registration impossible : ". $e->getMessage();
		}


		$array['path_old'] = 'videos/'.htmlspecialchars($array['nickname']).'/'.$array['id-edit'];
		$array['path_new'] = 'videos/'.htmlspecialchars($array['nickname']).'/'.$newbase64title;

		if(!is_dir($array['path_old']))
		{
			rename($array['path_old'],$array['path_new']);
		}

		$error = true;	

 		if(!empty($array['file']['thumbnail']['name']))
 		{
			$path_thumbnail = $path_new.'/thumbnail.jpg';
 			if (move_uploaded_file($array['file']['thumbnail']['tmp_name'], $path_thumbnail)) {
 				$error = 'uploaded';
 			}
 			else{
 				$error = 'upload error 1';
 			}
		}

		echo $error;
		header('Location: user-page.php?new=edit');
	}


	public function delete($array)
	{
		$query = 'DELETE c, ct
				FROM content c
				JOIN contenttag ct ON c.contentid = ct.contentid
				WHERE c.contentid = :id';
		$req= $this->co->prepare($query);

		$req->bindValue(':id', $array['contentid'], PDO::PARAM_STR);

		$req->execute();

		$dir='videos/'.htmlspecialchars($array['nickname']).'/'.$array['contentid'];

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

}

?>